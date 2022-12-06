<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LikesController extends Controller
{
    public function likePost($id)
    {
        $likePost = DB::table('likes')->insert([
            'id_post' => $id,
            'id_user' => Auth::user()->id,
            'created_at' => Carbon::now()->toDateTimeString()

        ]);



        return response()->json(['Like' => 'Like pris en compte',]);
    }
}
