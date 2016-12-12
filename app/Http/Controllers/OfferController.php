<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;
use App\Store;
use App\Offer;

class OfferController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($store_id,$id)
    {
        $top_stores = Store::top_stores();
        $top_offers = Offer::top_offers();
        $offer = Offer::find($id);
        $store = Store::find($store_id);
        return view('offer',['top_stores' => $top_stores,'offer' => $offer,'store' => $store,'top_offers' => $top_offers]);
    }

    public function top_offers()
    {
        $top_stores = Store::top_stores();
        $top_offers = Offer::top_offers();
        return view('topoffer',['top_stores' => $top_stores,'top_offers' => $top_offers]);
    }
}
