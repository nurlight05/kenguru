<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

class AdminUserController extends Controller
{
    public function index()
    {
        $request = request();
        $query = "";
        $users = User::where('is_admin', false);

        if ($request->has('query')) {
            $query = $request->get('query');
            $users = $users->where(function($q) use ($query) {
                $q->where('full_name', 'LIKE', '%'.$query.'%')
                    ->orWhere('phone', 'LIKE', '%'.$query.'%')
                    ->orWhere('email', 'LIKE', '%'.$query.'%');
            });
        }

        $users = $users->orderByDesc('created_at')->paginate(30)->onEachSide(3);

        return view('admin.users.index', compact('users'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect()->route('admin.users')->withSuccess('Пользователь успешно удален!');
    }

    public function submit(Request $request)
    {
        if ($request['users'] == null)
            return back()->withErrors('Ничего не выбрано!');

        switch ($request->action) {
            case 'delete':
                try {
                    $users = User::whereIn('id', $request['users'])->get();
                    foreach ($users as $user) {
                        $user->delete();
                    }
                    return redirect()->route('admin.users')->withSuccess('Выбранные пользователи успешно удалены!');
                } catch (Throwable $th) {
                    return back()->withErrors('Произошла ошибка!');
                }
                break;

            default:
                return back()->withErrors('Действие не определено!');
                break;
        }
    }

    public function resetPassword(User $user)
    {
        return view('admin.users.reset-password', compact('user'));
    }

    public function resetPasswordSubmit(User $user, Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|min:8'
        ]);

        $user->password = Hash::make($request['password']);
        $user->save();

        return redirect()->route('admin.users.show', ['user' => $user->id])->withSuccess('Пароль пользователя успешно обновлен!');
    }


    // API
    public function registrationFirst(Request $request)
    {
        if ($request->isMethod('get'))
            return response(
                array(
                    'error' => '1',
                    'description' => 'The GET method is not supported for this route',
                ),
                200
            )->header('Content-Type', 'application/json');

        $validated = Validator::make($request->all(), [
            'full_name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'birthday' => ['required'],
            'phone' => ['required', 'regex:/^[7]{2}[0-9]{9}$/', 'unique:users,phone'],
            'password' => ['required', 'min:8'],
        ]);
		
        if($validated->fails()){
			return response()->json($validated->messages(), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
		}

        // $user = new User;
        // $user->full_name = $request->full_name;
        // $user->email = $request->email;
        // $user->birthday = date('Y-m-d', strtotime($request->birthday));
        // $user->phone = $request->phone;
        // $user->password = Hash::make($request->password);
        // $user->save();

        // $code = mt_rand(100000, 999999);
        // $smsId = DB::table('sms')->insertGetId([
        //     'user_id' => $user->id,
        //     'code' => $code,
        // ]);

        // // send sms code to phone
        // $response = Http::get('https://smsc.ru/sys/send.php?login=kenguru-dostavka&psw=admin123!&phones=' . $request->phone . '&mes=' . $code);

        // $result = array(
        //     'phone' => $request->phone,
        //     'sms_id' => $smsId,
        //     'sms_response' => $response,
        // );

        return response($result, 200)->header('Content-Type', 'text/plain');
    }

    public function resendCode(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'phone' => ['required', 'regex:/^[7]{2}[0-9]{9}$/'],
            'sms_id' => ['required'],
        ]);
		
        if($validated->fails()){
			return response()->json($validated->messages(), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
		}

        $sms = DB::table('sms')->where('id', '=', $request->sms_id)->get();

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
            'phones' => $request->phone,
            'mes' => $code,
        ]);

        $result = array(
            'phone' => $request->phone,
            'sms_id' => $sms->id,
            'sms_response' => $response,
        );

        return response($result, 200)->header('Content-Type', 'text/plain');
    }

    public function registrationSecond(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'phone' => ['required', 'regex:/^[7]{2}[0-9]{9}$/'],
            'sms_id' => ['required'],
            'sms_code' => ['required'],
        ]);
		
        if($validated->fails()){
			return response()->json($validated->messages(), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
		}

        $sms = DB::table('sms')->where('id', '=', $request->sms_id)->first();

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
            
        $user = User::where('phone', $request->phone)->first();
        
        if (!$user)
        return response(
            array(
                'error' => '3',
                'description' => 'User not found by given Phone number',
            ),
            200
        )->header('Content-Type', 'application/json');
        
        $user->api_token = Str::random(60);
        $user->save();
        $user->fresh();
        $token = $user->api_token;

        $result = array(
            'token' => $token,
            'user' => $user,
        );
        
        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function login(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'phone' => ['required', 'regex:/^[7]{2}[0-9]{9}$/'],
            'password' => ['required'],
        ]);
		
        if($validated->fails()){
			return response()->json($validated->messages(), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
		}

        $user = User::where('phone', $request->phone)->first();

        if (!$user)
            return response(
                array(
                    'error' => '3',
                    'description' => 'User not found by given Phone number',
                ),
                200
            )->header('Content-Type', 'application/json');
            
        if (!Hash::check($request->password, $user->password))
            return response(
                array(
                    'error' => '4',
                    'description' => 'Wrong password',
                ),
                200
            )->header('Content-Type', 'application/json');

        $user->api_token = Str::random(60);
        $user->save();
        $user->fresh();
        $token = $user->api_token;

        $result = array(
            'token' => $token,
            'user' => $user,
        );

        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function editProfile(Request $request)
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

        $validated = Validator::make($request->all(), [
            'full_name' => ['required'],
            'password' => ['required'],
            'email' => ['required', 'unique:users,email,' . $user->id],
            'birthday' => ['required'],
        ]);
		
        if($validated->fails()){
			return response()->json($validated->messages(), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
		}

        $user->full_name = $request->full_name;
        $user->birthday = date('Y-m-d', strtotime($request->birthday));
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->fresh();

        $result = array(
            'user' => $user
        );

        return response($result, 200)->header('Content-Type', 'application/json');
    }
}
