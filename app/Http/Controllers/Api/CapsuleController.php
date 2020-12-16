<?php

namespace App\Http\Controllers\Api;

use App\Capsule;
use App\Filters\CapsuleFilters;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CapsuleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param CapsuleFilters $filters
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CapsuleFilters $filters)
    {
        $capsules = Capsule::filter($filters)->with('missions')->get();

        return $capsules;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Capsule  $capsule
     * @return \Illuminate\Http\Response
     */
    public function show($capsule_serial)
    {
        $capsule = Capsule::where('capsule_serial', $capsule_serial)->with('missions')->firstOrFail();

        return $capsule;
    }
}
