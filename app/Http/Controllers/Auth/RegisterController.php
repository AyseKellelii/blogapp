<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();

        $data['role'] = $request->boolean('is_writer') ? 'admin' : 'user';
        $data['password'] = Hash::make($data['password']);

        $user = User::create(collect($data)->only([
            'name', 'surname', 'username', 'email', 'password', 'bio', 'role'
        ])->toArray());

        if ($request->hasFile('profile_photo')) {
            $user->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo');
        }

        return redirect()->route('login')->with('success', 'Kayıt başarıyla tamamlandı.');
    }
}
