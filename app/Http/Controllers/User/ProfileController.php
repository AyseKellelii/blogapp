<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = $user->posts()->with('categories')->latest()->get();
        return view('user.profile', compact( 'user', 'posts'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();


        // Temel bilgileri güncelle
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->bio = $request->bio;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($request->hasFile('profile_photo')) {
            $user->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo');
        }

        return redirect()->back()->with('success', 'Profiliniz başarıyla güncellendi.');
    }

    public function removePhoto()
    {
        $user = Auth::user();
        $user->clearMediaCollection('profile_photo');

        return redirect()->route('user.profile')->with('success', 'Profil fotoğrafınız kaldırıldı.');
    }


}
