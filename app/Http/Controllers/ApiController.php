<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiRequest;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_request()
    {
        //
        $apirequests = ApiRequest::all();
        return view('admin.api', compact('apirequests'));
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
    public function store_request(Request $request)
    {
        //dd($request);
        /*
        //バリデーションチェック 必要なら
        $validatedData = $request->validate([
            'title' => ['unique:videos,title']
        ]);
        dd($validatedData);
         */

        //api_requestsテーブルに登録
        $apirequest = new ApiRequest;
        $apirequest->url = $request->InputUrl;
        $apirequest->part = $request->InputParamPart;
        $apirequest->order = $request->InputParamOrder;
        $apirequest->type = $request->InputParamType;
        $apirequest->videocategoryid = $request->InputParamVideocategoryid;
        $apirequest->maxresults = $request->InputParamMaxresults;
        $apirequest->save();

        return redirect('/admin/request');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
