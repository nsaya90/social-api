<?php

namespace App\Http\Controllers;

use App\Models\Dislike;
use App\Models\likes;
use App\Models\Post;
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


        $like = DB::table('likes')
            ->where('id_post', '=', $id_post)
            ->where('id_user', '=', $id_user)
            ->count();



        if ($like == 1) {


            // $decLike = DB::table('posts')->decrement('like', 1);

            $queryDelete = DB::table('posts')->where('id', '=', $id_post)->where('id_user', '=', $id_user);

            $queryDelete->decrement('like', 1);

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

            // $incLike = DB::table('posts')->increment('like', 1);

            $query = DB::table('posts')
                ->where('id', '=', $id_post)
                ->where('id_user', '=', $id_user);

            $query->increment('like', 1);
        }
        return response()->json(['likes' => 'like pris en compte']);
    }

    public function countLike()
    {
        // $countLike = DB::table('likes')
        //     ->select('id_post');

        $query = DB::table('likes')->select('id_post')->get();

        return response()->json(['countLike' => $query]);
    }

    public function showLike($id_post, $id_user)
    {

        $showLike = DB::table('likes')
            ->where('id_post', '=', $id_post)
            ->where('id_user', '=', $id_user);


        return response()->json(['showLike' => $showLike]);
    }
}
