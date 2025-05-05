<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function confirm(Request $request)
    {
        // Валидация данных платежа (это для примера, в реальной жизни можно использовать сервисы оплаты)
        $request->validate([
            'number' => 'required',
            'expiry' => 'required',
            'cvv' => 'required',
        ]);

        // Получаем последний заказ пользователя
        $order = Order::where('user_id', auth()->id())
            ->where('status', 'pending') // Статус "Ожидает"
            ->latest()
            ->first();

        if (!$order) {
            return redirect()->route('cart.index')->with('error', 'Не найден заказ для оплаты.');
        }

        // Изменяем статус заказа на "Активен"
        $order->update(['status' => 'active']);

        return redirect()->route('dashboard')->with('success', 'Оплата прошла успешно!');
    }
}
