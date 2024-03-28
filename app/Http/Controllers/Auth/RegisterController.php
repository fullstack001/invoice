<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use App\Models\Industry;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'company' => ['required', 'string', 'min:8', 'unique:companies,name'],
            'industry_id' => ['required', 'exists:industries,id']
        ]);
    }

    public function showRegistrationForm()
    {
        $industries = Industry::all(); 

        return view('auth.register', compact('industries'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        $company = Company::create([
            'name' => $data['company'],
            'industry_id' => $data['industry_id'],
        ]);

        $lastCompanyId = $company->id;         

        return User::create([           
            'company_id' => $lastCompanyId,
            'industry_id' => $data['industry_id'],
            'name' => $data['name'],
            'email' => $data['email'],            
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user)); // Trigger the Registered event

        return redirect()->route('verification.notice'); // Redirect to the verification notice page


    }


    
}
