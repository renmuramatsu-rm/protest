<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\Item;



class AddressController extends Controller
{

    public function create(AddressRequest $request, $item_id)
    {
        $user = Auth::user();
        $item = Item::find($item_id);
        $address = Address::updateOrCreate(
            ['user_id' => $user->id],
            [
                'item_id' => $item_id,
                'postcode' => $request->input('postcode'),
                'address'  => $request->input('address'),
                'building' => $request->input('building')
            ]
        );
        return view('purchase', compact('user','address','item'));
    }
}
