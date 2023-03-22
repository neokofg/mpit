<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use App\Models\Tourbase;
use App\Models\TourbaseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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

        try {
            DB::beginTransaction();

            $name = $request->input('name');
            $description = $request->input('description');
            $coords = $request->input('coords');
            foreach($request->file('images') as $key => $image) {
                $fileName = date('YmdHi').$image->hashName();
                $image->move(public_path('images'), $fileName);
                $insert[$key]['name'] = $fileName;
            }

            $tourbase = Tourbase::create([
                'name' => $name,
                'description' => $description,
                'coords' => $coords,
                'images' => json_encode($insert)
            ]);

            TourbaseUser::create([
                'tourbase_id' => $tourbase->id,
                'user_id' => Auth::user()->id,
            ]);

            DB::commit();

            return back();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
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
            'user_id' => Auth::user()->id,
            'date' => $date,
            'peoples' => $peoples,
            'phone' => $phone,
            'status' => 'pending'
        ]);

        $tourbasePush = TourbaseUser::where('tourbase_id',$id)->first();
        if(isset($tourbasePush->botUser)){
            $data = [
                'chat_id' => $tourbasePush->botUser,
                'text' => 'К вам пришло новое бронирование!',
            ];
            $response = Http::get("https://api.telegram.org/bot6112927855:AAF-Rc36LyNcLeFuyjJw8vdEfDBw_QEnhMo/sendMessage?" . http_build_query($data));
        }
        return back();
    }
    protected function createNewRating(Request $request)
    {
        DB::transaction(function () use ($request) {
            $validateFields = $request->validate([
                'text' => 'required',
                'rating' => 'required|integer',
                'id' => 'required'
            ]);
            $text = $request->input('text');
            $rating = $request->input('rating');
            $id = $request->input('id');

            $hasComment = Rating::where('user_id', Auth::user()->id)->where('tourbase_id', $id)->exists();
            if ($hasComment) {
                return back();
            } else {
                Rating::create([
                    'text' => $text,
                    'rating' => $rating,
                    'user_id' => Auth::user()->id,
                    'tourbase_id' => $id
                ]);

                $tourbase = Tourbase::findOrFail($id);
                if($tourbase->rating == 0){
                    $tourRating = $rating;
                }else{
                    $tourRating = ($tourbase->rating + $rating) / 2;
                }
                $tourbase->update(['rating' => $tourRating]);
            }
        });

        return back();
    }
}
