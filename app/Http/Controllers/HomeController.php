<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use App\Models\Teacher;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('home');
    }


    public function userShow()
    {
        $teacher_id = Auth::user()->id;
        $teacher = Teacher::findOrFail($teacher_id);
        return view('users.show', compact('teacher'));
    }

    public function userEdit()
    {
        $teacher_id = Auth::user()->id;
        $teacher = Teacher::findOrFail($teacher_id);
        return view('users.edit', compact('teacher'));
    }

    public function userUpdate(Request $request)
    {
        $teacher_id = Auth::user()->id;
        $teacher = Teacher::findOrFail($teacher_id);

        //バリデーション
        $validated = $request->validate([
            'family_name'      => 'required|string|max:255',
            'given_name'       => 'required|string|max:255',
            'email_company'    => 'required|email|unique:teachers,email_company,' . $teacher->id,
            'phone_company'    => 'nullable|string|max:20',
            'email_private'    => 'nullable|email|unique:teachers,email_private,' . $teacher->id,
            'phone_private'    => 'nullable|string|max:20',
            'birth_date'       => 'required|date',
            'meeting_url'      => 'nullable|url',
        ]);

        $teacher->update($validated);

        return to_route('users.show', compact('teacher'))->with('success', '講師情報を更新しました。');;
    }
}
