<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreUserRequest;
use App\Mail\WelcomeAppRents;
use App\Models\PendingUser;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
class UserController extends Controller
{
    public function register(StoreUserRequest $request)
    {
     $data = $request->validated();
     $data['password'] = Hash::make($data['password']);
    $path1 = null;
    $path2 = null;
     if($request->hasFile('personal_photo')&&$request->hasFile('photo_of_personal_ID'))
     {
        $path1=$request->file('personal_photo')->store('my_photo_personal','public');
        $path2=$request->file('photo_of_personal_ID')->store('my_photo_of_personal_ID','public');
        $data['personal_photo']=$path1;
        $data['photo_of_personal_ID']=$path2;
    }
    PendingUser::create([
        'phone'=>$data['phone'],
        'first_name'=>$data['first_name'],
        'last_name'=>$data['last_name'],
        'password' => $data['password'],
        'personal_photo'=>$path1,
        'photo_of_personal_ID'=>$path2,
    ]);
    // $user = User::create($data);
    // Mail::to($user->email)->send(new WelcomeAppRents($user));
    return response()->json([
        'message'=>'The registration request has been submitted and is awaiting administrative approval.',
        'user'=>$data
    ],200);
    }
    public function login(Request $request)
    {
      $request->validate(
        [
        'phone'=>'required|digits:10',
        'password'=>'required|string|min:8'
        ]);
      if(!Auth::attempt($request->only('phone','password')))
        return response()->json([
      'message'=>'invalid phone or password'],401);
     $user=User::where('phone',$request->phone)->FirstOrFail();
     $token=$user->createToken('auth_token')->plainTextToken;
     return response()->json([
        'message'=>'login Successfully',
        'User'=>$user,
        'code'=>200,
        'token'=>$token
     ]);
    }
    public function logout(Request $request)
    {
      $request->user()->currentAccessToken()->delete();
      return response()->json(
        ['message'=>'logout sucessfully']
      );
    }
    public function selectLanguage($locale)
    {
        if (!in_array($locale, ['en', 'ar'])) {
            return response()->json(['message' => 'language not supported'], 400);
        }
        App::setLocale($locale);
        session()->put('locale', $locale);
        return response()->json(['message' => 'done'], 200);
    }
    public function getNotificatios()
    {
        $notifications=auth()->user()->notifications;
        return response()->json($notifications,200);
    }
    public function markAsRead($notificationId)
    {
        $notifications=auth()->user()->notifications()->findorfail($notificationId);
        $notifications->markAsRead();
        return response()->json(['message'=>'notifications marked as read'],200);
    }
}
