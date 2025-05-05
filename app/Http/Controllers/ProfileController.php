<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'user' => $request->user(),
            'mustVerifyEmail' => $request->user()->hasVerifiedEmail(),
            'status' => session('status'),
            'profile_photo_path' => $request->user()->profile_photo_path ? Storage::url($request->user()->profile_photo_path) : null,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'Данные обновлены');
    }

    /**
     * Upload profile photo.
     */
    public function updateProfilePhoto(Request $request)
    {
        try {
            // Валидация файла
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024', // до 1MB
            ]);

            $user = $request->user();
            $file = $request->file('photo');

            // Удаление старого файла, если есть
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Генерация уникального имени файла
            $filename = 'user_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Сохранение файла
            $path = $file->storeAs('profile-photos', $filename, 'public');

            // ОБНОВЛЕНИЕ МОДЕЛИ вручную
            $user->profile_photo_path = $path;
            $user->save();

            return response()->json([
                'success' => true,
                'path' => Storage::url($path), // Для отображения
                'message' => 'Фото профиля обновлено'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
