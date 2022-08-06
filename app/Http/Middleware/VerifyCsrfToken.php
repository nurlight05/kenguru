<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/api/registration/1',
        '/api/registration/2',
        '/api/login',
        '/api/profile/edit',
        '/api/order',
        '/api/order-details',
        '/api/all-orders',
        '/api/payment',
        '/api/resend',
        '/api/couriers/registration/1',
        '/api/couriers/registration/2',
        '/api/couriers/login',
        '/api/courier/orders/all',
        '/api/courier/orders/accepted',
        '/api/courier/orders/order',
        '/api/courier/orders/order/accept',
    ];
}
