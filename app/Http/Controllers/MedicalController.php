<?php

namespace App\Http\Controllers;

use App\Models\medical;
use App\Http\Requests\StoremedicalRequest;
use App\Http\Requests\UpdatemedicalRequest;

class MedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremedicalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(medical $medical)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(medical $medical)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemedicalRequest $request, medical $medical)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(medical $medical)
    {
        //
    }
}
