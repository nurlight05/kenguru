<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use App\Models\Feedback;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('is_admin', false)->count();
        $totalCouriers = Courier::all()->count();
        $totalOrders = Order::all()->count();
        $totalFeedbacks = Feedback::all()->count();
        return view('admin.main.index', compact('totalUsers', 'totalCouriers', 'totalOrders', 'totalFeedbacks'));
    }

    public function profile()
    {
        return view('admin.profile.index');
    }

    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $password = Hash::make($request->passwordNew);

        if (Hash::check($request->password, $user->password)) {
            if ($request->passwordNew != null)
                $user->password = $password;
            $user->save();
            return redirect()->route('admin.profile')->withSuccess('Данные админа успешно изменены!');
        } else {
            return back()->withInput()->withErrors('Неправильный пароль!');
        }
    }
}
