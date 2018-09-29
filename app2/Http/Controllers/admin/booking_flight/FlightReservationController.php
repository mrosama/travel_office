<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\FlightReservationRequest;
use App\Client;
use App\Flight_reservation;
use Redirect;
use App\Http\Models\Country;
use App\TouristProgram;
use App\BussesSupplier;
use App\Bus;
use App\Driver;
use App\Reserved_seats;
use App\Reserved_bus;

class FlightReservationController extends Controller {

    public function index() {
        $flight_reservations = Flight_reservation::all();
        return view('admin.booking_flight.flight_reservations.index', ['flight_reservations' => $flight_reservations, 'i' => 0]);
    }

    public function create() {
        $clients = Client::lists('username', 'id');
        $tourist_programmes = TouristProgram::lists('name', 'id');
        $busses_suppliers = BussesSupplier::lists('name', 'id');

        return view('admin.booking_flight.flight_reservations.create', ["clients" => $clients, "tourist_programmes" => $tourist_programmes, "busses_suppliers" => $busses_suppliers]);
    }

    public function store(FlightReservationRequest $request) {
        if (empty($request->seat_no))
            return Redirect::back()->with('global_r', 'من فضلك قم باختيار المقعد')->withInput();

        $flight_reserved = Flight_reservation::create($request->except('seat_no'));
        Reserved_seats::create($request->only(['bus_id', 'client_id', 'tourist_program_id']) + ['seat_no' => json_encode($request->seat_no), 'flight_reserved_id' => $flight_reserved->id]);

        return Redirect::back()->with('global_s', 'لقد تم اضافة الحجز بنجاح');
    }

    public function show($id) {
        $flight_reservation = Flight_reservation::find($id);

        if ($flight_reservation == null)
            return Redirect::to('admin/busses/suppliers');

        return view('admin.booking_flight.flight_reservations.show', ['flight_reservation' => $flight_reservation]);
    }

    public function edit($id) {
        $flight_reservation = Flight_reservation::find($id);

        if ($flight_reservation == null)
            return Redirect::to('admin/busses/suppliers');

        $clients = Client::lists('username', 'id');
        $tourist_programmes = TouristProgram::lists('name', 'id');

        $reserved_buses = Reserved_bus::where('tourist_program_id', $flight_reservation->tourist_program_id)->get();

        $buses_arr = [];
        foreach ($reserved_buses as $reserved_bus) {
            array_push($buses_arr, $reserved_bus->bus_id);
        }

        $buses = Bus::whereIn('id', $buses_arr)->lists('number', 'id');

        return view('admin.booking_flight.flight_reservations.edit', ["clients" => $clients, "tourist_programmes" => $tourist_programmes, 'flight_reservation' => $flight_reservation, 'buses' => $buses]);
    }

    public function update(FlightReservationRequest $request, $id) {
        if (empty($request->seat_no))
            return Redirect::back()->with('global_r', 'من فضلك قم باختيار المقعد')->withInput();

        $flight_reservation = Flight_reservation::find($id);
        $flight_reservation->update($request->except('seat_no'));

        //delete clients reserved seats
        foreach ($flight_reservation->resrved_seats as $resrved_seats)
            $resrved_seats->delete();
        //create new client seats which he reserved
        Reserved_seats::create($request->only(['bus_id', 'client_id', 'tourist_program_id']) + ['seat_no' => json_encode($request->seat_no), 'flight_reserved_id' => $id]);


        return Redirect::back()->with('global_s', 'لقد تم تعديل بيانات الحجز بنجاح');
    }

    public function destroy($id) {
        $flight_reservation = Flight_reservation::find($id);

        if ($flight_reservation->resrved_seats->count() != 0) {
            foreach ($flight_reservation->resrved_seats as $resrved_seat)
                $resrved_seat->delete();
        }
        $flight_reservation->delete();

        return Redirect::back()->with('global_s', 'لقد تم حذف الحجز بنجاح');
    }

    public function getBusInformation() {
        return Bus::find($_GET['id']);
    }

    public function getDriverInformation() {
        return Driver::find($_GET['id']);
    }

    public function getTouristProgramIformation() {
        $tourist_program = TouristProgram::find($_GET['id']);

        if ($tourist_program == "")
            return 0;

        return [
            "going_date" => $tourist_program->going_date,
            "flight_days_no" => $tourist_program->flight_days_no,
            "flight_hours_no" => $tourist_program->flight_hours_no,
            "meals" => $tourist_program->meals,
            "fromCountry" => $tourist_program->fromCountry->name,
            "fromCity" => $tourist_program->fromCity->name,
            "fromPlace" => $tourist_program->from_place,
            "toCountry" => $tourist_program->toCountry->name,
            "toCity" => $tourist_program->toCity->name,
            "toPlace" => $tourist_program->to_place];
    }

    public function checkIfSeatIsReserved() {
        $arr1 = [];
        $reserved_seats = Reserved_seats::where('bus_id', $_GET['bus_id'])->where('tourist_program_id', $_GET['tourist_program_id'])->get();

        foreach ($reserved_seats as $reserved_seat)
            array_push($arr1, [$reserved_seat->seat_no, Client::find($reserved_seat->client_id)]);

        return $arr1;
    }

    public function checkIfSeatIsReservedAndGetClientSeats() {
        //reserved seats
        $arr1 = [];
        $reserved_seats = Reserved_seats::where('bus_id', $_GET['bus_id'])->where('tourist_program_id', $_GET['tourist_program_id'])->where('flight_reserved_id', '!=', $_GET['flight_id'])->get();

        foreach ($reserved_seats as $reserved_seat)
            array_push($arr1, [$reserved_seat->seat_no, Client::find($reserved_seat->client_id)]);

        //client reserved seats
        $arr2 = Reserved_seats::where('flight_reserved_id', $_GET['flight_id'])->where('bus_id', $_GET['bus_id'])->where('tourist_program_id', $_GET['tourist_program_id'])->get();

        return [$arr1, $arr2];
    }

    public function getTouristProgramIBus() {
        $buses_arr = [];
        $reserved_buses = Reserved_bus::where('tourist_program_id', $_GET['id'])->get();

        foreach ($reserved_buses as $reserved_bus) {
            array_push($buses_arr, Bus::find($reserved_bus->bus_id));
        }
        return $buses_arr;
    }

}
