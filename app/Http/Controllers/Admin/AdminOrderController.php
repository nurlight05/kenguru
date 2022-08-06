<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminOrderController extends Controller
{
    public function index()
    {
        $request = request();
        $query = "";
        $orders = Order::where('id', '>', 0);

        if ($request->has('query')) {
            $query = $request->get('query');
            $orders = $orders->where(function($q) use ($query) {
                $q->where('id', 'LIKE', '%'.$query.'%')
                    ->orWhere('created_at', 'LIKE', '%'.$query.'%');
            });
        }

        $orders = $orders->orderByDesc('created_at')->paginate(30)->onEachSide(3);

        return view('admin.orders.index', compact('orders'));
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

        $order = new Order($request->all());
        $user->orders()->save($order);

        $result = array(
            'order' => $order,
        );

        return response($result, 200)->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders')->withSuccess('Заказ успешно удален!');
    }

    public function submit(Request $request)
    {
        if ($request['orders'] == null)
            return back()->withErrors('Ничего не выбрано!');

        switch ($request->action) {
            case 'delete':
                try {
                    $orders = Order::whereIn('id', $request['orders'])->get();
                    foreach ($orders as $order) {
                        $order->delete();
                    }
                    return redirect()->route('admin.orders')->withSuccess('Выбранные заказы успешно удалены!');
                } catch (Throwable $th) {
                    return back()->withErrors('Невозможно удалить!');
                }
                break;

            default:
                return back()->withErrors('Действие не определено!');
                break;
        }
    }

    public function getOrder(Request $request)
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

        $result = array(
            'orders' => $order,
        );

        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function getAllOrders(Request $request)
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

        $orders = $user->orders;

        $result = array(
            'orders' => $orders,
        );

        return response($result, 200)->header('Content-Type', 'application/json');
    }
}
