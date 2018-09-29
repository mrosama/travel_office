<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\BusStopsRequest;
use App\BusStop;
use App\Upload;
use App\Http\Models\City;
use App\Http\Models\Country;
use Redirect;
use File;

class BusStopsController extends Controller {

    public function index() {
        $data['BusStops'] = BusStop::all();

        return view('admin.booking_flight.BusStops.index', $data);
    }

    public function create() {
        $countries = Country::lists('name', 'code');
        return view('admin.booking_flight.BusStops.create', ["countries" => $countries]);
    }

    public function store(BusStopsRequest $request, Upload $upload) {
        if ($request->logo != null)
            $logo = $upload->uploadFile($request->logo, 'busStops');
        else
            $logo = "/noimage.gif";

        if ($request->commercial_reg_img != null)
            $commercial_reg_img = $upload->uploadFile($request->commercial_reg_img, 'busStops');
        else
            $commercial_reg_img = "/noimage.gif";

        BusStop::create($request->except('logo', 'commercial_reg_img') + ['logo' => $logo, 'commercial_reg_img' => $commercial_reg_img]);

        return Redirect::back()->with('global_s', 'لقد تم اضافة الموقف بنجاح');
    }

    public function show($id) {
        
    }

    public function edit($id) {
        $data['busStop'] = BusStop::find($id);
        $data['countries'] = Country::lists('name', 'code');
        $data['cities'] = City::where('country_code', $data['busStop']->country)->get();
        $data['city'] = City::find($data['busStop']->city);

        if ($data['busStop'] == null)
            return Redirect::to('admin/busStops');
        return view('admin.booking_flight.BusStops.edit', $data);
    }

    public function update(BusStopsRequest $request, Upload $upload, $id) {
        $busStop = BusStop::find($id);

        if ($request->logo != null) {
            $logo = $upload->uploadFile($request->logo, 'busStops');
            File::delete(public_path() . $busSup->logo);
        } else
            $logo = $busStop->logo;

        if ($request->commercial_reg_img != null) {
            $commercial_reg_img = $upload->uploadFile($request->commercial_reg_img, 'busStops');
            File::delete(public_path() . $busSup->commercial_reg_img);
        } else
            $commercial_reg_img = $busStop->commercial_reg_img;

        $busStop->update($request->except('logo', 'commercial_reg_img') + ['logo' => $logo, 'commercial_reg_img' => $commercial_reg_img]);
        return Redirect::back()->with('global_s', 'لقد تم تعديل بيانات الموقف بنجاح');
    }

    public function destroy($id) {
        $busSup = BusStop::find($id);

        if ($busSup->logo != "/noimage.gif")
            File::delete(public_path() . $busSup->logo);
        if ($busSup->commercial_reg_img != "/noimage.gif")
            File::delete(public_path() . $busSup->commercial_reg_img);

        $busSup->delete();

        return Redirect::back()->with('global_s', 'لقد تم حذف بيانات الموقف بنجاح');
    }

}
