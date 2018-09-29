<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\TransportTypeRequest;
use App\Http\Models\City;
use App\Http\Models\Country;
use App\TransportType;
use App\Transportation;
use DB;
use Redirect;

class TransportTypeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $transports = TransportType::all();
        return view('admin.transport_type.index', compact('transports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data['countries'] = Country::lists('name', 'code');
        $data['transportations'] = Transportation::lists('transName', 'id');
        return view('admin.transport_type.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransportTypeRequest $request) {
        TransportType::create($request->all());
        return Redirect::back()->with('success', 'تمت عملية الاضافة بنجاح ! ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $transports = TransportType::find($id);
        $transportations = Transportation::lists('transName', 'id');
        $cities = City::where('country_code', $transports->country_id)->lists('name', 'id');
        $countries = Country::lists('name', 'code');
        return view('admin.transport_type.edit', compact('transports', 'countries', 'cities' , 'transportations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransportTypeRequest $request, $id) {
        TransportType::find($id)->update($request->all());
        return Redirect::back()->with('success', 'تمت عملية التعديل بنجاح ! ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        TransportType::destroy($id);
        return Redirect::back()->with('success', 'تم الحذف بنجاح');
    }

    public function getTransportType() {
        $city_from = $_GET['city_from'];
        $city_to = $_GET['city_to'];
        $transport_type = TransportType::where('city_from', '=', $city_from)->where('city_to', '=', $city_to)
                ->orWhere(function ($query ) use($city_to, $city_from) {
                    $query->where('city_from', '=', $city_to)
                    ->where('city_to', '=', $city_from);
                })
                ->get();
        return $transport_type;
    }

    public function getDuration() {
        $transport_id = $_GET['transport_id'];
        $duration = TransportType::find($transport_id)->duration;
        return $duration;
    }

}
