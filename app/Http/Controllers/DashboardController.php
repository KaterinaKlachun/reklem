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

        // Загрузка активных заказов без изображения товара
        $activeOrders = Order::with([
            'orderItems.product:id,name',
            'orderItems' => function($query) {
                $query->select('id', 'order_id', 'product_id', 'color', 'quantity', 'price');  // Без изображения
            }
        ])
            ->where('user_id', $user->id)
            ->whereIn('status', ['pending', 'active'])
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

        // Загрузка завершённых заказов без изображения товара
        $completedOrders = Order::with([
            'orderItems.product:id,name',
            'orderItems' => function($query) {
                $query->select('id', 'order_id', 'product_id', 'color', 'quantity', 'price');  // Без изображения
            }
        ])
            ->where('user_id', $user->id)
            ->where('status', 'completed')
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
            'user' => $user,
            'profile_photo_url' => $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : null,
            'activeOrders' => $activeOrders,
            'completedOrders' => $completedOrders,
        ]);
    }
}
