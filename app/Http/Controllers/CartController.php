<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use Inertia\Inertia;

class CartController extends Controller
{
    // Отображение корзины
    public function index()
    {
        $cartItems = CartItem::with('product.productColors')
            ->where('user_id', auth()->id())
            ->get();

        // CartController@index
        return inertia('CartPage', [
            'cartItems' => $cartItems->map(function ($item) {
                $colorImage = $item->product->productColors
                    ->firstWhere('color', $item->color)?->image_url;

                return [
                    'id' => $item->id,
                    'quantity' => $item->quantity,
                    'color' => $item->color,
                    'service_type' => $item->service_type,
                    'service_price' => $item->service_price,
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

    // Переход на страницу оплаты (без создания заказа)
    public function checkout(Request $request)
    {
        $cartItems = CartItem::where('user_id', auth()->id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста.');
        }

        return Inertia::render('PaymentPage');
    }

    // Обновление количества товара

    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $request->validate([
            'quantity' => 'required|integer|min:1',
            'service_type' => 'nullable|string',
            'service_price' => 'nullable|numeric'
        ]);

        $cartItem->update([
            'quantity' => $request->quantity,
            'service_type' => $request->service_type,
            'service_price' => $request->service_price
        ]);

        return back();
    }


    // Удаление товара
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
