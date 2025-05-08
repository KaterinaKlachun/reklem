<?php

// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class PaymentController extends Controller
{
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

        // Создаем заказ
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_price' => $cartItems->sum(function ($item) {
                return ($item->quantity * $item->product->price) + ($item->service_price * $item->quantity);
            }),
        ]);

        foreach ($cartItems as $item) {
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'color' => $item->color,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'service_type' => $item->service_type,  // сохраняем тип услуги
                'service_price' => $item->service_price,  // сохраняем цену услуги
            ]);

            // Если услуга есть, связываем её с товаром через промежуточную таблицу
            if ($item->service_type) {
                $orderItem->services()->attach(
                    $item->service_type_id, ['price' => $item->service_price]
                );
            }
        }

        // Очищаем корзину
        CartItem::where('user_id', $user->id)->delete();

        return response()->noContent(); // 204
    }
}
