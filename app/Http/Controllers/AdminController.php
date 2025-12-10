<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Mail\WelcomeAppRents;
use App\Models\PendingUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\HttpCache\Store;

class AdminController extends Controller
{
    public function approve(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $pending = PendingUser::where('phone', $request->input('phone'))->first();
        if(!$pending)
        {
            return response()->json(['message'=>'user not found'],400);
        }
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        if ($request->hasFile('personal_photo') && $request->hasFile('photo_of_personal_ID')) {
            $path1 = $request->file('personal_photo')->store('my_photo_personal', 'public');
            $path2 = $request->file('photo_of_personal_ID')->store('my_photo_of_personal_ID', 'public');
            $data['personal_photo'] = $path1;
            $data['photo_of_personal_ID'] = $path2;
        }
        $user = User::create($data);
        Mail::to($user->email)->send(new WelcomeAppRents($user));
        $pending->delete();
        return response()->json([
            'message' => 'User has been approved.',
            'user' => $user
        ]);
    }
     public function reject(Request $request)
    {
        $pending = PendingUser::where('phone', $request->input('phone'))->first();
        if(!$pending)
        {
            return response()->json(['message'=>'user not found'],400);
        }
        $pending->delete();
        return response()->json([
            'message' => 'Registration request rejected',
        ]);
    }
   public function deleteUser($id)
    {
    /*$request->validate([
        'id' => 'required|exists:users,id'
    ]);
    if($request->id===null)
    {
        return response()->json(['message'=>'the user is not found'],400);
    }*/
    $user = User::find($id);
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }
    /*$deleted = User::where('id', $request->id)->delete();
    if ($deleted) {
        return response()->json(['message' => 'User deleted successfully']);
    } else {
        return response()->json(['message' => 'User not found'], 404);
    }*/
    $user->delete();
    return response()->json(['message' => 'User deleted successfully'],200);
    }
    public function listPending()
    {
        return PendingUser::all();
    }
    public function getaAllUser()
    {
        $user=User::where('role','!=','admin')->get();
        return response()->json($user,200);
    }
}
