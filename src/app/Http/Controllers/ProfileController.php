<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\SoldItem;
use App\Models\Item;
use App\Models\User;
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
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->putFile('profiles', $request->file('image'));
        }

        $profile = Profile::where('user_id', $user->id)->first();
        if ($profile){
            $profile ->fill([
                    'image'    => $path,
                    'postcode' => $request->input('postcode'),
                    'address'  => $request->input('address'),
                    'building' => $request->input('building')
                ]
            );
            $profile->save();
        } else {
            Profile::create([
                'user_id' => Auth::id(),
                'image' => $path,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'building' => $request->building
            ]);
        }

        User::find(Auth::id())->update([
            'name' => $request->name
        ]);
        return redirect('/');
    }

    public function edit($item_id)
    {
        $user    = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        $item    = Item::with(['condition'])->find($item_id);
        $address = SoldItem::where('user_id', $user->id)->first();
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

    public function remail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
