<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','refresh','logout']]);
    }

    public function register(Request $request){
        
        // dd($request);

        $validatedData=$request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',           
            'status' => 'required|string|in:actif,inactif',
            'role' => 'required|string|in:admin,recruteur,candidat',
        ]);

        $existingUser = User::where('email', $validatedData['email'])->first();

        if ($existingUser) {
            return response()->json([
                'error' => 'The email address is already registered. Please choose a different email.',
            ], 422); 
        }
        
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profil_photos', 'public');
        } else {
            $photoPath = null;  
        }
    
  
// dd($photoPath);

        $user = User::create([
            'first_name' => $validatedData['first_name'],   
            'last_name' => $validatedData['last_name'],     
            'phone' => $validatedData['phone'],             
            'photo' => $photoPath,             
            'email' => $validatedData['email'],             
            'password' => Hash::make($validatedData['password']),  
            'status' => $validatedData['status'],           
            'role' => $validatedData['role'],               
        ]);
        
        

        $token = Auth::guard('api')->login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::guard('api')->user();
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }


    // public function refresh()
    // {
    //     return response()->json([
    //         'status' => 'success',
    //         'user' => Auth::guard('api')->user(),
    //         'authorisation' => [
    //             'token' => Auth::guard('api')->refresh(),
    //             'type' => 'bearer',
    //         ]
    //     ]);
    // }


    
}