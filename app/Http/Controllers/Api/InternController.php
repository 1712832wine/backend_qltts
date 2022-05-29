<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Intern;
use Illuminate\Support\Facades\Storage;

class InternController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // [GET] /interns
    public function index()
    {
        $response = array('response' => '', 'success'=>false);
        return Intern::paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // [POST] /interns
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:interns|min:9|max:15',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'result' => 'required'
        ]);
        // process the request
        $intern =  new Intern;
        $intern->name = $request->name;
        $intern->phone = $request->phone;
        $intern->major = $request->major;
        $intern->school_year = $request->school_year;
        $intern->start_date = $request->start_date;
        $intern->end_date = $request->end_date;
        $intern->result = $request->result;
        $intern->save();
        $response['response'] = 'Created Success';
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // [GET] /interns/:id
    public function show($id)
    {
        return Intern::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // [PUT/PATCH] /interns/:id
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'name' => 'required',
            'phone' => 'required|min:9|max:15|unique:interns,phone,'.$id,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'result' => 'required'
        ]);
        $intern = Intern::findOrFail($id);
        $intern->name = $request->name;
        $intern->phone = $request->phone;
        $intern->major = $request->major;
        $intern->school_year = $request->school_year;
        $intern->start_date = $request->start_date;
        $intern->end_date = $request->end_date;
        $intern->result = $request->result;
        $intern->save();
        $response['response'] = 'Edit Success';
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // [DELETE] /interns/:id
    public function destroy($id)
    {
        Intern::destroy($id);
    }
}



// [GET] /interns => INDEX
// [POST] /interns => CREATE
// [GET] /interns/:id => SHOW
// [PUT/PATCH] /interns/:id => UPDATE
// [DELETE] /interns/:id => DELETE