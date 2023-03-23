<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Qiwi\Api\BillPayments;
use Ramsey\Uuid\Uuid;

class MoneyController extends Controller
{
    protected $billPayments;

    public function __construct(BillPayments $billPayments)
    {
        $this->billPayments = $billPayments;
    }

    protected function payment(Request $request)
    {
        $validateFields = $request->validate([
            'date' => 'required',
            'peoples' => 'required|integer',
            'phone' => 'required',
            'tourbase_id' => 'required'
        ]);
        $date = $request->input('date');
        $peoples = $request->input('peoples');
        $phone = $request->input('phone');
        $tourbase_id = $request->input('tourbase_id');

        $secretkey = config('qiwi.secret_key');
        $billPayments = new BillPayments($secretkey);

        $currentDate = Carbon::now(); // получаем текущую дату
        $oneHourLater = $currentDate->addHour(); // добавляем один час к текущей дате
        $iso8601String = $oneHourLater->toIso8601String();

        $uuid = Uuid::uuid4();
        $billId = $uuid->toString();

        $params = array(
            'tourbase_id' => $tourbase_id,
            'phone' => $phone,
            'peoples' => $peoples,
            'date' => $date,
            'billId' => $billId
        );

        $fields = [
            'amount' => 1.00,
            'currency' => 'RUB',
            'comment' => 'test',
            'expirationDateTime' => $iso8601String,
            'email' => 'wotacc0809@gmail.com',
            'account' => Auth::user()->id,
            'successUrl' => 'https://tourclick.online/createNewBooking/?'.http_build_query($params) ,
        ];

        /** @var \Qiwi\Api\BillPayments $billPayments */
        $response = $billPayments->createBill($billId, $fields);
        $payUrl = $response['payUrl'];
        return Redirect::away($payUrl);
    }

}
