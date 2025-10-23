<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\ProfileRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('panel.profile');
    }

    public function update(ProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        if ($request->hasFile('profile_photo')) {
            $user->clearMediaCollection('profile_photo');
            $user->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo');
        }

        return redirect()->back()->with('success', 'Profil bilgileri başarıyla güncellendi!');
    }
    public function deletePhoto()
    {
        $user = auth()->user();
        $user->clearMediaCollection('profile_photo');

        return response()->json([
            'success' => true,
            'message' => 'Profil fotoğrafı kaldırıldı.',
            'default_url' => asset('user/img/default.png'),
        ]);
    }
}
