<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Country;
use App\Http\Requests;
use App\Http\Requests\Travel_sectionRequest;
use App\Travel_office;
use App\Travel_section;
use Redirect;

class Travel_sectionsController extends Controller {

    public function index() {
        $all_sections = Travel_section::all();
        $all_office = Travel_office::all();
        return view('admin.travel_section.index', compact('all_sections', 'all_office'));
    }

    public function create() {
        $all_country = Country::all();
        $all_office = Travel_office::lists('name', 'id');
        return view('admin.travel_section.create', compact('all_office', 'all_country'));
    }

    public function store(Travel_sectionRequest $request) {
        Travel_section::create($request->all());
        return Redirect::back()->with('success', 'لقد تمت عملية الاضافة بنجاح !');
    }

    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $travelSection = Travel_section::find($id);
        $all_office = Travel_office::all();
        return view('admin.travel_section.edit', compact('travelSection', 'all_office'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        Travel_section::find($id)->update($request->all());
        return Redirect::back()->with('success', 'لقد تمت عملية التعديل بنجاح !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Travel_section::find($id)->destroy($id);
        return Redirect::back()->with('success', 'لقد تمت عملية الحذف بنجاح !');
    }

    public function delete_section($id) {
        Travel_section::find($id)->delete();
        return Redirect::back()->with('success', 'لقد تمت عملية الحذف بنجاح');
    }

}
