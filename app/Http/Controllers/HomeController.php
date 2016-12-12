<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Store;
use App\Offer;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $top_stores = Store::top_stores();
        $top_offers = Offer::top_offers();
        return view('home',['top_stores' => $top_stores,'top_offers' => $top_offers]);
    }
}
