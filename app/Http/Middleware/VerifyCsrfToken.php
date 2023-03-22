<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/6112927855:AAF-Rc36LyNcLeFuyjJw8vdEfDBw_QEnhMo/webhook',
        '/createNewBooking',
        '/createNewBooking/{id}/{phone}/{peoples}/{date}/{billId}'
    ];
}
