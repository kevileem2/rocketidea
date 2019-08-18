<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\User;
use Auth;

class ShopController extends Controller
{
    /**
      * Create a new controller instance.
      * To make sure only registered users can use the shop to buy credits
      * @return void
      */
    public function __construct(){
        $this->middleware('auth');
    }

    public function getIndex(){
        $shop = Shop::all();
        return view('shop.index', compact('shop'));
    }

    public function postPayment(){
        $user = Auth::user();
        $total = (request("total")) ? request('total') : null;
        $total_user_RP = $total + $user->credits;
        $user->credits = $total_user_RP;
        $user->save();
        return view('shop.confirmed', compact('total', 'total_user_RP'));
    }
}
