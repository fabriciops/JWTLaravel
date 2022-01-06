<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function unauthotized(){
        return response()->json([
            'erro' => 'Is not Authorizate'
        ], 401);
    }

    public function pong(){
        return json_encode('pong');
    }

    public function register(Request $request){
        
        $array = ['erro' => ''];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'cpf' => 'required|digits:11|unique:users,cpf',
            'password' => 'required',
            'password_confirm' => 'required|same:password'

        ]);

        if(!$validator->fails()){
            $name = $request->input('name');
            $email = $request->input('email');
            $cpf = $request->input('cpf');
            $password = $request->input('password');
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $newUser = new User();
            $newUser->name = $name;
            $newUser->email = $email;
            $newUser->cpf = $cpf;
            $newUser->password = $hash;
            $newUser->save();

            $token = Auth::attempt([
                'cpf' => $cpf,
                'password' => $password
            ]);

            if(!$token){
                $array['error'] = "Ocorreu um erro interno";
                return $array;
            }

            $array['token'] = $token;
            $user = Auth::user();
            $array['user'] = $user;

        }else{
            $array['error'] = $validator->errors()->first();
            return $array;
        }

        return $array;
    }
    public function login(Request $request){
        Log::info("Tentativa de Login " . $request);
        $array = ['erro' => ''];

        $validator = Validator::make($request->all(), [
            'cpf' => 'required|digits:11',
            'password' => 'required'
        ]);
        if(!$validator->fails()){
            $token = Auth::attempt([
                'cpf' => $request->cpf,
                'password' => $request->password
            ]);
            if(!$token){
                Log::error("Usuário não autenticado, Verifique login e senha" . $request->cpf);
                $array['error'] = "Usuário não autenticado, Verifique login e senha";
                return $array;
            }
            $array['token'] = $token;
            $user = Auth::user();
            $array['user'] = $user;
        }else{
            Log::error("validator Error " . $validator->errors()->first());
            $array['error'] = $validator->errors()->first();
            return $array;
        }
        Log::info("Usuario logado " . $request->cpf);
        return $array;

    }


    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    
}
