<?php 

namespace App\Http\Controllers\StorageCategory;

use App\Exceptions\Controllers\ControllerException as Exception;
use App\Models\StorageCategory\StorageCategory;

/**
 * Storage Category resource methods
 */ 
trait StorageCategoryResource 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StorageCategory::simplePaginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return StorageCategory::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }  	    
}