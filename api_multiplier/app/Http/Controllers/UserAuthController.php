<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as User;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    public function registerUserExample(Request $request){
        $rules =  [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'users_type' => 'required',
        ];
        $messages = [
            'name.required' => 'O atributo nome é obrigatório!',
            'email.required' => 'O atributo email é obrigatório!',
            'password.required' => 'O atributo password é obrigatório!',
            'users_type.required' => 'O atributo tipo do usuário é obrigatório!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 500);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->users_type = $request->users_type;
        $user->password = bcrypt($request->password);
        
        if ($user->save()) {
            return response()->json(['success'=>'Usuário Criado no Sucesso'],200);
        } else {
            return response()->json(['error'=>'Erro ao Criar Usuário'],500);
        }
    }

    public function loginUserExample(Request $request){
        $rules =  [
            'email' => 'required',
            'password' => 'required',
        ];
        $messages = [
            'email.required' => 'O atributo email é obrigatório!',
            'password.required' => 'O atributo password é obrigatório!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 500);
        }

        $login_credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(auth()->attempt($login_credentials)){
            $user_login_token= auth()->user()->createToken('User_Personal_Token')->accessToken;
            return response()->json(['token' => $user_login_token], 200);
        } else {
            return response()->json(['error' => 'Acesso Não-Autorizado'], 401);
        }
    }

    public function authenticatedUserDetails(){
        if (auth()->user() == null) {
            return response()->json(['error' => 'Não-Autenticado'], 404);
        } else {
            return response()->json(auth()->user(), 200);
        }
    }

    public function userNotAuth(){
        return response()->json(['error' => 'Não-Autenticado'], 404);
    }
    
    /*function (Request $request) {
        return $request->user();
    }*/    
}