<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index($id_post)
    {

        $comment =   DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.id_user')
            ->select('users.*', 'posts.id', 'posts.image', 'posts.title', 'posts.description', 'posts.like', 'posts.id_user')
            ->where('posts.id', '=', $id_post)
            ->get();

        return response()->json(['comment' => $comment]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [

                'comment' => 'required|string|max:191',

            ],
            [
                'comment.required' => 'Veuillez saisir un commentaire',
                'comment.max' => 'Votre commentaire est trop long',

            ]
        );

        // $filename = time() . '.' . $request->image->extension();

        // // chemin des images stocker dans le storage
        // $image = $request->file('image')->storeAs('images', $filename, 'public');

        $comment = Comments::create([
            'comment' => $request['comment'],
            'id_user' => Auth::user()->id,
            'id_post' => $request['id_post'],

        ]);

        return response()->json(['commentaire' => 'Commentaire publié', 'comment' => $comment]);
    }
    public function showComment($id_post)
    {

        // $getComment = DB::table('comments')->where('id_post', '=', $id_post)->get();

        $getComment =  DB::table('users')
            ->join('comments', 'users.id', '=', 'comments.id_user')
            ->select('users.*', 'comments.comment')
            ->get();

        return response()->json(['getComment' => $getComment]);
    }
}
