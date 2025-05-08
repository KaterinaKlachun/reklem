<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Получаем заказы пользователя
        $orders = Order::with([
            'orderItems.product:id,name',
            'orderItems.services' => function ($query) {
                $query->withPivot('price');
            },
        ])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                $order->total_price = 0;

                foreach ($order->orderItems as $item) {
                    $item->services_total = 0;

                    // Добавляем стоимость услуги к общему расчету
                    if ($item->service_price) {
                        $item->services_total = $item->service_price * $item->quantity;
                    }

                    $item->total_price = ($item->price * $item->quantity) + $item->services_total;
                    $order->total_price += $item->total_price;  // Суммируем стоимость товара и услуги для заказа
                }

                return $order;
            });

        return Inertia::render('Dashboard', [
            'profile_photo_url' => $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : null,
            'activeOrders' => $orders->whereIn('status', ['pending', 'active'])->values(),
            'completedOrders' => $orders->where('status', 'completed')->values(),
        ]);
    }

}
