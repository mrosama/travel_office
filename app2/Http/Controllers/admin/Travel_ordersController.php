<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Travel_ordersRequest;
use App\Http\Models\Country;
use App\Http\Models\City;
use App\Travel_employee;
use App\Travel_office;
use App\Travel_order;
use App\Travel_section;
use App\Orders_type;
use Redirect;

class Travel_ordersController extends Controller
{

    public function index()
    {
        $all_travelOrder = Travel_order::all();
        return view('admin.travel_order.index' , compact('all_travelOrder'));
    }


    public function create()
    {
        $all_office = Travel_office::lists('name' , 'id');
        $countries = Country::lists('name' , 'code');
        $orders_types = Orders_type::lists('type' , 'id');
        return view('admin.travel_order.create' , compact('all_office' , 'countries' , 'orders_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Travel_ordersRequest $request)
    {

        $data = $request->all();
        $data['empId'] = json_encode($request->empId);
        Travel_order::create($data);
        return Redirect::back()->with('success' , 'لقد تمت عملية الاضافة بنجاح !');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $travel_order = Travel_order::find($id);

        $all_section = Travel_section::where('travel_officeId' , $travel_order->travel_officeId)->get();
        $all_employee = Travel_employee::where('sectionId' , $travel_order->sectionId)->lists('empName' , 'id');
        $takeoff_city = City::where('country_code' , $travel_order->country_takeoff)->lists('name' ,'id');
        $arrival_city = City::where('country_code' , $travel_order->country_arrival)->lists('name' , 'id');
        $all_office = Travel_office::all();
        $countries = Country::lists('name' , 'code');
        $orders_types = Orders_type::lists('type' , 'id');
        return view('admin.travel_order.edit' , compact('all_office' ,'all_section' ,  'takeoff_city', 'arrival_city', 'all_employee' ,   'countries' , 'travel_order' , 'orders_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Travel_ordersRequest $request, $id)
    {
        $data = $request->all();
        $data['empId'] = json_encode($request->empId);
        Travel_order::find($id)->update($data);
        return Redirect::back()->with('success' , 'لقد تمت عملية التعديل بنجاح !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Travel_order::find($id)->destroy($id);
        return Redirect::back()->with('success' , 'لقد تمت عملية الحذف بنجاح !');
    }

    public function getEmpName()
    {
     $travel_officeId = $_GET['travel_officeId'];
     $sectionId = $_GET['sectionId'];
     $empData = travel_employee::where('sectionId' , $sectionId )->where('travel_officeId' , $travel_officeId)->get();
     return $empData;
 }
}
