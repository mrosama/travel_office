<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Useful_linksRequest;
use App\useful_link_attachment;
use App\useful_link;
use App\Client;
use Redirect;
class useful_linkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = useful_link::all();
        return view('admin.useful_links.index' , compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.useful_links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Useful_linksRequest $request  , Client $upload)
    {
       $input = $request->all(); 
       if($request->logo != null)
         $logo = $upload->uploadFile($request->logo);
     else
        $logo = "/noimage.gif";
    $input['logo'] = $logo;
    $newLinkId =  useful_link::create($input)->id;

    if($request->attachment != null)
    {
        foreach($request->attachment as $row)
        {
            $data['attachment_file'] = $upload->uploadFile($row);
            $data['useful_link_id'] = $newLinkId;
            useful_link_attachment::create($data);
        }
    }
    return Redirect::back()->with('success' , 'لقد تم الاضافة بنجاح');
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
        $link = useful_link::find($id);
        $link_attachment = useful_link_attachment::where('useful_link_id',$id)->get();
        return view('admin.useful_links.edit' , compact('link' , 'link_attachment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Useful_linksRequest $request, $id , Client $upload)
    {
        $input = $request->all();
        $link = useful_link::find($id);
        if($request->logo != null)
        {
            \File::delete(public_path().$link->logo);
            $logo = $upload->uploadFile($request->logo);
        }
        else
        {
            $logo = $link->logo;
        }
        $input['logo'] = $logo;
        $link = useful_link::find($id)->update($input);

        if($request->attachment != null)
        {
            foreach($request->attachment as $row)
            {
                $data['attachment_file'] = $upload->uploadFile($row);
                $data['useful_link_id'] = $id;
                useful_link_attachment::create($data);
            }
        }
        return Redirect::back()->with('success' , 'تم تعديل البيانات بنجاح');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $link = useful_link::find($id);
        \File::delete(public_path().$link->logo);
        useful_link::destroy($id);

        // Delete Related Attacment Files
        $link_attachment = useful_link_attachment::where('useful_link_id' ,$id)->get();
        foreach ($link_attachment as $row) 
        {
            \File::delete(public_path().$row->attachment_file);
            useful_link_attachment::destroy($row->id);
        }
        return Redirect::back()->with('success' , 'تمت عملية الحذف بنجاح');
    }

    public function deleteAttachment($id)
    {
        $link_attachment = useful_link_attachment::find($id);
        \File::delete(public_path().$link_attachment->attachment_file);
        useful_link_attachment::destroy($id);
        return Redirect::back();
    }


}
