<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use App\PartnerBankData;
use App\Client;
use App\PartnerPayTransfer;
use App\Http\Requests;
use App\Http\Requests\PartnerRequest;
use App\Http\Requests\PayTransferRequest;
use Redirect;
use File;
use App\Http\Models\Country;
use App\Http\Models\City;
use App\Partner_type;
use App\User;

class PartnersController extends Controller {

    public function index() {
        $partners = Partner::all();
        return view('admin.partners.index', ['partners' => $partners, 'i' => 0]);
    }

    public function create() {
        $data['countries'] = Country::lists('name', 'code');
        $data['partner_types'] = Partner_type::lists('name', 'id');
        return view('admin.partners.create', $data);
    }

    public function store(PartnerRequest $request, Client $upload) {
        if ($request->logo != null)
            $logo = $upload->uploadFile($request->logo);
        else
            $logo = "/noimage.gif";

        $id = Partner::storePartner($request->except('user_name', 'password'), $logo);
        User::add($request->user_name, $request->password, $id, "partner");
        return Redirect::back()->with('global_s', 'لقد تم اضافة الشريك بنجاح');
    }

    public function show($id) {
        $partner = Partner::find($id);
        if ($partner == null)
            return Redirect::to('admin/partners');
        return view('admin.partners.show', ['partner' => $partner, 'i' => 0]);
    }

    public function edit($id) {
        $partner = Partner::find($id);

        if ($partner == null)
            return Redirect::to('admin/partners');

        $data['countries'] = Country::lists('name', 'code');
        $data['partner_types'] = Partner_type::lists('name', 'id');
        $data['cities'] = City::where('country_code', $partner->country)->lists('name', 'id');
        return view('admin.partners.edit', ['partner' => $partner, 'i' => 0, 'data' => $data]);
    }

    public function update(PartnerRequest $request, Client $upload, $id) {
        $partner = Partner::find($id);

        if ($request->logo != null) {
            if ($partner->logo != "/noimage.gif")
                File::delete(public_path() . $partner->logo);
            $logo = $upload->uploadFile($request->logo);
        } else
            $logo = $partner->logo;

        Partner::updatePartner($request->except('user_name', 'password'), $logo, $id);
        User::edit($request->user_name, $request->password, $id, "partner");
        return Redirect::back()->with('global_s', 'لقد تم تعديل الشريك بنجاح');
    }

    public function destroy($id) {
        $partner = Partner::find($id);
        $partner->user->delete();

        if ($partner->partnerPayTransfer->count() != 0) {
            foreach ($partner->partnerPayTransfer as $PayTransfer)
                $PayTransfer->delete();
        }

        if ($partner->partnerBankData->count() != 0) {
            foreach ($partner->partnerBankData as $partnerBank)
                $partnerBank->delete();
        }

        if ($partner->employees->count() != 0) {
            foreach ($partner->employees as $employee)
                $employee->delete();
        }

        $partner->delete();
        return Redirect::back()->with('global_s', 'لقد تم حذف الشريك بنجاح');
    }

}
