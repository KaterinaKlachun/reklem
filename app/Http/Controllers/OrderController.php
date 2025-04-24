<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'comment' => 'nullable|string',
        ]);

        $order = Order::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'comment' => $validated['comment'],
            'user_id' => auth()->id(), // Привязываем заказ к текущему авторизованному пользователю
        ]);

        return redirect()->route('orders.create')->with('success', 'Заявка успешно отправлена!');
    }
}
