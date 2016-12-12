<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;
use App\Store;
use App\Offer;

class SitemapController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        $offers = Offer::where('status',1)->get();
        return view('sitemap',['stores' => $stores, 'offers' => $offers]);
    }
}
