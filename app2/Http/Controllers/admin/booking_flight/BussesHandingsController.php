<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\BussesHanding;
use App\Driver;
use App\Bus;
use Redirect;

class BussesHandingsController extends Controller {

    public function index() {
        $data['bussesHandings'] = BussesHanding::all();
        return view('admin/booking_flight/BussesHandings/index', $data);
    }

    public function create() {
        $data['drivers'] = Driver::lists('name', 'id');
        $data['busses'] = Bus::lists('number', 'id');
        return view('admin/booking_flight/BussesHandings/create', $data);
    }

    public function store(Request $request) {
        $rules = array('driverID' => 'required', 'busID' => 'required', 'benzeneCoupon' => 'required', 'amountCoupon' => 'required', 'kiloMeter' => 'required', 'notes' => 'required');
        $this->validate($request, $rules);
        $insertDB = BussesHanding::create($request->all());
        if ($insertDB)
            return Redirect::back()->with('success', 'تمت عملية الاضافة بنجاح');
        else
            return Redirect::back()->with('error', 'حدث خطأ اثناء اضافة البيانات يرجى التأكد من البيانات');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $data['drivers'] = Driver::lists('name', 'id');
        $data['busses'] = Bus::lists('number', 'id');
        $data['bussesHanding'] = BussesHanding::find($id);
        return view('admin/booking_flight/BussesHandings/edit', $data);
    }

    public function update(Request $request, $id) {
        $rules = array('driverID' => 'required', 'busID' => 'required', 'benzeneCoupon' => 'required', 'amountCoupon' => 'required', 'kiloMeter' => 'required', 'notes' => 'required');
        $this->validate($request, $rules);
        $updateDB = BussesHanding::find($id)->update($request->all());
        if ($updateDB)
            return Redirect::back()->with('success', 'تمت عملية التحديث بنجاح');
        else
            return Redirect::back()->with('error', 'حدث خطأ اثناء تحديث البيانات يرجى التأكد من البيانات');
    }

    public function destroy($id) {
        $destroyDB = BussesHanding::find($id)->destroy($id);
        if ($destroyDB)
            return Redirect::back()->with('success', 'تمت عملية الحذف بنجاح');
        else
            return Redirect::back()->with('error', 'حدث خطأ اثناء حذف البيانات يرجى التأكد من البيانات');
    }

}
