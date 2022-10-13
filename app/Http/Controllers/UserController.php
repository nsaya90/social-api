<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Si adresse mail déjà utilisé renvoie message d'érreur
        $user_mail = User::where('email', $request->email)->first();
        if ($user_mail) {
            return response()->json(['error_mail' => 'Cette adresse mail est déjà utilisé']);
        }

        $request->validate(
            [
                'lastname' => 'required|string',
                'firstname' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string|min:5',
            ],
            [
                'lastname.required' => 'Veuillez saisir un Prénom valide',
                'firstname.required' => 'Veuillez saisir un Nom valide',
                'password.min' => 'Le mot de passe doit contenir au moins 5 caractère',
                'password.required' => 'Le mot de passe doit contenir au moins 5 caractère',
                'email.email' => 'L\'adresse mail est non valide',
                'email.required' => 'Veuillez saisir une adresse mail valide',

            ]
        );

        $register = User::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'password' => $request['password'],

        ]);



        return response()->json(['message' => 'Vous êtes bien inscrit', 'User' => $register]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

        $update_user = User::findorFail($id);

        $request->validate(
            [
                'lastname' => 'required|string',
                'firstname' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string|min:5',

            ],
            [
                'lastname.required' => 'Veuillez saisir un Prénom valide',
                'firstname.required' => 'Veuillez saisir un Nom valide',
                'email.email' => 'L\'adresse mail est non valide',
                'email.required' => 'Veuillez saisir une adresse mail valide',
                'password.min' => 'Le mot de passe doit contenir au moins 5 caractère',
                'password.required' => 'Le mot de passe doit contenir au moins 5 caractère',

            ]
        );

        $update_user->firstname = $request->firstname;
        $update_user->lastname = $request->lastname;
        $update_user->email = $request->email;
        $update_user->password = $request->password;
        $update_user->save();

        return response()->json(['message' => 'Mise à jour du profil réussie !', 'User-update' => $update_user]);
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

    public function login(Request $request)
    {

        $user_mail = User::where('email', $request->email)->first();
        $user_password = User::where('password', $request->password)->first();
        if ($user_mail && $user_password) {
            $token = $user_mail->createToken('auth_token')->plainTextToken;
        }

        if (!$user_mail) {

            return response()->json(['error_mail' => 'Mauvaise adresse mail']);
        } elseif (!$user_password) {
            return response()->json(['error_password' => 'Mauvais mot de passe']);
        };
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'id_user' => $user_mail->id,
            'succes' => 'Connexion Réussie'
        ]);
    }

    public function profil($id)
    {
        $user = User::where('id', $id)->first();;
        return response()->json(['user' => $user]);
    }
}
