<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Session;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return [
            ...parent::share($request),

            'auth' => [
                'user' => fn () => $request->user() ? $request->user()->fresh() : null,
            ],

            'csrf_token' => fn () => csrf_token(),

            // ✅ Добавляем флеш-сообщения для модального окна
            'photoStatus' => fn () => Session::get('photoStatus'),
            'photoMessage' => fn () => Session::get('photoMessage'),
        ];
    }
}
