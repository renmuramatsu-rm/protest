<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Address;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


class ProfileController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        return view('profile', compact('user', 'profile'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->save;

        if ($request->hasFile('image')) {
            // 画像を storage/app/public/productsに保存し、パスを取得
            $path = Storage::disk('public')->putFile('profiles', $request->file('image'));
        }
        $profileData = Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'image'    => $path,
                'postcode' => $request->input('postcode'),
                'address'  => $request->input('address'),
                'building' => $request->input('building')
            ]
        );
        return redirect('/');
    }

    public function edit($item_id)
    {
        $user    = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        $item    = Item::with(['condition'])->find($item_id);
        $address = Address::where('user_id', $user->id)->first();
        return view('address', compact('user', 'address', 'item', 'profile'));
    }

    public function verified()
    {
        return view('registerMail');
    }

    public function mailrequest(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/mypage/profile');
    }

    public function remail(Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');}
}
