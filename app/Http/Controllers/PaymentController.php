<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class PaymentController extends Controller
{
    // Подтверждение оплаты и создание заказа
    public function confirm(Request $request)
    {
        $request->validate([
            'number' => 'required',
            'expiry' => 'required',
            'cvv' => 'required',
        ]);

        $user = Auth::user();

        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Корзина пуста.'], 422);
        }

        // Создаём заказ
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_price' => $cartItems->sum(function ($item) {
                return ($item->quantity * $item->product->price); // Убираем обработку услуги
            }),
        ]);

        foreach ($cartItems as $item) {
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'color' => $item->color,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Очищаем корзину
        CartItem::where('user_id', $user->id)->delete();

        return response()->noContent(); // 204
    }
}
