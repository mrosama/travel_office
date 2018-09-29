<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Visa;
use App\Http\Models\Country;
use App\Client;
use App\Embassy;
use App\Http\Requests\VisasRequest;
use Redirect;
use File;
use App\Visa_Modified_File;
use App\Visa_Official_File;
use App\Visa_Requirement;

class VisasController extends Controller {

    public function index() {
        $visas = Visa::all();
        return view('admin.visas.index', ['visas' => $visas, 'i' => 0]);
    }

    public function create() {
        $data['countries'] = Country::lists('name', 'code');
        $data['embassies'] = Embassy::lists('name', 'id');
        return view('admin.visas.create', $data);
    }

    public function store(VisasRequest $request, Visa_Modified_File $modifiedFile, Visa_Official_File $officialFile, Visa_Requirement $requirement) {
        $visa = Visa::create($request->except('official_files', 'modefied_files', 'visa_requirements'));

        $officialFile->createFiles($request->official_files, $visa->id);
        $modifiedFile->createFiles($request->modefied_files, $visa->id);
        if ($request->visa_requirements != null)
            $requirement->createRequirement($request->visa_requirements, $visa->id);

        return Redirect::back()->with('global_s', 'لقد تم اضافة البيانات بنجاح');
    }

    public function show($id) {
        $visa = Visa::find($id);
        return view('admin.visas.show', ['visa' => $visa]);
    }

    public function edit($id) {
        $data['visa'] = Visa::find($id);
        $data['countries'] = Country::lists('name', 'code');
        $data['embassies'] = Embassy::lists('name', 'id');
        $data['i'] = 0;
        $data['j'] = 0;
        $data['x'] = 0;

        return view('admin.visas.edit', $data);
    }

    public function update(VisasRequest $request, Visa_Modified_File $modifiedFile, Visa_Official_File $officialFile, Visa_Requirement $requirement, $id) {
        
        $data = $request->except(['official_files', 'modefied_files', 'visa_requirements']);
        $data['embassy_id'] = ($request->get('embassy_id') == 1) ? 1 : 0 ;
        $data['hotel_booking'] = ($request->get('hotel_booking') == 1) ? 1 : 0 ;
        $data['action_definition'] = ($request->get('action_definition') == 1) ? 1 : 0 ;
        $data['health_insurance'] = ($request->get('health_insurance') == 1) ? 1 : 0 ;
        $data['account_statement'] = ($request->get('account_statement') == 1) ? 1 : 0 ;
        $data['passport_photocopy'] = ($request->get('passport_photocopy') == 1) ? 1 : 0 ;
        $data['fill_form_online'] = ($request->get('fill_form_online') == 1) ? 1 : 0 ;
        $data['fill_form_external'] = ($request->get('fill_form_external') == 1) ? 1 : 0 ;
        $data['visa_in_airport'] = ($request->get('visa_in_airport') == 1) ? 1 : 0 ;
        $data['passport_with_picture'] = ($request->get('passport_with_picture') == 1) ? 1 : 0 ;
        $data['family_card_with_picture'] = ($request->get('family_card_with_picture') == 1) ? 1 : 0 ;
        $data['residence_with_picture'] = ($request->get('residence_with_picture') == 1) ? 1 : 0 ;
        $data['bank_account'] = ($request->get('bank_account') == 1) ? 1 : 0 ;
        $officialFile->editFiles($request->official_files, $request->edit_official_files, $id);
        $modifiedFile->editFiles($request->modefied_files, $request->edit_modified_files, $id);
        $requirement->editRequirement($request->visa_requirements, $id);
        Visa::find($id)->update($data);
        return Redirect::back()->with('global_s', 'لقد تم تعديل متطلبات الفيزا بنجاح');
    }

    public function destroy($id) {
        $visa = Visa::find($id);
        File::delete(public_path() . $visa->file);
        $visa->delete();
        return Redirect::back()->with('global_s', 'لقد تم حذف متطلبات الفيزا بنجاح');
    }

}
