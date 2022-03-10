<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    function login(LoginRequest $request) {
        $validator = Validator::make($request->all(), $request->rules());
        if (!$validator->fails()) {
            $userdata = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];
            if (Auth::attempt($userdata)) {
                $user = User::where('email', $request->input('email'));
                $token = $user->createToken($request->token_name);
                return ['token' => $token->plainTextToken];
            }
        }
    }

    // Delete user
    public function deleteUser(Request $request, $id) {
        $user = User::find($id); 
        $user->delete($request->all());
        return response()->json($user, 200);
    }    
    
    // Update user
    public function updateUser(Request $request, $id) {
        $user = User::find($id); 
        $user->update($request->all());

        return response()->json($user, 200);
    }    
    
    // Create user
    public function createUser(Request $request) {
        $user = User::create($request->all());
        return response()->json($user, 200);
    }

}
