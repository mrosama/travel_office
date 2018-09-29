<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CompanyRequest;
use App\Http\Models\Country;
use App\Http\Models\City;
use App\CompanyEmail;
use App\CompanyMobile;
use App\CompanyPhone;
use App\CompanyFax;
use App\company;
use App\Client;
use App\Upload;
use App\Unicode;
use App\CompanySection;
use Redirect;
use Session;
use Mail;

class CompanyController extends Controller {


    public function index() {
        $all_company = company::all();
        return view('admin.company.index', compact('all_company', 'all_country'));
    }

    public function create() {
        $all_country = Country::lists('name', 'code');
        return view('admin.company.create', compact('all_country'));
    }

    public function store(Request $request, Upload $upload) {
        if (Session::has('logo'))
            $logo = Session::get('logo');
        elseif ($request->file('logo') != null) {
            $logo = $upload->uploadFile($request->logo, 'company');
        } else {
            $logo = "/noimage.gif";
        }
        Session::set('logo', $logo);
        $this->validate($request, [
            'name' => 'required',
            'work_type' => 'required',
            'work_time' => 'required',
            'owner_name' => 'required',
            'country' => 'required',
            'city' => 'required',
            'commercial_record' => 'required',
            'mailbox' => 'required',
            'postal_code' => 'required',
            'fax' => 'required',
            'logo' => 'required',
            'email' => 'required|email|unique:companies,email',
            'mobile' => 'required|numeric',
            'phone' => 'required|numeric',
            'address' => 'required',
            'lat' => 'required',
            'lang' => 'required',
            'userName' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $data = $request->except('password_confirmation');
        $data['password'] = bcrypt($request->password);
        $data['logo'] = $logo;
        $new_company = company::create($data);
        Session::forget('logo');
        $company_id = $new_company->id;
        if (isset($request['emails'])) {
            foreach ($request['emails'] as $key => $val) {
                $data['email'] = $val;
                $data['company_id'] = $company_id;
                CompanyEmail::create($data);
            }
        }
        if (isset($request['mobiles'])) {
            foreach ($request['mobiles'] as $key => $val) {
                $data['number'] = $val;
                $data['company_id'] = $company_id;
                CompanyMobile::create($data);
            }
        }
        if (isset($request['phones'])) {
            foreach ($request['phones'] as $key => $val) {
                $data['number'] = $val;
                $data['company_id'] = $company_id;
                CompanyPhone::create($data);
            }
        }
        if (isset($request['faxs'])) {
            foreach ($request['faxs'] as $key => $val) {
                $data['fax'] = $val;
                $data['company_id'] = $company_id;
                CompanyFax::create($data);
            }
        }
        return Redirect::back()->with('success', 'لقد تمت عملية الاضافة بنجاح !');
    }


    public function show($id) {
        //
    }

    public function edit($id) {
        $company = company::find($id);
        $all_city = City::where('country_code', $company->country)->get();
        $all_country = Country::all();
        $emails = CompanyEmail::where('company_id', $id)->get();
        $mobiles = CompanyMobile::where('company_id', $id)->get();
        $phones = CompanyPhone::where('company_id', $id)->get();
        $faxs = CompanyFax::where('company_id', $id)->get();
        return view('admin.company.edit', compact('company', 'all_country', 'all_city', 'emails', 'mobiles', 'phones', 'faxs'));
    }

    public function update(CompanyRequest $request, $id, Upload $upload) {
        $data = $request->except('password_confirmation');
        $company = company::find($id);
        $oldPassword = $company->password;
        if ($request->password == null) {
            $data['password'] = $oldPassword;
        } else
            $data['password'] = bcrypt($request->password);

        if ($request->logo != null) {
            \File::delete(public_path() . $company->logo);
            $logo = $upload->uploadFile($request->logo, 'company');
        } else {
            $logo = $company->logo;
        }
        $data['logo'] = $logo;

        company::find($id)->update($data);

        if (isset($request['emails'])) {
            CompanyEmail::where('company_id', $id)->delete();
            foreach ($request['emails'] as $key => $val) {
                $data['email'] = $val;
                $data['company_id'] = $id;
                CompanyEmail::create($data);
            }
        }

        if (isset($request['mobiles'])) {
            CompanyMobile::where('company_id', $id)->delete();
            foreach ($request['mobiles'] as $key => $val) {
                $data['number'] = $val;
                $data['company_id'] = $id;
                CompanyMobile::create($data);
            }
        }

        if (isset($request['phones'])) {
            CompanyPhone::where('company_id', $id)->delete();
            foreach ($request['phones'] as $key => $val) {
                $data['number'] = $val;
                $data['company_id'] = $id;
                CompanyPhone::create($data);
            }
        }


        if (isset($request['faxs'])) {
            CompanyFax::where('company_id', $id)->delete();
            foreach ($request['faxs'] as $key => $val) {
                $data['fax'] = $val;
                $data['company_id'] = $id;
                CompanyFax::create($data);
            }
        }

        return Redirect::back()->with('success', 'لقد تمت عملية التعديل بنجاخ');
    }

    public function destroy($id) {
        company::find($id)->destroy($id);
        CompanySection::where('companyId', $id)->delete();
        return Redirect::back()->with('success', 'لقد تمت عملية الحذف بنجاح');
    }

    public function delete_section($id) {
        CompanySection::find($id)->delete();
        return Redirect::back()->with('success', 'لقد تمت عملية الحذف بنجاح');
    }

    public function getSections() {
        $sections = CompanySection::where('companyId', $_GET['company_id'])->with('companyName')->get();
        return $sections;
    }

// =============== Email And Sms ============

    public function send_email($id) {
        $company = Company::find($id);
        return view('admin.company.send_company_email', compact('company'));
    }

    public function doSendEmail(Request $request) {

        $this->validate($request, [
            'title' => 'required',
            'msg' => 'required'
        ]);
        $title = $request['title'];
        $msg = $request['msg'];
        $companyEmail = $request['email'];
        Mail::send('admin.emails.send_company_email', array('msg_data' => $msg), function($message) use($companyEmail, $title) {
            $message->to($companyEmail)->subject($title);
        });
        return Redirect::back()->with('success', 'تم ارسال البريد الالكتروني بنجاح');
    }

    public function send_sms($id) {
        $company = Company::find($id);
        $companyMobile = $company['mobile'];
        if ($companyMobile) {
            $mobile_number = $companyMobile;
            return view('admin.company.send_company_sms', compact('company', 'mobile_number'));
        } else {
            return Redirect::back()->with('error', 'لا يوجد رقم لهذه الشركة  يرجى اضافة رقم اولا ثم ارسال الرسالة');
        }
    }

    public function doSendSms(Request $request , Unicode $unicode) {
        $this->validate($request, [
            'msg' => 'required'
        ]);
        $number = $request['number'];
        $msg = $unicode->convertToUnicode($request['msg']);
        $userAccount = "966505854796";
        $passAccount = "hassanko6";
        $userSenderSMS = "Travel";
        $url = "http://www.mobily.ws/api/msgSend.php?mobile=" . $userAccount . "&password=" . $passAccount . "&numbers=" . $number . "&sender=TraveL%20Mart&msg=" . $msg . "&applicationType=24";
        //fopen($url,"r");
        $ret = file_get_contents($url);
        if ($ret == 1) {
            return Redirect::back()->with('success', 'تم ارسال الرسالة بنجاح بنجاح');
        } else{
            return Redirect::back()->with('error', 'حدث خطأ اثناء الارسال يرجى مراجعة مزود الخدمة او التأكد من الرقم المرسل اليه');
        }
    }

}
