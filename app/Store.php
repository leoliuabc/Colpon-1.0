<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Store extends Model
{
	public function offers()
    {
        return $this->hasMany('App\Offer')->where('status',1);
    }
    public static function initials()
    {
        $initials = DB::table('stores')
                ->select('initials')
        		->distinct()
                ->orderBy('initials', 'asc')
        		->get();
        return $initials;
    }
    public static function top_stores()
    {
        $top_stores = DB::table('stores')
            ->whereIn('id',[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12])
            ->get();
        return $top_stores;
    }
}
