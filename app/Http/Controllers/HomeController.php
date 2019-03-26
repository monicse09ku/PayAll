<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fund;
use App\Models\Topup;
use Auth;

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
    public function index(Request $request)
    {
        //$request->session()->flash('danger', 'Task was successful!');
        if ($request->session()->has('authorised') && $request->session()->get('authorised') == false) {
            $request->session()->flash('status', 'You are not authorised.');
        }

        $fund = Fund::where('user_id', Auth::user()->id)->first();
        $topups = Topup::where('status', 'pending')->get();

        return view('home', compact('fund', 'topups'));
    }

    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }
}
