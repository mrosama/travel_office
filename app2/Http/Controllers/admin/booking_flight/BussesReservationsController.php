<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Country;
use App\Http\Requests;
use App\BussesSupplier;
use App\BussesBranch;
use App\BussesReservation;
use App\Http\Models\City;
use App\Client;
use App\Bus;
use Redirect;

class BussesReservationsController extends Controller {

    public function index() {
        $data['bussesReservations'] = BussesReservation::all();
        return view('admin/booking_flight/BussesReservations/index', $data);
    }

    public function create() {
        $data['page_title'] = 'اضافه حجز باص ';
        $data['clients'] = Client::lists('username', 'id');
        $data['countries'] = Country::lists('name', 'code');
        $data['bussesBranches'] = BussesBranch::lists('name', 'id');
        return view('admin/booking_flight/BussesReservations/create', $data);
    }

    public function store(Request $request) {
        $rules = array('clientID' => 'required', 'branch_id' => 'required', 'supplier_id' => 'required', 'bus_id' => 'required', 'startDate' => 'required', 'dayNumber' => 'required',
            'endDate' => 'required', 'countryDeparture' => 'required', 'cityDeparture' => 'required', 'placeDeparture' => 'required', 'latitudeDeparture' => 'required', 'longitudeDeparture' => 'required',
            'countryArrival' => 'required', 'cityArrival' => 'required', 'placeArrival' => 'required', 'latitudeArrival' => 'required', 'longitudeArrival' => 'required', 'notes' => 'required');
        $this->validate($request, $rules);
        $insertDB = BussesReservation::create($request->all());
        if ($insertDB)
            return Redirect::back()->with('success', 'تمت عملية الاضافة بنجاح');
        else
            return Redirect::back()->with('error', 'حدث خطأ اثناء اضافة البيانات يرجى التأكد من البيانات');
    }

    public function show($id) {
//
    }

    public function edit($id) {
        $data['page_title'] = 'تعديل بيانات حجز باص ';
        $data['clients'] = Client::lists('username', 'id');
        $data['countries'] = Country::lists('name', 'code');
        $data['bussesBranches'] = BussesBranch::lists('name', 'id');
        $data['reservation'] = BussesReservation::find($id);
        $data['suppliers'] = BussesSupplier::where('id', $data['reservation']->supplier_id)->select('name', 'id')->get();
        $data['busses'] = Bus::where('supplier_id', $data['reservation']->supplier_id)->select('number', 'id')->get();
        $data['cityDepartures'] = City::where('country_code', $data['reservation']->countryDeparture)->select('name', 'id')->get();
        $data['cityArrivales'] = City::where('country_code', $data['reservation']->cityArrival)->select('name', 'id')->get();
        return view('admin/booking_flight/BussesReservations/edit', $data);
    }

    public function update(Request $request, $id) {
        $rules = array('clientID' => 'required', 'branch_id' => 'required', 'supplier_id' => 'required', 'bus_id' => 'required', 'startDate' => 'required', 'dayNumber' => 'required',
            'endDate' => 'required', 'countryDeparture' => 'required', 'cityDeparture' => 'required', 'placeDeparture' => 'required', 'latitudeDeparture' => 'required', 'longitudeDeparture' => 'required',
            'countryArrival' => 'required', 'cityArrival' => 'required', 'placeArrival' => 'required', 'latitudeArrival' => 'required', 'longitudeArrival' => 'required', 'notes' => 'required');
        $this->validate($request, $rules);
        $updateDB = BussesReservation::find($id)->update($request->all());
        if ($updateDB)
            return Redirect::back()->with('success', 'تمت عملية التحديث بنجاح');
        else
            return Redirect::back()->with('error', 'حدث خطأ اثناء تحديث البيانات يرجى التأكد من البيانات');
    }

    public function destroy($id) {
        $destroyDB = BussesReservation::find($id)->destroy($id);
        if ($destroyDB)
            return Redirect::back()->with('success', 'تمت عملية الحذف بنجاح');
        else
            return Redirect::back()->with('error', 'حدث خطأ اثناء حذف البيانات يرجى التأكد من البيانات');
    }

}
