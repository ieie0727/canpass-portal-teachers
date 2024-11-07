<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'family_name' => ['required', 'string', 'max:255'],
            'given_name' => ['required', 'string', 'max:255'],
            'email_company' => ['required', 'string', 'email', 'max:255', 'unique:teachers'],
            'phone_company' => ['nullable', 'string', 'max:20'],
            'email_private' => ['nullable', 'string', 'email', 'max:255'],
            'phone_private' => ['nullable', 'string', 'max:20'],
            'birth_date' => ['required', 'date'],
            'hire_date' => ['required', 'date'],
            'retirement_date' => ['nullable', 'date'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new teacher instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Teacher
     */
    protected function create(array $data)
    {
        return Teacher::create([
            'role' => $data['role'] ?? 'teacher',
            'family_name' => $data['family_name'],
            'given_name' => $data['given_name'],
            'email_company' => $data['email_company'],
            'phone_company' => $data['phone_company'] ?? null,
            'email_private' => $data['email_private'] ?? null,
            'phone_private' => $data['phone_private'] ?? null,
            'birth_date' => $data['birth_date'],
            'hire_date' => $data['hire_date'],
            'retirement_date' => $data['retirement_date'] ?? null,
            'status' => $data['status'] ?? '稼働',
            'password' => bcrypt($data['password']),
        ]);
    }
}
