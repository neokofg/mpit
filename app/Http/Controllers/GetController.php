<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use App\Models\Tourbase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetController extends Controller
{
    protected function getIndex()
    {
        $tourbases = Tourbase::take(9)->get();
        return view('welcome', compact(['tourbases']));
    }
    protected function getPage($id)
    {
        $tourbase = Tourbase::where('id',$id)->first();

        $images = $tourbase->images;
        $images = json_decode($images,true);

        $bookings = Booking::where('tourbase_id',$tourbase->id)->get();
        $dates = $bookings->pluck('date')->toArray();

        $ratings = Rating::where('tourbase_id', $tourbase->id)->get();

        return view('page', compact(['tourbase','images','bookings','dates','ratings']));
    }
    protected function getProfile(){
        $bookings = Booking::where('user_id',Auth::user()->id)->get();
        return view('profile',compact(['bookings']));
    }
}
