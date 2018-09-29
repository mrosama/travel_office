<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\Country;
use App\BussesBranch;
use Redirect;

class BussesBranchesController extends Controller {

    public function index() {
        $data['page_title'] = ' فروع مزودين الباصات';
        $data['branches'] = BussesBranch::all();
        return view('admin/booking_flight/BussesBranches/index', $data);
    }

    public function create() {
        $data['page_title'] = 'اضافة فرع لمزودين الباصات';
        $data['countries'] = Country::lists('name', 'code');
        return view('admin/booking_flight/BussesBranches/create', $data);
    }

    public function store(Request $request) {
        $rules = array('name' => 'required', 'country' => 'required', 'city' => 'required', 'mangerName' => 'required', 'phone' => 'required', 'email' => 'required');
        $this->validate($request, $rules);
        $insertDB = BussesBranch::create($request->all());
        if ($insertDB)
            return Redirect::back()->with('success', 'تمت عملية الاضافة بنجاح');
        else
            return Redirect::back()->with('error', 'حدث خطأ اثناء اضافة البيانات يرجى التأكد من البيانات');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $data['page_title'] = 'تعديل بيانات فرع لمزودين الباصات';
        $data['branch'] = BussesBranch::find($id);
        $data['countries'] = Country::lists('name', 'code');
        $data['cities'] = \App\Http\Models\City::where('country_code', $data['branch']->country)->get();
        return view('admin/booking_flight/BussesBranches/edit', $data);
    }

    public function update(Request $request, $id) {
        $rules = array('name' => 'required', 'country' => 'required', 'city' => 'required', 'mangerName' => 'required', 'phone' => 'required', 'email' => 'required');
        $this->validate($request, $rules);
        $updateDB = BussesBranch::find($id)->update($request->all());
        if ($updateDB)
            return Redirect::back()->with('success', 'تمت عملية التحديث بنجاح');
        else
            return Redirect::back()->with('error', 'حدث خطأ اثناء تحديث البيانات يرجى التأكد من البيانات');
    }

    public function destroy($id) {
        $destroyDB = BussesBranch::find($id)->destroy($id);
        if ($destroyDB)
            return Redirect::back()->with('success', 'تمت عملية الحذف بنجاح');
        else
            return Redirect::back()->with('error', 'حدث خطأ اثناء حذف البيانات يرجى التأكد من البيانات');
    }

}
