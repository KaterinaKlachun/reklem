<?php

namespace App\Http\Controllers;

use App\Models\News;
use Inertia\Inertia; // Добавьте этот импорт

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('date', 'desc')->get();

        return Inertia::render('NewsPage', [
            'newsList' => $news
        ]);
    }
}
