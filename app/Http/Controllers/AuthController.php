<?php

namespace App\Http\Controllers;

use App\Models\Units;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function nauthorized(){
        return response()->json([
            'erro' => 'Is not Authorizate'
        ], 401);
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
            $newUser->permission = 1;
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

            $proprieties = Units::select(['id', 'name'])->where('id_ower', $user['id'])->get();

            $array['user']['proprieties'] = $proprieties;

        }else{
            $array['error'] = $validator->errors()->first();
            return $array;
        }

        return $array;
    }
}
