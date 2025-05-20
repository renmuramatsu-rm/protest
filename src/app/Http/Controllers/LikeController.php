<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LikeController extends Controller
{
    public function store($item_id)
    {
        $user = Auth::user();
        if (!$user->is_like($item_id)) {
            $user->item_likes()->attach($item_id);
        }
        return back();
    }

    public function destroy($item_id)
    {
        $user = Auth::user();
        if ($user->is_like($item_id)) {
            $user->item_likes()->detach($item_id);
        }
        return back();
    }
}
