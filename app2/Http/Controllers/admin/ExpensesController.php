<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ExpensesRequest;
use App\Expenses;
use App\exchangeType;
use App\Client;
use Redirect;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all_expenses'] = Expenses::all();
        return view('admin.expenses.index' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['all_exchangeType'] = exchangeType::lists('type' , 'id');
        return view('admin.expenses.create' , $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpensesRequest $request , Client $upload) 
    {
        $input = $request->all(); 
        if($request->attachment != null)
            $attachment = $upload->uploadFile($request->attachment);
        else
            $photoResidence = "/noimage.gif";
        $input['attachment'] = $attachment;

        Expenses::create($input);
        return Redirect::back()->with('success' , 'تم عملية الاضافة بنجاح');

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
        $data['expenses'] = Expenses::find($id);
        $data['all_exchangeType'] = exchangeType::lists('type' , 'id');
        return view('admin.expenses.edit' , $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpensesRequest $request , Client $upload , $id)
    {
        $data['expenses'] = Expenses::find($id);
        $input = $request->all(); 
        if($request->attachment != null)
            $attachment = $upload->uploadFile($request->attachment);
        else
            $photoResidence = "/noimage.gif";
        $input['attachment'] = $data['expenses']->attachment;

        Expenses::find($id)->update($input);
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
        $data['expenses'] = Expenses::find($id);
        \File::delete(public_path().$data['expenses']->attachment);
        Expenses::find($id)->destroy($id);
        return Redirect::back()->with('success' , 'لقد تمت عملية الحذف بنجاح ! ');
    }
}
