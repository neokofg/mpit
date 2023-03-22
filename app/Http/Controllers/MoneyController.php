<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
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
            'date' => 'required|date',
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

        $fields = [
            'amount' => 1.00,
            'currency' => 'RUB',
            'comment' => 'test',
            'expirationDateTime' => $iso8601String,
            'email' => 'wotacc0809@gmail.com',
            'account' => 'client4563',
            'successUrl' => 'http://tourclick.online/createNewBooking/'.$tourbase_id.'/'.$phone.'/'.$peoples.'/'.$date.'/'.$billId ,
        ];

        /** @var \Qiwi\Api\BillPayments $billPayments */
        $response = $billPayments->createBill($billId, $fields);
        $payUrl = $response['payUrl'];
        return Redirect::away($payUrl);
    }

}
