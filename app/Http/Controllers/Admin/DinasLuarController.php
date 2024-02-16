<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DinasLuar;
use Illuminate\Http\Request;

class DinasLuarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.admin.dinasLuar.dinas-luar');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.dinasLuar.create');
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
     * @param  \App\Models\DinasLuar  $dinasLuar
     * @return \Illuminate\Http\Response
     */
    public function show(DinasLuar $dinasLuar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DinasLuar  $dinasLuar
     * @return \Illuminate\Http\Response
     */
    public function edit(DinasLuar $dinasLuar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DinasLuar  $dinasLuar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DinasLuar $dinasLuar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DinasLuar  $dinasLuar
     * @return \Illuminate\Http\Response
     */
    public function destroy(DinasLuar $dinasLuar)
    {
        //
    }
}
