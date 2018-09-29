<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\Country;
use App\Http\Requests\BillRequest;
use App\Client;
use App\Bill;
use Redirect;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all_bills'] = Bill::all();
        return view('admin.bills.index' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['all_client'] = Client::lists('username' , 'id');
        $data['all_country'] = Country::lists('name', 'code');
        return view('admin.bills.create' , $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillRequest $request , Client $upload)
    {   
        $input = $request->all(); 
        if($request->receipt_photo != null)
            $receipt_photo = $upload->uploadFile($request->receipt_photo);
        else
            $photoResidence = "/noimage.gif";
        $input['receipt_photo'] = $receipt_photo;

        Bill::create($input);
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
        $data['bill'] = Bill::find($id);
        $data['all_client'] = Client::lists('username' , 'id');
        $data['all_country'] = Country::lists('name', 'code');
        return view('admin.bills.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BillRequest $request, $id , Client $upload)
    {
        $data['bill'] = Bill::find($id);
        $input = $request->all(); 
        if($request->receipt_photo != null)
        {
           \File::delete(public_path().$data['bill']->receipt_photo);
           $receipt_photo = $upload->uploadFile($request->receipt_photo);
       }   
       else
        $receipt_photo = $data['bill']->receipt_photo;
    $input['receipt_photo'] = $receipt_photo;

    Bill::find($id)->update($input);
    return Redirect::back()->with('success' , 'لقد تمت عملية التعديل بنجاح ! ');



}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data['bill'] = Bill::find($id);
        \File::delete(public_path().$data['bill']->receipt_photo);
        Bill::find($id)->destroy($id);
        return Redirect::back()->with('success' , 'لقد تمت عملية الحذف بنجاح ! ');
    }
}
