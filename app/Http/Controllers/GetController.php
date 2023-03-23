<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use App\Models\Tourbase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class GetController extends Controller
{
    protected function getIndex()
    {
        $tourbases = Cache::remember('IndexTours',30, function(){
           return  Tourbase::take(9)->get();
        });
        return view('welcome', compact(['tourbases']));
    }

    protected function getPage($id)
    {
        $tourbase = Tourbase::where('id', $id)->first();

        $images = $tourbase->images;
        $images = json_decode($images, true);

        $bookings = Booking::where('tourbase_id', $tourbase->id)->get();
        $dates = $bookings->pluck('date')->toArray();

        $ratings = Rating::where('tourbase_id', $tourbase->id)->get();

        return view('page', compact(['tourbase', 'images', 'bookings', 'dates', 'ratings']));
    }

    protected function getProfile()
    {
        $bookings = Booking::where('user_id', Auth::user()->id)->get();
        return view('profile', compact(['bookings']));
    }

    protected function getSearch(Request $request)
    {
        $search = $request->input('search');
        return view('search',compact(['search']));
    }
    protected function getAdmin()
    {
        return view('admin');
    }
    protected function payBooking(Request $request)
    {
        $validateFields = $request->validate([
            'id' => 'required'
        ]);
        $tourbase_id = $request->input('id');
        return view('pay',compact(['tourbase_id']));
    }
    protected function getLogin()
    {
        return view('login');
    }
    protected function getRegister()
    {
        return view('register');
    }
}
