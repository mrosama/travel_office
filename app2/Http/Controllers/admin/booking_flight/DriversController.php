<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\DriverRequest;
use App\Client;
use App\Driver;
use App\BussesSupplier;
use Redirect;
use App\Http\Models\Country;
use App\Http\Models\City;

class DriversController extends Controller {

    public function index() {
        $drivers = Driver::all();
        return view('admin.booking_flight.drivers.index', ['drivers' => $drivers, 'i' => 0]);
    }

    public function create() {
        $countries = Country::lists('name', 'code');
        $busses_suppliers = BussesSupplier::lists('name', 'id');
        return view('admin.booking_flight.drivers.create', ['busses_suppliers' => $busses_suppliers, 'countries' => $countries]);
    }

    public function store(DriverRequest $request, Client $upload) {
        if ($request->photo != null)
            $photo = $upload->uploadFile($request->photo);
        else
            $photo = "/noimage.gif";

        if ($request->licence_img != null)
            $licence_img = $upload->uploadFile($request->licence_img);
        else
            $licence_img = "/noimage.gif";

        Driver::create($request->except('photo', 'licence_img', 'mobile') + ['photo' => $photo, 'licence_img' => $licence_img, 'mobile' => json_encode($request->mobile)]);

        return Redirect::back()->with('global_s', 'لقد تم اضافة السائق بنجاح');
    }

    public function show($id) {
        $driver = Driver::find($id);

        if ($driver == null)
            return Redirect::to('admin/drivers/suppliers');

        return view('admin.booking_flight.drivers.show', ['driver' => $driver]);
    }

    public function edit($id) {
        $driver = Driver::find($id);
        $data['busses_suppliers'] = BussesSupplier::lists('name', 'id');
        $data['countries'] = Country::lists('name', 'code');
        $data['cities'] = City::where('country_code', $driver->country)->lists('name', 'id');

        if ($driver == null)
            return Redirect::to('admin/drivers/suppliers');

        return view('admin.booking_flight.drivers.edit', ['driver' => $driver, 'data' => $data, 'i' => 0]);
    }

    public function update(DriverRequest $request, Client $upload, $id) {
        $driver = Driver::find($id);

        $photo = BussesSupplier::checkIfImgNotNull($request->photo, $driver->photo);
        $licence_img = BussesSupplier::checkIfImgNotNull($request->licence_img, $driver->licence_img);

        $driver->update($request->except('photo', 'licence_img', 'mobile') + ['photo' => $photo, 'licence_img' => $licence_img, 'mobile' => json_encode($request->mobile)]);

        return Redirect::back()->with('global_s', 'لقد تم تعديل بيانات السائق بنجاح');
    }

    public function destroy($id) {
        $driver = Driver::find($id);

        if ($driver->photo != "/noimage.gif")
            \File::delete(public_path() . $driver->photo);
        if ($driver->licence_img != "/noimage.gif")
            \File::delete(public_path() . $driver->licence_img);

        $driver->delete();

        return Redirect::back()->with('global_s', 'لقد تم حذف السائق بنجاح');
    }

}
