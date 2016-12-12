<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Offer extends Model
{
	public static function top_offers()
    {
        $top_offers = DB::table('offers')
        		->join('stores','offers.store_id','=','stores.id')
        		->select('offers.*','stores.name as store_name','stores.titleslug as store_titleslug')
                ->whereIn('offers.id',[21, 22, 31, 32, 58, 59, 92, 93, 111, 112, 153, 154, 173, 174, 183, 184])
        		->get();
        return $top_offers;
    }
}
