<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = $request->bearerToken();
        
        if (!$token)
            return response(
                array(
                    'error' => '5',
                    'description' => 'Token is missing',
                ),
                200
            )->header('Content-Type', 'application/json');

        $user = User::where('api_token', $token)->first();

        if (!$user)
            return response(
                array(
                    'error' => '7',
                    'description' => 'User not found by given token',
                ),
                200
            )->header('Content-Type', 'application/json');

        $order = Order::find($request->order_id);

        if (!$order)
            return response(
                array(
                    'error' => '8',
                    'description' => 'Order not found by such Id',
                ),
                200
            )->header('Content-Type', 'application/json');

        $payment = Payment::create([
            "status" => "success",
            "order_id" => $order->id,
        ]);

        $result = array(
            'payment' => $payment,
        );

        return response($result, 200)->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
