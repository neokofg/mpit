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
use Illuminate\Support\Facades\Validator;

class TourBaseController extends Controller
{
    protected function createTourBase(Request $request)
    {
        $validateFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'coords' => 'required',
            'location' => 'required',
            'images' => 'required',
            'images.*' =>'mimes:jpeg,png,jpg,gif,svg',
            'classification' => 'required'
        ]);
        $exists = TourbaseUser::where('user_id', Auth::user()->id)->exists();
        if ($exists) {
            return back();
        } else {
            try {
                DB::beginTransaction();

                $name = $request->input('name');
                $description = $request->input('description');
                $coords = $request->input('coords');
                $location = $request->input('location');
                $classification = $request->input('classification');
                foreach($request->file('images') as $key => $image) {
                    $fileName = date('YmdHi').$image->hashName();
                    $image->move(public_path('images'), $fileName);
                    $insert[$key]['name'] = $fileName;
                }

                $tourbase = Tourbase::create([
                    'name' => $name,
                    'description' => $description,
                    'coords' => $coords,
                    'location' => $location,
                    'images' => json_encode($insert),
                    'classification' => implode(',', $classification)
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
    }
    protected function createNewBooking(Request $request)
    {
//        {id}/{phone}/{peoples}/{date}/{billId}

        $id = $request->input('id');
        $phone = $request->input('phone');
        $peoples = $request->input('peoples');
        $date = $request->input('date');
        $billId = $request->input('billId');
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
                'text' => 'К вам пришло новое бронирование!'.PHP_EOL.'Дата: '.$date.PHP_EOL.'Телефон: '.$phone.PHP_EOL.'Людей: '.$peoples,
            ];
            $response = Http::get("https://api.telegram.org/bot6112927855:AAF-Rc36LyNcLeFuyjJw8vdEfDBw_QEnhMo/sendMessage?" . http_build_query($data));
        }
        return to_route('profile');
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
