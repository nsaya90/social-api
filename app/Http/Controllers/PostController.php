<?php

namespace App\Http\Controllers;


use App\Models\likes;
use App\Models\Post;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $allPost = Post::all()->orderBy('id', 'desc')->get();
        // $allPost = DB::table('posts')->orderBy('id', 'desc')->get();
        // $datePost = DB::select('SELECT CAST(CURRENT_TIMESTAMP AS DATE);');

        $users = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.id_user')
            ->select('users.*', 'posts.id', 'posts.date_post', 'posts.image', 'posts.title', 'posts.description', 'posts.like', 'posts.id_user')
            ->get();


        return response()->json(['allPost' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string',
                'description' => 'required|string|max:191',

            ],
            [
                'title.required' => 'Veuillez saisir un titre',
                'description.required' => 'Veuillez saisir une description ',
                'description.max' => 'Votre description est trop longue',

            ]
        );

        // $filename = time() . '.' . $request->image->extension();

        // // chemin des images stocker dans le storage
        // $image = $request->file('image')->storeAs('images', $filename, 'public');
        $date_post = date('d-m-Y');

        $post = Post::create([

            'description' => $request['description'],
            'image' => $request['image'],
            'id_user' => $request['id_user'],
            'like' => 0,
            'date_post' => $date_post,

        ]);

        return response()->json(['message' => 'Post publié', 'Post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload(Request $request)
    {

        // $request->image;
        // $filename = time() . '.' . $request->image->extension();
        // $request->file('image')->storeAs('images', $filename, 'public');
        $pathToFile = $request->file('image')->store('images', 'public');
        return response()->json(['message' => 'Ajout de photo réussie', 'url' => $pathToFile]);
    }
}
