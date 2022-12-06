<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DislikeController extends Controller
{
    public function dislikePost($id)
    {
        $likePost = DB::table('dislikes')->insert([
            'id_post' => $id,
            'id_user' => Auth::user()->id,
            'created_at' => Carbon::now()->toDateTimeString()

        ]);
        return response()->json(['Dislike' => 'Dislike pris en compte']);
    }
}
