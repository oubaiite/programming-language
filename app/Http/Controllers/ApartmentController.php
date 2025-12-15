<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreApartmentRequest;
use App\Models\Apartment;
use App\Notifications\ApartmentNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
class ApartmentController extends Controller
{
    public function getAllApartments()
    {
     $apartments = Apartment::with('user:id,first_name,last_name,phone')->get();
      $data = $apartments->map(function($apartment) {
        return [
            'id'             =>$apartment->id,
            'site'           => $apartment->site,
            'type'           => $apartment->type,
            'area'           => $apartment->area,
            'number_of_room' => $apartment->number_of_room,
            'city'           => $apartment->city,
            'price'          => $apartment->price,
            'rating'         => $apartment->rating,
            'description'    => $apartment->description,
            'owner' => [
                'id'=>$apartment->user->id,
                'name'  => $apartment->user->first_name . ' ' . $apartment->user->last_name,
                'phone' => $apartment->user->phone
            ]
        ];
    });
     return response()->json([
        'data'=>$data,
        'status code'=>200
     ],200);
    }
    public function postApartment(StoreApartmentRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();
        $validated['user_id'] = $user->id;
        $apartment = Apartment::create($validated);
        /*$user_id=Auth::user()->id;
        $firstName=Auth::user()->first_name;
        $lastName=Auth::user()->last_name;
        $numberPhone=Auth::user()->phone;
        $validateData=$request->validated();
        $validateData['user_id']=$user_id;
        $validateData['owner']=$firstName.' '.$lastName;
        $validateData['owner_phone']=$numberPhone;
        $bulid=Apartment::create($validateData);
        return response()->json($bulid,201);*/
        Notification::send($user,new ApartmentNotifications($apartment));// ('','المستلم')
        return response()->json([
            'owner'=>[
            'name'=>$user->first_name . ' ' . $user->last_name,
            'phone'=>$user->phone
            ],
            'apartment'=>$apartment
        ],201);
    }
}
