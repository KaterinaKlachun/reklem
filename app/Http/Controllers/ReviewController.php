<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        // Получаем параметры сортировки и фильтрации
        $sort = $request->get('sort', 'newest');
        $rating = $request->get('rating');

        // Строим запрос к базе данных
        $query = Review::select('id', 'name', 'rating', 'title', 'text', 'date');

        // Если задан фильтр по рейтингу, добавляем его в запрос
        if ($rating) {
            $query->where('rating', $rating);
        }

        // Применяем сортировку
        match ($sort) {
            'oldest'  => $query->orderBy('date', 'asc'),
            'highest' => $query->orderBy('rating', 'desc'),
            'lowest'  => $query->orderBy('rating', 'asc'),
            default   => $query->orderBy('date', 'desc'),
        };

        // Получаем список отзывов с пагинацией
        $reviews = $query->paginate(9)
            ->through(fn ($review) => [
                'id'     => $review->id,
                'name'   => $review->name,
                'rating' => $review->rating,
                'title'  => $review->title,
                'text'   => $review->text,
                'date'   => $review->date,
            ])
            ->withQueryString();

        // Подсчитываем данные для средней оценки и распределения оценок
        $totalReviews = $reviews->total();
        $averageRating = $reviews->avg('rating');
        $ratingCounts = [
            1 => Review::where('rating', 1)->count(),
            2 => Review::where('rating', 2)->count(),
            3 => Review::where('rating', 3)->count(),
            4 => Review::where('rating', 4)->count(),
            5 => Review::where('rating', 5)->count(),
        ];

        // Отправляем данные в Vue через Inertia
        return Inertia::render('Reviews', [
            'reviews' => $reviews,
            'filters' => [
                'sort' => $sort,
                'rating' => $rating,
            ],
            'averageRating' => $averageRating,
            'totalReviews' => $totalReviews,
            'ratingCounts' => $ratingCounts,
            'canReview' => Auth::check(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'text' => 'required|string|min:10',
        ]);

        $review = Review::create([
            'name' => Auth::user()->name,
            'rating' => $request->rating,
            'title' => $request->title,
            'text' => $request->text,
            'date' => now(),
        ]);

        return redirect()->back()->with('success', 'Отзыв успешно добавлен');
    }
}
