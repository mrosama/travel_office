<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\IncomeRequest;
use App\Http\Models\Employee;
use App\Income;
use App\Client;
use App\IncomeType;
use Redirect;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all_incomes'] = Income::all();
        return view('admin.income.index' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['all_employee'] = Employee::lists('name' , 'id');
        $data['income_types'] = IncomeType::lists('type' , 'id');
        return view('admin.income.create' , $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncomeRequest $request , Client $upload)
    {
        $input = $request->all();
        if($request->receipt_photo != null)
            $receipt_photo = $upload->uploadFile($request->receipt_photo);
        else
            $photoResidence = "/noimage.gif";
        $input['receipt_photo'] = $receipt_photo;

        Income::create($input);
        return Redirect::back()->with('success' , 'تم عملية الاضافة بنجاح');
    }

    public function edit($id)
    {
        $data['all_employee'] = Employee::lists('name' , 'id');
        $data['income_types'] = IncomeType::lists('type' , 'id');
        $data['income']       = Income::find($id);
        return view('admin.income.edit' , $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IncomeRequest $request, Client $upload , $id)
    {
        $data['income'] = Income::find($id);
        $input = $request->all();
        if($request->receipt_photo != null)
            $receipt_photo = $upload->uploadFile($request->receipt_photo);
        else
            $receipt_photo = $data['income']->receipt_photo;
        $input['receipt_photo'] = $receipt_photo;

        Income::find($id)->update($input);
        return Redirect::back()->with('success' , 'تم عملية التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data['income'] = income::find($id);
        \File::delete(public_path().$data['income']->receipt_photo);
        income::find($id)->destroy($id);
        return Redirect::back()->with('success' , 'لقد تمت عملية الحذف بنجاح ! ');
    }

    public function getEmployeeInformation()
    {
        return Employee::find($_GET['id']);
    }
}
