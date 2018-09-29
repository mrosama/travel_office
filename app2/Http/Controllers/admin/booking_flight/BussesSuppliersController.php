<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\BussesSuppliersRequest;
use App\Http\Requests\BussesSupplierEmailsRequest;
use App\Http\Requests\BussesSupplierSmsRequest;
use App\Http\Models\Country;
use App\BussesSupplier;
use App\BussesBranch;
use App\Client;
use Redirect;
use File;

class BussesSuppliersController extends Controller {

    public function index() {
        $busses_suppliers = BussesSupplier::all();
        return view('admin.booking_flight.busses_suppliers.index', ['busses_suppliers' => $busses_suppliers, 'i' => 0]);
    }

    public function create() {

        $data['countries'] = Country::lists('name', 'code');
        $data['bussesBranches'] = BussesBranch::lists('name', 'id');
        return view('admin.booking_flight.busses_suppliers.create', $data);
    }

    public function store(BussesSuppliersRequest $request, Client $upload) {
        
        if ($request->logo != null)
            $logo = $upload->uploadFile($request->logo);
        else
            $logo = "/noimage.gif";

        if ($request->commercial_reg_img != null)
            $commercial_reg_img = $upload->uploadFile($request->commercial_reg_img);
        else
            $commercial_reg_img = "/noimage.gif";

        BussesSupplier::create($request->except('logo', 'commercial_reg_img') + ['logo' => $logo, 'commercial_reg_img' => $commercial_reg_img]);

        return Redirect::back()->with('global_s', 'لقد تم اضافة المزود بنجاح');
    }

    public function show($id) {
        $busses_supplier = BussesSupplier::find($id);

        if ($busses_supplier == null)
            return Redirect::to('admin/busses/suppliers');

        return view('admin.booking_flight.busses_suppliers.show', ['busses_supplier' => $busses_supplier]);
    }

    public function edit($id) {
        $data['busses_supplier'] = BussesSupplier::find($id);
        $data['bussesBranches'] = BussesBranch::lists('name', 'id');

        if ($data['busses_supplier'] == null)
            return Redirect::to('admin/busses/suppliers');

        return view('admin.booking_flight.busses_suppliers.edit', $data);
    }

    public function update(BussesSuppliersRequest $request, $id) {
        $busses_supplier = BussesSupplier::find($id);

        $logo = BussesSupplier::checkIfImgNotNull($request->logo, $busses_supplier->logo);
        $commercial_reg_img = BussesSupplier::checkIfImgNotNull($request->commercial_reg_img, $busses_supplier->commercial_reg_img);

        $busses_supplier->update($request->except('logo', 'commercial_reg_img') + ['logo' => $logo, 'commercial_reg_img' => $commercial_reg_img]);

        return Redirect::back()->with('global_s', 'لقد تم تعديل المزود بنجاح');
    }

    public function destroy($id) {
        $busSup = BussesSupplier::find($id);

        if ($busSup->logo != "/noimage.gif")
            File::delete(public_path() . $busSup->logo);
        if ($busSup->commercial_reg_img != "/noimage.gif")
            File::delete(public_path() . $busSup->commercial_reg_img);

        $busSup->delete();

        return Redirect::back()->with('global_s', 'لقد تم حذف المزود بنجاح');
    }

    public function getEmails() {
        $data['suppliers'] = BussesSupplier::lists('name', 'email');
        return view('admin.booking_flight.busses_suppliers.send_emails', $data);
    }

    public function sendEmails(BussesSupplierEmailsRequest $request) {
        // if($request->emails == null)
        if ($request->all_suppliers == null && $request->emails == null)
            return Redirect::back()->with('global_r', 'من فضلك قم باختيار بريد الكترونى واحد على الاقل لارسال الرسالة')->withInput();

        $BussesSupplierEmails = [];
        if ($request->all_suppliers == 1) {
            $Emails = BussesSupplier::get(['email'])->toArray();
            foreach ($Emails as $BussesSupplier)
                array_push($BussesSupplierEmails, $BussesSupplier['email']);
        } else
            $BussesSupplierEmails = $request->emails;

        $title = $request->title;
        $Smessage = $request->message;

        // send emails to buses suppliers
        \Mail::send('emails.admin.flightReservation.busesSuppliers', array('Smessage' => $Smessage), function($message) use($BussesSupplierEmails, $title) {
            foreach ($BussesSupplierEmails as $BussesSupplier)
                $message->to($BussesSupplier)->subject($title);
        });
        return Redirect::back()->with('global_s', 'لقد تم ارسال الرسالة الى البريدات الالكترونية المحددة بنجاح');
    }

    public function getSms() {
        $data['suppliers'] = BussesSupplier::lists('name', 'mobile');
        return view('admin.booking_flight.busses_suppliers.send_sms', $data);
    }

    public function sendSms(BussesSupplierSmsRequest $request) {
        // if($request->emails == null)

        if ($request->all_suppliers == null && $request->mobiles == null)
            return Redirect::back()->with('global_r', 'من فضلك قم باختيار  واحد على الاقل لارسال الرسالة')->withInput();

        $BussesSupplierMobiles = [];
        if ($request->all_suppliers == 1) {
            $Mobiles = BussesSupplier::get(['mobile'])->toArray();
            foreach ($Mobiles as $BussesSupplier)
                array_push($BussesSupplierMobiles, $BussesSupplier['mobile']);
        } else
            $BussesSupplierMobiles = $request->mobiles;


        $Smessage = $request->message;
        //dd($BussesSupplierMobiles);
        // send sms to buses suppliers
        if (count($BussesSupplierMobiles) > 0) {
            foreach ($BussesSupplierMobiles as $key => $val) {
                $number = $val;
                $msg = convertToUnicode($Smessage);
                $userAccount = "966505854796";
                $passAccount = "hassanko6";
                $userSenderSMS = "ترافل مارت";
                $url = "http://www.mobily.ws/api/msgSend.php?mobile=" . $userAccount . "&password=" . $passAccount . "&numbers=" . $number . "&sender=TraveL%20Mart&msg=" . $msg . "&timeSend=0&dateSend=0&applicationType=24";
                fopen($url, "r");
                $ret = file_get_contents($url);
            }
            return Redirect::back()->with('global_s', 'لقد تم ارسال الرسالة الى البريدات الالكترونية المحددة بنجاح');
        } else {
            return Redirect::back()->with('global_r', 'حدث خطأ اثناء الارسال يرجى مراجعة المطور');
        }
    }

}
