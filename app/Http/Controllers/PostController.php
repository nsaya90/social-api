<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPost = Post::all();
        return response()->json(['allPost' => $allPost]);
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
                'description' => 'required|string',

            ],
            [
                'title.required' => 'Veuillez saisir un titre',
                'description.required' => 'Veuillez saisir une description ',

            ]
        );

        // $filename = time() . '.' . $request->image->extension();

        // // chemin des images stocker dans le storage
        // $image = $request->file('image')->storeAs('images', $filename, 'public');

        $post = Post::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'image' => $request['image'],
            'id_user' => $request['id_user'],


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
