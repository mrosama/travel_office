<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\BusRequest;
use App\BussesSupplier;
use App\BussesBranch;
use App\Client;
use App\Bus;
use Redirect;

class BussesController extends Controller {

    public function index() {
        $busses = Bus::all();
        return view('admin.booking_flight.busses.index', ['busses' => $busses, 'i' => 0]);
    }

    public function create() {
        $data['bussesBranches'] = BussesBranch::lists('name', 'id');
        $data['busses_suppliers'] = BussesSupplier::lists('name', 'id');
        return view('admin.booking_flight.busses.create', $data);
    }

    public function store(BusRequest $request, Client $upload) {
        if ($request->photo != null)
            $photo = $upload->uploadFile($request->photo);
        else
            $photo = "/noimage.gif";

        Bus::create($request->except('photo') + ['photo' => $photo]);
        return Redirect::back()->with('global_s', 'لقد تم اضافة الباص بنجاح');
    }

    public function show($id) {
        $bus = Bus::find($id);

        if ($bus == null)
            return Redirect::to('admin/busses/suppliers');

        return view('admin.booking_flight.busses.show', ['bus' => $bus]);
    }

    public function edit($id) {
        $data['bus'] = Bus::find($id);
        $data['bussesBranches'] = BussesBranch::lists('name', 'id');
        $data['busses_suppliers'] = BussesSupplier::lists('name', 'id');

        if ($data['bus'] == null)
            return Redirect::to('admin/busses/suppliers');

        return view('admin.booking_flight.busses.edit', $data);
    }

    public function update(BusRequest $request, Client $upload, $id) {
        $busses_supplier = Bus::find($id);

        if ($request->photo != null) {
            if ($busses_supplier->photo != "/noimage.gif")
                File::delete(public_path() . $busses_supplier->photo);
            $photo = $upload->uploadFile($request->photo);
        } else
            $photo = $busses_supplier->photo;

        $busses_supplier->update($request->except('photo') + ['photo' => $photo]);

        return Redirect::back()->with('global_s', 'لقد تم تعديل بيانات الباص بنجاح');
    }

    public function destroy($id) {
        Bus::destroy($id);
        return Redirect::back()->with('global_s', 'لقد تم حذف المزود بنجاح');
    }

}
