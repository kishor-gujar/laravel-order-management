<?php

namespace App\Http\Controllers;

use App\Month;
use Illuminate\Http\Request;

class MonthController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Month::whereIn('id',array_keys($request->month))->update(['status' => 1]);
        Month::whereNotIn('id',array_keys($request->month))->update(['status' => 0]);

        return back();
    }


}

















