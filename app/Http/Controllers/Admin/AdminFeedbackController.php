<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = request();
        $query = "";
        $feedbacks = Feedback::where('id', '>', 0);

        if ($request->has('query')) {
            $query = $request->get('query');
            $feedbacks = $feedbacks->where(function($q) use ($query) {
                $q->where('id', 'LIKE', '%'.$query.'%')
                    ->orWhere('created_at', 'LIKE', '%'.$query.'%')
                    ->orWhere('message', 'LIKE', '%'.$query.'%');
            });
        }

        $feedbacks = $feedbacks->orderByDesc('created_at')->paginate(30)->onEachSide(3);

        return view('admin.feedbacks.index', compact('feedbacks'));
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
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        return view('admin.feedbacks.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('admin.feedbacks')->withSuccess('Отзыв успешно удален!');
    }

    public function submit(Request $request)
    {
        if ($request['feedbacks'] == null)
            return back()->withErrors('Ничего не выбрано!');

        switch ($request->action) {
            case 'delete':
                try {
                    $feedbacks = Feedback::whereIn('id', $request['feedbacks'])->get();
                    foreach ($feedbacks as $feedback) {
                        $feedback->delete();
                    }
                    return redirect()->route('admin.feedbacks')->withSuccess('Выбранные отзывы успешно удалены!');
                } catch (\Throwable $th) {
                    return back()->withErrors('Невозможно удалить!');
                }
                break;

            default:
                return back()->withErrors('Действие не определено!');
                break;
        }
    }
}
