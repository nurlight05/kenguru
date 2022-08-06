<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AdminCourierController extends Controller
{
    public function index()
    {
        $request = request();
        $query = "";
        $couriers = Courier::where('id', '>', 0);

        if ($request->has('query')) {
            $query = $request->get('query');
            $couriers = $couriers->where(function($q) use ($query) {
                $q->where('firstname', 'LIKE', '%'.$query.'%')
                    ->orWhere('lastname', 'LIKE', '%'.$query.'%')
                    ->orWhere('iin', 'LIKE', '%'.$query.'%')
                    ->orWhere('number', 'LIKE', '%'.$query.'%')
                    ->orWhere('email', 'LIKE', '%'.$query.'%');
            });
        }

        $couriers = $couriers->orderByDesc('created_at')->paginate(30)->onEachSide(3);

        return view('admin.couriers.index', compact('couriers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.couriers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'iin' => 'required|numeric|digits:12',
            'email' => 'required|email',
            'number' => 'required',
            'password' => 'required|min:8',
            'password2' => 'required|same:password',
        ]);

        $courier = new Courier;
        $courier->firstname = $request->firstname;
        $courier->lastname = $request->lastname;
        $courier->iin = $request->iin;
        $courier->email = $request->email;
        $courier->number = $request->number;
        $courier->password = Hash::make($request->password);
        $courier->save();

        return redirect()->route('admin.couriers.show', ['courier' => $courier->id])->withSuccess('Курьер успешно создан!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function show(Courier $courier)
    {
        return view('admin.couriers.show', compact('courier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function edit(Courier $courier)
    {
        return view('admin.couriers.edit', compact('courier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courier $courier)
    {
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'iin' => 'required|numeric',
            'email' => 'required|email',
            'number' => 'required',
            'password' => 'nullable|min:8',
        ]);

        $courier->firstname = $request->firstname;
        $courier->lastname = $request->lastname;
        $courier->iin = $request->iin;
        $courier->email = $request->email;
        $courier->number = $request->number;

        if ($request->has('password'))
            $courier->password = Hash::make($request->password);

        $courier->save();
        return redirect()->route('admin.couriers.show', ['courier' => $courier->id])->withSuccess('Данные курьера успешно обновлены!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courier $courier)
    {
        $courier->delete();
        return redirect()->route('admin.couriers')->withSuccess('Курьер успешно удален!');
    }

    public function submit()
    {
        dd(1);
    }

    public function registrationFirst(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'firstname' => ['required'],
            'lastname' => ['required'],
            'iin' => ['required', 'numeric', 'digits:12'],
            'email' => ['required', 'email'],
            'number' => ['required', 'regex:/^[7]{2}[0-9]{9}$/', 'unique:couriers,number'],
            'password' => ['required', 'min:8'],
        ]);
		
        if($validated->fails()){
			return response()->json($validated->messages(), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
		}

        $courier = new Courier;
        $courier->firstname = $request->firstname;
        $courier->lastname = $request->lastname;
        $courier->iin = $request->iin;
        $courier->email = $request->email;
        $courier->number = $request->number;
        $courier->password = Hash::make($request->password);
        $courier->save();
        
        $code = mt_rand(100000, 999999);
        $smsId = DB::table('sms_couriers')->insertGetId([
            'courier_id' => $courier->id,
            'code' => $code,
        ]);

        // send sms code to phone
        $response = Http::post('https://smsc.ru/sys/send.php', [
            'login' => 'nurlight05',
            'psw' => 'Nurbolat1!',
            'phones' => $request->number,
            'mes' => $code,
        ]);

        $result = array(
            'phone' => $request->number,
            'sms_id' => $smsId,
            'sms_response' => $response,
        );

        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function resendCode(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'number' => ['required', 'regex:/^[7]{2}[0-9]{9}$/'],
            'sms_id' => ['required'],
        ]);
		
        if($validated->fails()){
			return response()->json($validated->messages(), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
		}

        $sms = DB::table('sms_couriers')->where('id', '=', $request->sms_id)->get();

        if (!$sms)
            return response(
                array(
                    'error' => '1',
                    'description' => 'SMS not found by given Id',
                ),
                200
            )->header('Content-Type', 'application/json');

        $code = mt_rand(100000, 999999);
        $sms->code = $code;
        $sms->save();
        // send sms code to phone
        $response = Http::post('https://smsc.ru/sys/send.php', [
            'login' => 'nurlight05',
            'psw' => 'Nurbolat1!',
            'phones' => $request->number,
            'mes' => $code,
        ]);

        $result = array(
            'phone' => $request->number,
            'sms_id' => $sms->id,
            'sms_response' => $response,
        );

        return response($result, 200)->header('Content-Type', 'text/plain');
    }

    public function registrationSecond(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'number' => ['required', 'regex:/^[7]{2}[0-9]{9}$/'],
            'sms_id' => 'required',
            'sms_code' => 'required',
        ]);
		
        if($validated->fails()){
			return response()->json($validated->messages(), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
		}

        $sms = DB::table('sms_couriers')->where('id', '=', $request->sms_id)->first();

        if (!$sms)
            return response(
                array(
                    'error' => '1',
                    'description' => 'SMS not found by given Id',
                ),
                200
            )->header('Content-Type', 'application/json');

        $sms_code = $sms->code;

        if ($request->sms_code != $sms_code)
            return response(
                array(
                    'error' => '2',
                    'description' => 'Wrong code number',
                ),
                200
            )->header('Content-Type', 'application/json');
            
        $courier = Courier::where('number', $request->number)->first();

        if (!$courier)
            return response(
                array(
                    'error' => '3',
                    'description' => 'Courier not found by given Phone number',
                ),
                200
            )->header('Content-Type', 'application/json');

        $courier->api_token = Str::random(60);
        $courier->save();
        $courier->fresh();            
        $token = $courier->api_token;

        $result = array(
            'token' => $token,
            'courier' => $courier,
        );
            
        return response($result, 200)->header('Content-Type', 'application/json'); 
    }

    public function login(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'number' => ['required', 'regex:/^[7]{2}[0-9]{9}$/'],
            'password' => 'required',
        ]);
		
        if($validated->fails()){
			return response()->json($validated->messages(), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
		}
            
        $courier = Courier::where('number', $request->number)->first();

        if (!$courier)
            return response(
                array(
                    'error' => '3',
                    'description' => 'Courier not found by given Phone number',
                ),
                200
            )->header('Content-Type', 'application/json');

        if (!Hash::check($request->password, $courier->password))
            return response(
                array(
                    'error' => '4',
                    'description' => 'Wrong password',
                ),
                200
            )->header('Content-Type', 'application/json');

        $courier->api_token = Str::random(60);
        $courier->save();
        $courier->fresh();            
        $token = $courier->api_token;

        $result = array(
            'token' => $token,
            'courier' => $courier,
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

        $courier = Courier::where('api_token', $token)->first();

        if (!$courier)
            return response(
                array(
                    'error' => '6',
                    'description' => 'Courier not found by given token',
                ),
                200
            )->header('Content-Type', 'application/json');

        $orders = Order::doesntHave('courier')->get();

        $result = array(
            'orders' => $orders,
        );
            
        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function getAcceptedOrders(Request $request)
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

        $courier = Courier::where('api_token', $token)->first();

        if (!$courier)
            return response(
                array(
                    'error' => '6',
                    'description' => 'Courier not found by given token',
                ),
                200
            )->header('Content-Type', 'application/json');

        $orders = $courier->orders;

        $result = array(
            'orders' => $orders,
        );
            
        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function getOrder(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'order_id' => 'required',
        ]);
		
        if($validated->fails()){
			return response()->json($validated->messages(), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
		}

        $token = $request->bearerToken();

        if (!$token)
            return response(
                array(
                    'error' => '5',
                    'description' => 'Token is missing',
                ),
                200
            )->header('Content-Type', 'application/json');

        $courier = Courier::where('api_token', $token)->first();

        if (!$courier)
            return response(
                array(
                    'error' => '6',
                    'description' => 'Courier not found by given token',
                ),
                200
            )->header('Content-Type', 'application/json');

        $order = Order::where('id', $request->order_id)->first();

        if (!$order)
            return response(
                array(
                    'error' => '7',
                    'description' => 'Order not found by given Id',
                ),
                200
            )->header('Content-Type', 'application/json');

        $result = array(
            'order' => $order,
        );
            
        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function acceptOrder(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'order_id' => 'required',
        ]);
		
        if($validated->fails()){
			return response()->json($validated->messages(), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
		}

        $token = $request->bearerToken();

        if (!$token)
            return response(
                array(
                    'error' => '5',
                    'description' => 'Token is missing',
                ),
                200
            )->header('Content-Type', 'application/json');

        $courier = Courier::where('api_token', $token)->first();

        if (!$courier)
            return response(
                array(
                    'error' => '6',
                    'description' => 'Courier not found by given token',
                ),
                200
            )->header('Content-Type', 'application/json');

        $order = Order::where('id', $request->order_id)->first();

        if (!$order)
            return response(
                array(
                    'error' => '7',
                    'description' => 'Order not found by given Id',
                ),
                200
            )->header('Content-Type', 'application/json');

        if ($order->courier()->exists())
            return response(
                array(
                    'error' => '8',
                    'description' => 'Order is already taken by another courier',
                ),
                200
            )->header('Content-Type', 'application/json');

        $order->courier()->associate($courier);
        $order->save();
        $order->fresh();

        $result = array(
            'order' => $order,
        );
            
        return response($result, 200)->header('Content-Type', 'application/json');
    }
}
