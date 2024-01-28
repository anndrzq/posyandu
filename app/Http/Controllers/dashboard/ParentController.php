<?php

namespace App\Http\Controllers\dashboard;

use App\Models\family;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParentController extends Controller
{
    public function index()
    {
        $parents = family::select('mother_name', 'father_name', 'many_kids', 'city', 'phone_number')->get();
        return view('content.dashboard.data-master.parent.index', ['parents' => $parents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit(family $family)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, family $family)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(family $family)
    {
        //
    }
}
