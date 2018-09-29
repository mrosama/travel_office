<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\TouristProgramRequest;
use App\Http\Models\Employee;
use App\Http\Models\Country;
use App\Http\Models\City;
use App\TouristProgram;
use App\BussesSupplier;
use App\Reserved_bus;
use App\Supervisor;
use App\Activity;
use App\Driver;
use App\Client;
use Redirect;
use App\Trip;
use App\Bus;

class TouristProgrammesController extends Controller {

    public function index() {
        $tourist_programmes = TouristProgram::all();
        return view('admin.booking_flight.tourist_programmes.index', ['tourist_programmes' => $tourist_programmes, 'i' => 0]);
    }

    public function create() {
        $countries = Country::lists('name', 'code');
        $trips = Trip::lists('name', 'id');
        //$employees = Employee::lists('name', 'id');
        $supervisors = Supervisor::lists('name', 'id');
        $busses_suppliers = BussesSupplier::lists('name', 'id');
        return view('admin.booking_flight.tourist_programmes.create', ['countries' => $countries, 'trips' => $trips, 'supervisors' => $supervisors, 'busses_suppliers' => $busses_suppliers]);
    }

  //  public function store(TouristProgramRequest $request) {
    public function store(Request $request) {
        $data = $request->except('event', 'time', 'duration', 'supplier_id', 'bus_id', 'driver_id', 'meals');

        $data['supervisors'] = json_encode($request->supervisors);
        $tourist_pro = TouristProgram::create($data + ['meals' => json_encode($request->meals, JSON_UNESCAPED_UNICODE)]);

        for ($i = 0; $i < sizeof($request->event); $i++) {
            Activity::create([
                'event' => $request->event[$i],
                'time' => $request->time[$i],
                'duration' => $request->duration[$i],
                'tourist_program_id' => $tourist_pro->id
            ]);
        }

        for ($i = 0; $i < sizeof($request->supplier_id); $i++) {
            Reserved_bus::create([
                'supplier_id' => $request->supplier_id[$i],
                'bus_id' => $request->bus_id[$i],
                'driver_id' => $request->driver_id[$i],
                'tourist_program_id' => $tourist_pro->id
            ]);
        }

        return Redirect::back()->with('global_s', 'لقد تم اضافة البرنامج السياحى بنجاح');
    }

    public function show($id) {
        $tourist_program = TouristProgram::find($id);

        if ($tourist_program == null)
            return Redirect::to('admin/tourist/programmes');

        $activities = Activity::where("tourist_program_id", $tourist_program->id)->get();
        return view('admin.booking_flight.tourist_programmes.show', ['tourist_program' => $tourist_program, 'activities' => $activities, 'i' => 0]);
    }

    public function edit($id) {
        $tourist_program = TouristProgram::find($id);

        if ($tourist_program == null)
            return Redirect::to('admin/tourist/programmes');

        $activities = Activity::where("tourist_program_id", $tourist_program->id)->get();
        $countries = Country::lists('name', 'code');
        $to_cities = City::where('country_code', $tourist_program
                        ->to_country)->lists('name', 'id');
        $from_cities = City::where('country_code', $tourist_program
                        ->from_country)->lists('name', 'id');
        //$employees = Employee::lists('name', 'id');
        $supervisors = Supervisor::lists('name', 'id');
        $busses_suppliers = BussesSupplier::lists('name', 'id');
        $reserved_buses = $tourist_program->reservedBus;
        $buses = Bus::lists('number', 'id');
        $drivers = Driver::lists('name', 'id');
                $trips = Trip::lists('name', 'id');


        return view('admin.booking_flight.tourist_programmes.edit', ['countries' => $countries, 'trips' => $trips , 'tourist_program' => $tourist_program, 'to_cities' => $to_cities, 'from_cities' => $from_cities, 'supervisors' => $supervisors, 'activities' => $activities, 'busses_suppliers' => $busses_suppliers, 'i' => 0, 'reserved_buses' => $reserved_buses, 'buses' => $buses, 'drivers' => $drivers]);
    }

    public function update(TouristProgramRequest $request, $id) {
        $tourist_program = TouristProgram::find($id);

        //delete all ctivities then create then create the new
        foreach ($tourist_program->reservedBus as $reservedBus)
            $reservedBus->delete();

        for ($i = 0; $i < sizeof($request->supplier_id); $i++) {
            Reserved_bus::create([
                'supplier_id' => $request->supplier_id[$i],
                'bus_id' => $request->bus_id[$i],
                'driver_id' => $request->driver_id[$i],
                'tourist_program_id' => $id
            ]);
        }
        //end of deleting operation
        //delete all ctivities then create then create the new
        foreach ($tourist_program->activities as $activity)
            $activity->delete();

        for ($i = 0; $i < sizeof($request->event); $i++) {
            Activity::create([
                'event' => $request->event[$i],
                'time' => $request->time[$i],
                'duration' => $request->duration[$i],
                'tourist_program_id' => $id
            ]);
        }
        //end of deleting operation

        $data = $request->except('event', 'time', 'duration', 'supplier_id', 'bus_id', 'driver_id', 'meals');
        $data['supervisors'] = json_encode($request->supervisors);
        $data['meals'] = json_encode($request->meals, JSON_UNESCAPED_UNICODE);

        $tourist_program->update($data);

        return Redirect::back()->with('global_s', 'لقد تم تعديل بيانات البرنامج السياحى بنجاح');
    }

    public function destroy($id) {
        $tourist_program = TouristProgram::find($id);
        //delete all ctivities then create then create the new
        if ($tourist_program->reservedBus->count() != 0) {
            foreach ($tourist_program->reservedBus as $reservedBus)
                $reservedBus->delete();
        }
        //delete all ctivities then create then create the new
        if ($tourist_program->activities->count() != 0) {
            foreach ($tourist_program->activities as $activity)
                $activity->delete();
        }

        $tourist_program->delete();

        return Redirect::back()->with('global_s', 'لقد تم حذف البرنامج السياحى بنجاح');
    }

    public function getBusesAndDrivers() {
        $id = $_GET['id'];
        $buses = Bus::where('supplier_id', $id)->get();
        $drivers = Driver::where('supplier_id', $id)->get();
        return [$buses, $drivers];
    }

}
