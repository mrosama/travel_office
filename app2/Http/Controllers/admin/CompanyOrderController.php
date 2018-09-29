<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CompanyOrderRequest;
use App\company;
use App\Http\Models\Country;
use App\Http\Models\City;
use App\CompanyOrder;
use App\CompanyEmployee;
use App\CompanySection;
use App\Orders_type;
use Redirect;

class CompanyOrderController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $all_companyOrder = CompanyOrder::all();
        return view('admin.companyOrder.index', compact('all_companyOrder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $all_company = company::lists('name', 'id');
        $countries = Country::lists('name', 'code');
        $orders_types = Orders_type::lists('type', 'id');
        return view('admin.companyOrder.create', compact('all_company', 'countries', 'orders_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyOrderRequest $request) {
        $data = $request->all();
        $data['empId'] = json_encode($request->empId);
        CompanyOrder::create($data);
        return Redirect::back()->with('success', 'لقد تمت عملية الاضافة بنجاح !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $company_order = CompanyOrder::find($id);

        $all_section = CompanySection::where('companyId', $company_order->companyId)->get();
        $all_employee = CompanyEmployee::where('sectionId', $company_order->sectionId)->lists('empName', 'id');
        $takeoff_city = City::where('country_code', $company_order->country_takeoff)->lists('name', 'id');
        $arrival_city = City::where('country_code', $company_order->country_arrival)->lists('name', 'id');
        $all_company = company::all();
        $countries = Country::lists('name', 'code');
        $orders_types = Orders_type::lists('type', 'id');
        return view('admin.companyOrder.edit', compact('all_company', 'all_section', 'takeoff_city', 'arrival_city', 'all_employee', 'countries', 'company_order', 'orders_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyOrderRequest $request, $id) {
        $data = $request->all();
        $data['empId'] = json_encode($request->empId);
        CompanyOrder::find($id)->update($data);
        return Redirect::back()->with('success', 'لقد تمت عملية التعديل بنجاح !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        CompanyOrder::find($id)->destroy($id);
        return Redirect::back()->with('success', 'لقد تمت عملية الحذف بنجاح !');
    }

    public function getEmpName() {
        $companyId = $_GET['companyId'];
        $sectionId = $_GET['sectionId'];
        $empData = CompanyEmployee::where('sectionId', $sectionId)->where('companyId', $companyId)->get();
        return $empData;
    }

}
