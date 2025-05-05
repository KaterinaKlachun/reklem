<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Inertia\Inertia;

class CartController extends Controller
{
    // Отображение корзины

    public function index()
    {
        $cartItems = CartItem::with('product.productColors')
            ->where('user_id', auth()->id())
            ->get();

        return inertia('CartPage', [
            'cartItems' => $cartItems->map(function ($item) {
                $colorImage = $item->product->productColors
                    ->firstWhere('color', $item->color)?->image_url;

                return [
                    'id' => $item->id,
                    'quantity' => $item->quantity,
                    'color' => $item->color,
                    'product' => [
                        'id' => $item->product->id,
                        'name' => $item->product->name,
                        'price' => $item->product->price,
                        'image_url' => $colorImage ? asset($colorImage) : null,
                    ]
                ];
            }),
        ]);
    }


    // Добавление товара в корзину
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color' => 'nullable|string',
        ]);

        $user = Auth::user();

        $existingItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->where('color', $request->color)
            ->first();

        if ($existingItem) {
            $existingItem->quantity += $request->quantity;
            $existingItem->save();
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'color' => $request->color,
            ]);
        }

        return back()->with('success', 'Товар добавлен в корзину');
    }

    // Оформление заказа
    public function checkout(Request $request)
    {
        $cartItems = CartItem::where('user_id', auth()->id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        // Создаем заказ
        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',  // Заказ в статусе "Ожидает"
            'total_price' => $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            }),
        ]);

        // Создаем записи для товаров в заказе
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'color' => $item->color,
            ]);
        }

        // Очищаем корзину после оформления
        CartItem::where('user_id', auth()->id())->delete();

        return redirect()->route('cart.index')->with('success', 'Заказ оформлен!');
    }

    // Обновление количества товара в корзине
    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return back();
    }

    // Удаление товара из корзины
    public function remove(CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $cartItem->delete();
        return back();
    }

    private function authorizeCartItem(CartItem $cartItem)
    {
        if ($cartItem->user_id !== auth()->id()) {
            abort(403, 'Нет доступа к данной записи');
        }
    }
}
