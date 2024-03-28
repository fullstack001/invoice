<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Company;
use App\Rules\CurrentPasswordRule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function root()
    {
        return view('dashboard.index');
    }

    public function index(){
        return view('dashboard.index');
    }

    // public function index(Request $request)
    // {        
    //     if (view()->exists($request->path())) {
    //         return view($request->path());
    //     }
    //     return view('errors.404');
    // }

    public function profile(Request $request){
        $user = User::find(auth()->id());
        $company = Company::find($user->id)->name;        
        return view('dashboard.profile',  compact('company'));
    }

    public function profileUpdate(Request $request){
        $request->validate([            
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
       
        // Update avatar
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('images/users', 'public');
            auth()->user()->avatar = $avatarPath;
        }

         // Update name and email
         auth()->user()->name = $request->name;
         auth()->user()->email = $request->email;

        // Update password
        if ($request->password) {
            if (Hash::check($request->current_password, auth()->user()->password)) {
                auth()->user()->password = Hash::make($request->password);
            } else {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
        }

        auth()->user()->save();

        return redirect()->back()->with('success', 'Profile updated successfully');

    }
}
