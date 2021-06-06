<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'role'  => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        if($validatedData->fails()){
            return response(['message' => $validatedData->errors()], 400);
        }

        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $role = ($input['role']) ? $input['role'] : 'human_resource';
        $user = User::create($input);
        User::find($user->id)->assignRole($role);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken], 201);
    }

    public function login(Request $request)
    {
        // $validator = $request->validate([
        //     'email' => 'email|required',
        //     'password' => 'required'
        // ]);

        // if (!auth()->attempt($loginData)) {
        //     return response(['error' => 'This User does not exist, check your details'], 400);
        // }

        // $accessToken = auth()->user()->createToken('authToken')->accessToken;

        // return response(['user' => auth()->user(), 'access_token' => $accessToken]);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Either email or password is wrong.'], 401);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['access_token' => $accessToken]);
        // return $this->createNewToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }


}
