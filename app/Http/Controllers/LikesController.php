<?php

namespace App\Http\Controllers;

use App\Models\Dislike;
use App\Models\likes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LikesController extends Controller
{
    // public function likePost($id)
    // {
    //     $likePost = DB::table('likes')->insert([
    //         'id_post' => $id,
    //         'id_user' => Auth::user()->id,
    //         'created_at' => Carbon::now()->toDateTimeString()

    //     ]);

    //     return response()->json(['Like' => 'Like pris en compte',]);
    // }

    public function like($id_post, $id_user)
    {

        // $like = likes::select('select from likes where (id_post and id_user) values (?, ?)', [$id_post, $id_user])->count();

        $like = DB::table('likes')
            ->where('id_post', '=', $id_post)
            ->where('id_user', '=', $id_user)
            ->count();
        if ($like == 1) {

            $delete = DB::table('likes')
                ->where('id_post', '=', $id_post)
                ->where('id_user', '=', $id_user)
                ->delete();
            return response()->json(['state' => 'like supprimé']);
        } else {


            $likePost = DB::table('likes')->insert([
                'id_post' => $id_post,
                'id_user' => Auth::user()->id,
                'created_at' => Carbon::now()->toDateTimeString()

            ]);
        }
        return response()->json(['likes' => $like]);
    }

    public function countLike($id_post)
    {
        $countLike = likes::select('select from likes id_post where values (?)', [$id_post])->count();

        return response()->json(['countLike' => $countLike]);
    }
}
