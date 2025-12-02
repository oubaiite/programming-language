<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApartmentRequest;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ApartmentController extends Controller
{
    public function getAllApartments()
    {
     $apartment=Apartment::all();
     return response()->json($apartment,200);
    }
    public function postApartment(StoreApartmentRequest $request)
    {
        $user_id=Auth::user()->id;
        $firstName=Auth::user()->first_name;
        $lastName=Auth::user()->last_name;
        $numberPhone=Auth::user()->phone;
        $validateData=$request->validated();
        $validateData['user_id']=$user_id;
        $validateData['owner']=$firstName.' '.$lastName;
        $validateData['owner_phone']=$numberPhone;
        $bulid=Apartment::create($validateData);
        return response()->json($bulid,201);
    }
}
