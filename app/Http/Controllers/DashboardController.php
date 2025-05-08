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

        // Загружаем ВСЕ заказы с товарами и услугами
        $orders = Order::with([
            'orderItems.product:id,name',
        ])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                $order->total_price = (float)$order->total_price;

                if ($order->order_items) {
                    foreach ($order->order_items as $item) {
                        $item->price = (float)$item->price;
                    }
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
