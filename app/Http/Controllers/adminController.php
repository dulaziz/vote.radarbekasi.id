<?php

namespace App\Http\Controllers;

use App\Models\VoteItem;
use App\Models\VoteUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class adminController extends Controller
{
    //
    public function index(){

        $polling_unit = DB::table('vote_units')->get();


        return view('admin', [
            "title" => "Polling Unit",
            "polling_unit" => $polling_unit
        ]);
    }

    function check(Request $request){
        // validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:30'
        ]);

        // dd($request);

        $creds = $request->only('email','password');

        if(Auth::guard('admin')->attempt($creds)){

            return redirect()->route('admin.home');
        }else{
            return redirect()->route('admin.login')->with('fail','Login gagal, silahkan cek data anda!');
        }

    }

    public function logout(){
        Auth::guard('admin')->logout();
        session()->flush();
        return redirect('/');
}

}
