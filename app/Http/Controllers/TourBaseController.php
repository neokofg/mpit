<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tourbase;
use Illuminate\Http\Request;

class TourBaseController extends Controller
{
    protected function createTourBase(Request $request)
    {
        $validateFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'coords' => 'required',
            'images' => 'required',
            'images.*' =>'mimes:jpeg,png,jpg,gif,svg'
        ]);
        $name = $request->input('name');
        $description = $request->input('description');
        $coords = $request->input('coords');
        foreach($request->file('images') as $key => $image)
        {
            $fileName= date('YmdHi').$image->hashName();
            $image-> move(public_path('images'), $fileName);
            $insert[$key]['name'] = $fileName;
        }
        Tourbase::create([
            'name' => $name,
            'description' => $description,
            'coords' => $coords,
            'images' => json_encode($insert)
        ]);
        return back();
    }
    protected function createNewBooking(Request $request)
    {
        $validateFields = $request->validate([
            'date' => 'required|date',
            'peoples' => 'required|integer',
            'phone' => 'required',
            'id' => 'required'
        ]);
        $date = $request->input('date');
        $peoples = $request->input('peoples');
        $phone = $request->input('phone');
        $id = $request->input('id');
        $booking = Booking::create([
            'tourbase_id' => $id,
            'date' => $date,
            'peoples' => $peoples,
            'phone' => $phone,
            'status' => 'pending'
        ]);
        return back();
    }
}
