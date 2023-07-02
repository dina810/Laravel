<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Resources\UserResource;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return  UserResource::collection($users);

    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required' ,'min:2'],
            'email' => ['required','email', 'unique:users'],
            'password' => ['required','min:6'],
            'github_id' =>'nullable',
        ]);
        $data = $request->only(['name', 'email', 'password', 'github_id']);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return new UserResource($user);
        // return response()->json([
        //     'success' => true,
        //     'data' => $user
        // ], 201);
    }
    public function show($userId)
    {
        $user = User::find($userId);
     
        return new UserResource($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

    $validatedData = $request->validate([
        'name' => ['required' ,'min:2'],
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($user->id)
        ],
        'password' => ['required','min:6'],
        'github_id' =>'nullable',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);

    $user->update($validatedData);
    
    return new UserResource($user);
    
    }

    public function delete($id)
    {
            $user = User::find($id);
            $user->delete();
            return new UserResource($user);
        //     return response()->json([
        //        'success' => true,
        //        'message' => 'user deleted successfully.'
        //    ]);
    }
}