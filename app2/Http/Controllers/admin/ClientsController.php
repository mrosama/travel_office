<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\EmailClientRequest;
use App\Http\Requests\SmsClientRequest;
use App\Http\Requests\Client_familyRequest;
use App\Http\Models\Country;
use App\Http\Models\City;
use App\Http\Models\Client_mobile;
use App\Http\Models\Client_email;
use App\Client_order;
use App\Client;
use App\Client_family;
use Redirect;
use Mail;
use App\User;
use DateTime;

use Session;

class ClientsController extends Controller {

    public function index() {
        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    public function createFirst() {
        if (isset($_GET['parent_id']) AND ! empty($_GET['parent_id']))
            $parent_id = $_GET['parent_id'];
        else
            $parent_id = 'null';

        if (isset($_GET['type'])) {
            if ($_GET['type'] == 0 OR $_GET['type'] == 1) {
                $type = $_GET['type'];
            }
        } else
            $type = 'null';
        $countries = Country::lists('name', 'code');
        $countrs = Country::all();
        return view('admin.clients.createFirst', compact('countries', 'parent_id', 'type', 'countrs'));
    }

    public function checkFirst(Request $request, Client $client) {
        $this->validate($request, [
            'user_name' => 'required', 'password' => 'required|min:6', 'userType' => 'required', 'username' => 'required', 'username_en' => 'required',
            'nationality' => 'required', 'country' => 'required', 'city' => 'required', 'mobile' => 'required|numeric', 'birth_date' => 'required', 'photo' => 'required',
            'mother_name' => 'required', 'email_address' => 'required|email', 'phone' => 'required|numeric', 'fax' => 'required', 'twitter' => 'required|url', 'instgram' => 'required|url',
            'skype' => 'required', 'facebook' => 'required|url', 'family_card' => 'required', 'passport_number' => 'required|numeric', 'issue_date' => 'required', 'expire_date' => 'required',
            'passport_issue_place' => 'required', 'passpot_copy' => 'required', 'residence_number' => 'required|numeric', 'residence_copy' => 'required', 'notes' => 'required',
        ]);
        $userInfo = $request->all();
        
        //upload images
        if (Session::has('userInfo.photo'))
            $userInfo['photo'] = Session::get('userInfo.photo');
        elseif ($request->file('photo') != null)
            $userInfo['photo'] = $client->uploadFile($request->file('photo'));

        if (Session::has('userInfo.family_card'))
            $userInfo['family_card'] = Session::get('userInfo.family_card');
        elseif ($request->file('family_card') != null)
            $userInfo['family_card'] = $client->uploadFile($request->file('family_card'));

        if (Session::has('userInfo.passpot_copy'))
            $userInfo['passpot_copy'] = Session::get('userInfo.passpot_copy');
        elseif ($request->file('passpot_copy') != null)
            $userInfo['passpot_copy'] = $client->uploadFile($request->file('passpot_copy'));

        if (Session::has('userInfo.residence_copy'))
            $userInfo['residence_copy'] = Session::get('userInfo.residence_copy');
        elseif ($request->file('residence_copy') != null)
            $userInfo['residence_copy'] = $client->uploadFile($request->file('residence_copy'));
        
          $userInfo['username_en'] = strtoupper($userInfo['username_en']);

          

        // Save data inot session and go to next step
        Session::set('userInfo', $userInfo);
        return redirect('admin/clients/create/second');
    }

    public function createSecond() {
        return view('admin.clients.createSecond');
    }

    public function checkSecond(Request $request, Client $client) {
        $this->validate($request, [
            'id_number' => 'required|numeric',
            'license_copy' => 'required',
            'license_issue_date' => 'required',
            'license_expire_date' => 'required',
            'issuer' => 'required',
            'conservation_number' => 'required'
        ]);
        $firstUserInfo = Session::get('userInfo');
        $secondUserInfo = $request->all();
        //upload images
        if (Session::has('userInfo.license_copy') && $request->file('license_copy') == null)
            $secondUserInfo['license_copy'] = Session::get('userInfo.license_copy');
        elseif ($request->file('license_copy') != null)
            $secondUserInfo['license_copy'] = $client->uploadFile($request->file('license_copy'));
        $userInfo = array_merge($firstUserInfo, $secondUserInfo);
        Session::set('userInfo', $userInfo);
        return redirect('admin/clients/create/last');
    }

    public function createLast() {
        return view('admin.clients.creatLast');
    }

    public function confirmLast() {
        $new_client = Client::create(Session::get('userInfo'));
        $user_name = Session::get('userInfo.user_name');
        $password = Session::get('userInfo.password');
        $mobile = Session::get('userInfo.mobile');
        $code = Session::get('userInfo.code');
        User::add($user_name, $password, $new_client->id, "client");

        // Add mobile client Numbers
        $mobiles = Session::get('userInfo.mobiles');
        if (isset($mobiles)) {
            foreach ($mobiles as $key => $val) {
                $data['code'] = $code;
                $data['number'] = $val;
                $data['client_id'] = $new_client->id;
                Client_mobile::create($data);
            }
        }
        // Add  client Emails
        $emails = Session::get('userInfo.emails');
        if ($emails) {
            foreach ($emails as $key => $val) {
                $data['email'] = $val;
                $data['client_id'] = $new_client->id;
                Client_email::create($data);
            }
        }

        // Send Email To Client
        $client_email = $new_client->email_address;
        $title = 'ترافل مارت | تم تسجيلك في الموقع بنجاح';
        $msg = 'تم اضافتك في قاعدة بيانات لدى ترافل مارت -  سوق الرحلات';
        Mail::send('admin.emails.addNewClientEmail', array('msg_data' => $msg), function($message) use($client_email, $title) {
            $message->to($client_email)->subject($title);
        });

        //Send Sms To Client
        $number = $code . $mobile;
        $msg = convertToUnicode('تم اضافتك في قاعدة بيانات لدى ترافل مارت (سوق الرحلات)');
        $userAccount = "966505854796";
        $passAccount = "hassanko6";
        $userSenderSMS = "ترافل مارت";
        $url = "http://www.mobily.ws/api/msgSend.php?mobile=" . $userAccount . "&password=" . $passAccount . "&numbers=" . $number . "&sender=TraveL%20Mart&msg=" . $msg . "&timeSend=0&dateSend=0&applicationType=24";
        fopen($url, "r");
        $ret = file_get_contents($url);

        Session::forget('userInfo');
        return redirect()->to('admin/clients/create/first')->with('success', 'تم اضافة بيانات العميل بنجاح');
    }

    // edit client data

    public function editFirst($id) {
        if (isset($_GET['parent_id']) AND ! empty($_GET['parent_id']))
            $parent_id = $_GET['parent_id'];
        else
            $parent_id = 'null';
        if (isset($_GET['type'])) {
            if ($_GET['type'] == 0 OR $_GET['type'] == 1) {
                $type = $_GET['type'];
            }
        } else
            $type = 'null';

        $countries = Country::all();
        $client = Client::find($id);
        $userData = User::where('user_id', $id)->first();
        $mobiles = Client_mobile::where('client_id', $id)->select('id', 'number')->get();
        $emails = Client_email::where('client_id', $id)->select('id', 'email')->get();

        return view('admin.clients.editFirst', compact('countries', 'parent_id', 'type', 'countrs', 'client', 'userData', 'mobiles', 'emails'));
    }

    public function deleteClientNumber($id) {
        Client_mobile::find($id)->delete();
        return redirect()->back()->with('success', 'تم حذف الرقم بنجاح');
    }

    public function deleteClientEmail($id) {
        Client_email::find($id)->delete();
        return redirect()->back()->with('success', 'تم حذف  البريد الالكتروني بنجاح');
    }

    public function updateFirst(Request $request, Client $client, $id) {

        $this->validate($request, [
            'user_name' => 'required', 'password' => 'required|min:6', 'userType' => 'required', 'username' => 'required', 'username_en' => 'required',
            'nationality' => 'required', 'country' => 'required', 'city' => 'required', 'mobile' => 'required|numeric', 'birth_date' => 'required',
            'mother_name' => 'required', 'email_address' => 'required|email', 'phone' => 'required|numeric', 'fax' => 'required', 'twitter' => 'required|url', 'instgram' => 'required|url',
            'skype' => 'required', 'facebook' => 'required|url', 'passport_number' => 'required|numeric', 'issue_date' => 'required', 'expire_date' => 'required',
            'passport_issue_place' => 'required', 'residence_number' => 'required|numeric', 'notes' => 'required',
        ]);
        $userInfo = $request->all();

        $client = Client::find($id);
        //upload images
        if ($request->file('photo') != null) {
            $userInfo['photo'] = $client->uploadFile($request->file('photo'));
            \File::delete(public_path() . $client->photo);
        }
        if ($request->file('family_card') != null) {
            $userInfo['family_card'] = $client->uploadFile($request->file('family_card'));
            \File::delete(public_path() . $client->family_card);
        }
        if ($request->file('passpot_copy') != null) {
            $userInfo['passpot_copy'] = $client->uploadFile($request->file('passpot_copy'));
            \File::delete(public_path() . $client->passpot_copy);
        }
        if ($request->file('residence_copy') != null) {
            $userInfo['residence_copy'] = $client->uploadFile($request->file('residence_copy'));
            \File::delete(public_path() . $client->residence_copy);
        }
        Client::find($id)->update($userInfo);

        // Add mobile client Numbers 
//        $mobiles = $request->mobiles;
//        if (isset($mobiles) && !empty($mobiles)) {
//            foreach ($mobiles as $key => $val) {
//                $data['code'] = $request->code;
//                $data['number'] = $val;
//                $data['client_id'] = $id;
//                Client_mobile::create($data);
//            }
//        }
//        // Add  client Emails
//        $emails = $request->emails;
//        if ($emails) {
//            foreach ($emails as $key => $val) {
//                $data['email'] = $val;
//                $data['client_id'] = $id;
//                Client_email::create($data);
//            }
//        }

        $userData['user_name'] = $request->user_name;
        $userData['password'] = $request->password;
        User::where(['user_id' => $id, 'type' => 'client'])->update($userData);

        return redirect('admin/clients/edit/second/' . $id);
    }

    public function editSecond($id) {
        $countries = Country::all();
        $client = Client::find($id);
        $userData = User::where('user_id', $id)->first();

        return view('admin.clients.editSecond', compact('countries', 'parent_id', 'type', 'countrs', 'client', 'userData'));
    }

    public function updateSecond(Request $request, Client $client, $id) {
        $this->validate($request, [
            'id_number' => 'required|numeric',
            'license_issue_date' => 'required',
            'license_expire_date' => 'required',
            'issuer' => 'required',
            'conservation_number' => 'required'
        ]);
        $userInfo = $request->all();
        $client = Client::find($id);
        //upload images
        if ($request->file('license_copy') != null) {
            $userInfo['license_copy'] = $client->uploadFile($request->file('license_copy'));
            \File::delete(public_path() . $client->photo);
        }

        Client::find($id)->update($userInfo);
        return redirect('admin/clients/edit/first/' . $id)->with('success' , 'تم حفظ التعديلات بنجاح');
    }

//    public function create() {
//        if (isset($_GET['parent_id']) AND ! empty($_GET['parent_id']))
//            $parent_id = $_GET['parent_id'];
//        else
//            $parent_id = 'null';
//
//        if (isset($_GET['type'])) {
//            if ($_GET['type'] == 0 OR $_GET['type'] == 1) {
//                $type = $_GET['type'];
//            }
//        } else
//            $type = 'null';
//
//        $countries = Country::select('name', 'code', 'id')->get();
//        return view('admin.clients.create', compact('countries', 'parent_id', 'type'));
//    }

//    public function getAjax(Request $request, Client $client) {
//        $data = array($request->except(['photo', 'passpot_copy', 'user_name', 'password']));
//
//        if ($request->file('photo') != null)
//            $data[0]['photo'] = $client->uploadFile($request->file('photo'));
//        if ($request->file('family_card') != null)
//            $data[0]['family_card'] = $client->uploadFile($request->file('family_card'));
//        if ($request->file('passpot_copy') != null)
//            $data[0]['passpot_copy'] = $client->uploadFile($request->file('passpot_copy'));
//        if ($request->file('residence_copy') != null)
//            $data[0]['residence_copy'] = $client->uploadFile($request->file('residence_copy'));
//        if ($request->file('license_copy') != null)
//            $data[0]['license_copy'] = $client->uploadFile($request->file('license_copy'));
//
//        return($data[0]);
//        $data[0]['username_en'] = strtoupper($data[0]['username_en']);
//        // return $data[0]['username_en'];
//        $new_client = Client::create($data[0]);
//        $data['new_client_id'] = $new_client->id;
//        User::add($request->user_name, $request->password, $new_client->id, "client");
//
//        $parent_id = $request->parent_id;
//        $type = $request->type;
//        if ($parent_id AND $parent_id != 'null') {
//            if ($type == 0 OR $type == 1) {
//                $data['parent_id'] = $parent_id;
//                $data['type'] = $type;
//                Client_family::create($data);
//            }
//        }
//
//
//        // Add mobile client Numbers
//        if ($request['mobiles']) {
//            foreach ($request['mobiles'] as $key => $val) {
//                $data['code'] = $request['code'];
//                $data['number'] = $val;
//                Client_mobile::create($data);
//            }
//        }
//        // Add  client Emails
//        if (isset($request['emails'])) {
//            foreach ($request['emails'] as $key => $val) {
//                $data['email'] = $val;
//                $data['client_id'] = $data['new_client_id'];
//                Client_email::create($data);
//            }
//        }
//        if (isset($request['phones'])) {
//            foreach ($request['phones'] as $key => $val) {
//                $data['number'] = $val;
//                $data['client_id'] = $data['new_client_id'];
//                Client_email::create($data);
//            }
//        }
//
//        // Send Email To Client
//        /*         * *
//          $client_email = $new_client->email_address;
//          $title        = 'ترافل مارت | تم تسجيلك في الموقع بنجاح';
//          $msg          = 'تم اضافتك في قاعدة بيانات لدى ترافل مارت -  سوق الرحلات';
//
//          Mail::send('admin.emails.addNewClientEmail',
//          array('msg_data' => $msg ), function($message) use($client_email , $title)
//          {
//          $message->to($client_email)->subject($title);
//          });
//         * * */
//        //Send Sms To Client
//        /*         * **
//          $number         = $request['code'].$request['mobile'];
//          $msg            = convertToUnicode('تم اضافتك في قاعدة بيانات لدى ترافل مارت (سوق الرحلات)');
//          $userAccount    = "966505854796";
//          $passAccount    = "hassanko6";
//          $userSenderSMS  = "ترافل مارت";
//          $url ="http://www.mobily.ws/api/msgSend.php?mobile=".$userAccount."&password=".$passAccount."&numbers=".$number."&sender=TraveL%20Mart&msg=".$msg."&timeSend=0&dateSend=0&applicationType=24";
//          fopen($url,"r");
//          $ret = file_get_contents($url);
//         * ** */
//
//        // check on value of expire date
//        $expire_date = $request->expire_date;
//        $expire_date = str_replace('/', '-', $expire_date);
//        $expire_date = date("Y-m-d", strtotime($expire_date));
//        $date1 = new \DateTime(Date('Ymd'));
//        $date2 = new \DateTime($expire_date);
//        $interval = $date1->diff($date2);
//        if ($interval->format('%r') == '-') {
//            return "عفوا لقد انتهت صلاحية جواز السفر";
//        } else {
//            return ("باقي على تاريخ انتهاء الجواز : " . $interval->format('%y') . " سنة - " . $interval->format('%m') . " شهر - " . $interval->format('%d') . "يوم");
//        }
//    }

    public function getCode(Request $request) {
        $data = $request->all();
        $country_code = $data['country'];
        $getCounDilaCode = file_get_contents("https://restcountries.eu/rest/v1/alpha?codes=" . $country_code);
        $DilaCode = json_decode($getCounDilaCode)[0]->callingCodes[0];
        return $DilaCode;
    }

    public function show($id) {
        $client = Client::find($id);
        return view('admin.clients.show', compact('client'));
    }

    public function edit($id) {
        $client = Client::find($id);
        $countries = Country::select('name', 'code')->get();
        $cities = City::all();
        $emails = Client_email::where('client_id', $id)->get();
        $mobiles = Client_mobile::where('client_id', $id)->get();
        return view('admin.clients.edit', compact('client', 'countries', 'cities', 'emails', 'mobiles'));
    }

    public function updateAjax(Request $request, $id, Client $client) {

        $client_data = Client::find($id);
        $data = array($request->except('user_name', 'password'));


        if ($request->file('photo') != null)
            $data[0]['photo'] = $client->uploadfile($request->file('photo'));
        else {
            $old_photo = $client_data->photo;
            $data[0]['photo'] = $old_photo;
        }
        if ($request->file('family_card') != null)
            $data[0]['family_card'] = $client->uploadFile($request->file('family_card'));
        else {
            $old_family_card = $client_data->family_card;
            $data[0]['family_card'] = $old_family_card;
        }

        if ($request->file('passpot_copy') != null)
            $data[0]['passpot_copy'] = $client->uploadfile($request->file('passpot_copy'));
        else {
            $old_passpot_copy = $client_data->passpot_copy;
            $data[0]['passpot_copy'] = $old_passpot_copy;
        }

        if ($request->file('residence_copy') != null)
            $data[0]['residence_copy'] = $client->uploadfile($request->file('residence_copy'));
        else {
            $old_residence_copy = $client_data->residence_copy;
            $data[0]['residence_copy'] = $old_residence_copy;
        }

        if ($request->file('license_copy') != null)
            $data[0]['license_copy'] = $client->uploadfile($request->file('license_copy'));
        else {
            $old_license_copy = $client_data->license_copy;
            $data[0]['license_copy'] = $old_license_copy;
        }

        $data[0]['username_en'] = strtoupper($data[0]['username_en']);

        Client::find($id)->update($data[0]);
        User::edit($request->user_name, $request->password, $id, "client");

        if ($request['mobiles']) {
            Client_mobile::where('client_id', $id)->delete();
            foreach ($request['mobiles'] as $key => $val) {
                $data['client_id'] = $id;
                $data['code'] = $request['code'];
                $data['number'] = $val;
                Client_mobile::create($data);
            }
        }



        if ($request['emails']) {
            Client_email::where('client_id', $id)->delete();
            foreach ($request['emails'] as $key => $val) {
                $data['email'] = $val;
                $data['client_id'] = $id;
                Client_email::create($data);
            }
        }
    }

    public function destroy($id) {
        $client = Client::find($id);
        $client->user->delete();
        $client->delete();
        return Redirect::back()->with('success', 'تم الحذف بنجاح');
    }

    public function familiesIndex() {
        $data['clients'] = Client::all();
        $data['i'] = 0;
        return view('admin.clients.families.index', $data);
    }

    public function familiesShow($id) {
        $data['id'] = $id;
        $data['client'] = Client::find($id);
        $data['family'] = Client_family::where(['parent_id' => $id])->orderBy('type', 'asc')->get();

        if (count($data['family']) == 0 && Client_family::where(['new_client_id' => $id])->count() != 0) {
            $data['parent_id'] = Client_family::where(['new_client_id' => $id])->first()->parent_id;
            $data['P_family'] = Client_family::where(['parent_id' => $data['parent_id']])->orderBy('type', 'asc')->get();
            $data['type'] = Client_family::where(['new_client_id' => $id])->first()->type;
        }
        if (count($data['family']) == 0 && !isset($data['P_family']))
            $data['C_family'] = "";

        return view('admin.clients.families.show', $data);
    }

    public function family($id) {
        $client_wife = Client_family::where(['parent_id' => $id, 'type' => 0])->first();
        $client_child = Client_family::where(['parent_id' => $id, 'type' => 1])->get();

        if ($client_wife)
            $wife_name = Client::where(['id' => $client_wife->new_client_id])->get();

        if ($client_child) {
            foreach ($client_child as $row) {
                $child_name[] = Client::where(['id' => $row->new_client_id])->get();
            }
        }

        $client = Client::find($id);

        return view('admin.clients.family', compact('client_wife', 'client_child', 'client', 'wife_name', 'child_name'));
    }

    public function addWife(Client_familyRequest $request) {
        $data = $request->all();
        $data['type'] = 0;
        Client_family::create($data);
        return Redirect::back()->with('success', 'لقد تمت عملية الاضافة بنجاح');
    }

    public function updateWife(Client_familyRequest $request, $id) {
        $data['name'] = $request->name;
        Client_family::where('id', $id)->update($data);
        return Redirect::back()->with('success', 'لقد تمت عملية التعديل بنجاح');
    }

    public function addChild(Client_familyRequest $request) {
        $data = $request->all();
        $data['type'] = 1;
        Client_family::create($data);
        return Redirect::back()->with('success', 'لقد تمت عملية الاضافة بنجاح');
    }

    public function updateChild(Client_familyRequest $request) {
        $id = $request->child_id;
        $data['name'] = $request->name;
        Client_family::where('id', $id)->update($data);
        return Redirect::back()->with('success', 'لقد تمت عملية التعديل بنجاح');
    }

// =============== Email And Sms ============

    public function send_email($id) {
        $client = Client::find($id);
        return view('admin.clients.send_client_email', compact('client'));
    }

    public function doSendEmail(EmailClientRequest $request) {
        $userid = $request['userid'];
        $title = $request['title'];
        $msg = $request['msg'];
        $client = Client::find($userid);
        $client_email = $client['email_address'];

        Mail::send('admin.emails.send_client_email', array('msg_data' => $msg), function($message) use($client_email, $title) {
            $message->to($client_email)->subject($title);
        });
        return Redirect::back()->with('success', 'تم ارسال البريد الالكتروني بنجاح');
    }

    public function send_sms($id) {
        $sms_balance = "http://www.mobily.ws/api/balance.php?mobile=966505854796&password=hassanko6";
        fopen($sms_balance, "r");
        $sms_balance = file_get_contents($sms_balance);
        $client = Client::find($id);
        $client_mobile = $client['code'] . $client['mobile'];
        if ($client_mobile) {
            $mobile_numer = $client_mobile;
            return view('admin.clients.send_client_sms', compact('client', 'mobile_numer', 'sms_balance'));
        } else {
            return Redirect::back()->with('error', 'لا يوجد رقم لهذا العميل يرجى اضافة رقم اولا ثم ارسال الرسالة');
        }
    }

    public function doSendSms(SmsClientRequest $request) {
        $number = $request['number'];
        $msg = convertToUnicode($request['msg']);
        $userAccount = "966505854796";
        $passAccount = "hassanko6";
        $userSenderSMS = "Travel";
        $url = "http://www.mobily.ws/api/msgSend.php?mobile=" . $userAccount . "&password=" . $passAccount . "&numbers=" . $number . "&sender=TraveL%20Mart&msg=" . $msg . "&applicationType=24";
        //fopen($url,"r");
        $ret = file_get_contents($url);
        if ($ret == 1) {
            return Redirect::back()->with('success', 'تم ارسال الرسالة بنجاح بنجاح');
        } else if ($ret == 0) {
            return Redirect::back()->with('error', 'حدث خطأ اثناء الارسال يرجى مراجعة مزود الخدمة');
        }
    }

    // Send Email Group
    public function get_group_email(Request $request) {
        $client_email = array();
        $selectedClients = $request['checkedValue'];
        $clients_count = count($selectedClients);
        for ($i = 0; $i < $clients_count; $i++) {
            $id = $selectedClients[$i];
            $email = client::where('id', $id)->pluck('email_address');
            array_push($client_email, $email);
        }
        return $client_email;
    }

    public function send_group_email(Request $request) {
        $emails = explode(",", $_GET['emails']);
        $all_emails = Client::lists('email_address', 'email_address');
        return view('admin.clients.send_group_client_email', compact('emails', 'all_emails'));
    }

    public function do_send_group_email(EmailClientRequest $request) {
        $msg = $request['msg'];
        $title = $request['title'];
        $emails = $request['email'];
        foreach ($emails as $key => $client_email) {
            Mail::send('admin.emails.send_client_email', array('msg_data' => $msg), function($message) use($client_email, $title) {
                $message->to($client_email)->subject($title);
            });
        }
        return Redirect::back()->with('success', 'تم ارسال البريد الالكتروني بنجاح');
    }

    // Send SMS Group
    public function get_group_sms(Request $request) {
        $client_number = array();
        $selectedClients = $request['checkedValue'];
        $clients_count = count($selectedClients);
        for ($i = 0; $i < $clients_count; $i++) {
            $id = $selectedClients[$i];
            $client = client::find($id);
            if (!empty($client)) {
                array_push($client_number, $client['code'] . $client['mobile']);
            }
        }
        return $client_number;
    }

    public function send_group_sms() {
        $sms_balance = "http://www.mobily.ws/api/balance.php?mobile=966505854796&password=hassanko6";
        fopen($sms_balance, "r");
        $sms_balance = file_get_contents($sms_balance);
        $numbers = $_GET['numbers'];
        return view('admin.clients.send_group_client_sms', compact('numbers', 'sms_balance'));
    }

    public function do_send_group_sms(SmsClientRequest $request) {
        $number = $request['number'];
        $msg = convertToUnicode($request['msg']);
        $userAccount = "966505854796";
        $passAccount = "hassanko6";
        $userSenderSMS = "Travel";
        $url = "http://www.mobily.ws/api/msgSend.php?mobile=" . $userAccount . "&password=" . $passAccount . "&numbers=" . $number . "&sender=TraveL%20Mart&msg=" . $msg . "&applicationType=24";
        //fopen($url,"r");
        $ret = file_get_contents($url);
        if ($ret == 1) {
            return Redirect::back()->with('success', 'تم ارسال الرسالة بنجاح بنجاح');
        } else if ($ret == 0) {
            return Redirect::back()->with('error', 'حدث خطأ اثناء الارسال يرجى مراجعة مزود الخدمة');
        }
    }

    public function getClientInfo() {
        $clientInfo = Client::find($_GET['client_id']);
        return $clientInfo;
    }

    public function getClientWife() {
        $clientFamily = Client_family::where('parent_id', $_GET['client_id'])->get();

        $wife = array();
        foreach ($clientFamily as $row) {
            if ($row->type == 0) {
                array_push($wife, client::find($row->new_client_id));
            }
        }
        return $wife;
    }

    public function getClientChild() {
        $clientFamily = Client_family::where('parent_id', $_GET['client_id'])->get();

        $child = array();
        foreach ($clientFamily as $row) {
            if ($row->type == 1) {
                array_push($child, client::find($row->new_client_id));
            }
        }
        return $child;
    }

    /*
      public function getClientFamily()
      {
      $clientFamily = Client_family::where('parent_id' , $_GET['client_id'])->get();

      $family = array();
      foreach ($clientFamily as $row) {
      if($row->type == 0)
      {
      array_push($family ,  client::find($row->new_client_id));
      }
      if ($row->type == 1)
      {
      array_push($family ,  client::find($row->new_client_id));
      }

      }
      return $family;
      }
     */
}


//دالة تحويل الرساله إلى ترميز UNICODE الخاص بالإرسال من خلال بوابة موبايلي
function convertToUnicode($message) {
    $chrArray[0] = "،";
    $unicodeArray[0] = "060C";
    $chrArray[1] = "؛";
    $unicodeArray[1] = "061B";
    $chrArray[2] = "؟";
    $unicodeArray[2] = "061F";
    $chrArray[3] = "ء";
    $unicodeArray[3] = "0621";
    $chrArray[4] = "آ";
    $unicodeArray[4] = "0622";
    $chrArray[5] = "أ";
    $unicodeArray[5] = "0623";
    $chrArray[6] = "ؤ";
    $unicodeArray[6] = "0624";
    $chrArray[7] = "إ";
    $unicodeArray[7] = "0625";
    $chrArray[8] = "ئ";
    $unicodeArray[8] = "0626";
    $chrArray[9] = "ا";
    $unicodeArray[9] = "0627";
    $chrArray[10] = "ب";
    $unicodeArray[10] = "0628";
    $chrArray[11] = "ة";
    $unicodeArray[11] = "0629";
    $chrArray[12] = "ت";
    $unicodeArray[12] = "062A";
    $chrArray[13] = "ث";
    $unicodeArray[13] = "062B";
    $chrArray[14] = "ج";
    $unicodeArray[14] = "062C";
    $chrArray[15] = "ح";
    $unicodeArray[15] = "062D";
    $chrArray[16] = "خ";
    $unicodeArray[16] = "062E";
    $chrArray[17] = "د";
    $unicodeArray[17] = "062F";
    $chrArray[18] = "ذ";
    $unicodeArray[18] = "0630";
    $chrArray[19] = "ر";
    $unicodeArray[19] = "0631";
    $chrArray[20] = "ز";
    $unicodeArray[20] = "0632";
    $chrArray[21] = "س";
    $unicodeArray[21] = "0633";
    $chrArray[22] = "ش";
    $unicodeArray[22] = "0634";
    $chrArray[23] = "ص";
    $unicodeArray[23] = "0635";
    $chrArray[24] = "ض";
    $unicodeArray[24] = "0636";
    $chrArray[25] = "ط";
    $unicodeArray[25] = "0637";
    $chrArray[26] = "ظ";
    $unicodeArray[26] = "0638";
    $chrArray[27] = "ع";
    $unicodeArray[27] = "0639";
    $chrArray[28] = "غ";
    $unicodeArray[28] = "063A";
    $chrArray[29] = "ف";
    $unicodeArray[29] = "0641";
    $chrArray[30] = "ق";
    $unicodeArray[30] = "0642";
    $chrArray[31] = "ك";
    $unicodeArray[31] = "0643";
    $chrArray[32] = "ل";
    $unicodeArray[32] = "0644";
    $chrArray[33] = "م";
    $unicodeArray[33] = "0645";
    $chrArray[34] = "ن";
    $unicodeArray[34] = "0646";
    $chrArray[35] = "ه";
    $unicodeArray[35] = "0647";
    $chrArray[36] = "و";
    $unicodeArray[36] = "0648";
    $chrArray[37] = "ى";
    $unicodeArray[37] = "0649";
    $chrArray[38] = "ي";
    $unicodeArray[38] = "064A";
    $chrArray[39] = "ـ";
    $unicodeArray[39] = "0640";
    $chrArray[40] = "ً";
    $unicodeArray[40] = "064B";
    $chrArray[41] = "ٌ";
    $unicodeArray[41] = "064C";
    $chrArray[42] = "ٍ";
    $unicodeArray[42] = "064D";
    $chrArray[43] = "َ";
    $unicodeArray[43] = "064E";
    $chrArray[44] = "ُ";
    $unicodeArray[44] = "064F";
    $chrArray[45] = "ِ";
    $unicodeArray[45] = "0650";
    $chrArray[46] = "ّ";
    $unicodeArray[46] = "0651";
    $chrArray[47] = "ْ";
    $unicodeArray[47] = "0652";
    $chrArray[48] = "!";
    $unicodeArray[48] = "0021";
    $chrArray[49] = '"';
    $unicodeArray[49] = "0022";
    $chrArray[50] = "#";
    $unicodeArray[50] = "0023";
    $chrArray[51] = "$";
    $unicodeArray[51] = "0024";
    $chrArray[52] = "%";
    $unicodeArray[52] = "0025";
    $chrArray[53] = "&";
    $unicodeArray[53] = "0026";
    $chrArray[54] = "'";
    $unicodeArray[54] = "0027";
    $chrArray[55] = "(";
    $unicodeArray[55] = "0028";
    $chrArray[56] = ")";
    $unicodeArray[56] = "0029";
    $chrArray[57] = "*";
    $unicodeArray[57] = "002A";
    $chrArray[58] = "+";
    $unicodeArray[58] = "002B";
    $chrArray[59] = ",";
    $unicodeArray[59] = "002C";
    $chrArray[60] = "-";
    $unicodeArray[60] = "002D";
    $chrArray[61] = ".";
    $unicodeArray[61] = "002E";
    $chrArray[62] = "/";
    $unicodeArray[62] = "002F";
    $chrArray[63] = "0";
    $unicodeArray[63] = "0030";
    $chrArray[64] = "1";
    $unicodeArray[64] = "0031";
    $chrArray[65] = "2";
    $unicodeArray[65] = "0032";
    $chrArray[66] = "3";
    $unicodeArray[66] = "0033";
    $chrArray[67] = "4";
    $unicodeArray[67] = "0034";
    $chrArray[68] = "5";
    $unicodeArray[68] = "0035";
    $chrArray[69] = "6";
    $unicodeArray[69] = "0036";
    $chrArray[70] = "7";
    $unicodeArray[70] = "0037";
    $chrArray[71] = "8";
    $unicodeArray[71] = "0038";
    $chrArray[72] = "9";
    $unicodeArray[72] = "0039";
    $chrArray[73] = ":";
    $unicodeArray[73] = "003A";
    $chrArray[74] = ";";
    $unicodeArray[74] = "003B";
    $chrArray[75] = "<";
    $unicodeArray[75] = "003C";
    $chrArray[76] = "=";
    $unicodeArray[76] = "003D";
    $chrArray[77] = ">";
    $unicodeArray[77] = "003E";
    $chrArray[78] = "?";
    $unicodeArray[78] = "003F";
    $chrArray[79] = "@";
    $unicodeArray[79] = "0040";
    $chrArray[80] = "A";
    $unicodeArray[80] = "0041";
    $chrArray[81] = "B";
    $unicodeArray[81] = "0042";
    $chrArray[82] = "C";
    $unicodeArray[82] = "0043";
    $chrArray[83] = "D";
    $unicodeArray[83] = "0044";
    $chrArray[84] = "E";
    $unicodeArray[84] = "0045";
    $chrArray[85] = "F";
    $unicodeArray[85] = "0046";
    $chrArray[86] = "G";
    $unicodeArray[86] = "0047";
    $chrArray[87] = "H";
    $unicodeArray[87] = "0048";
    $chrArray[88] = "I";
    $unicodeArray[88] = "0049";
    $chrArray[89] = "J";
    $unicodeArray[89] = "004A";
    $chrArray[90] = "K";
    $unicodeArray[90] = "004B";
    $chrArray[91] = "L";
    $unicodeArray[91] = "004C";
    $chrArray[92] = "M";
    $unicodeArray[92] = "004D";
    $chrArray[93] = "N";
    $unicodeArray[93] = "004E";
    $chrArray[94] = "O";
    $unicodeArray[94] = "004F";
    $chrArray[95] = "P";
    $unicodeArray[95] = "0050";
    $chrArray[96] = "Q";
    $unicodeArray[96] = "0051";
    $chrArray[97] = "R";
    $unicodeArray[97] = "0052";
    $chrArray[98] = "S";
    $unicodeArray[98] = "0053";
    $chrArray[99] = "T";
    $unicodeArray[99] = "0054";
    $chrArray[100] = "U";
    $unicodeArray[100] = "0055";
    $chrArray[101] = "V";
    $unicodeArray[101] = "0056";
    $chrArray[102] = "W";
    $unicodeArray[102] = "0057";
    $chrArray[103] = "X";
    $unicodeArray[103] = "0058";
    $chrArray[104] = "Y";
    $unicodeArray[104] = "0059";
    $chrArray[105] = "Z";
    $unicodeArray[105] = "005A";
    $chrArray[106] = "[";
    $unicodeArray[106] = "005B";
    $char = "\ ";
    $chrArray[107] = trim($char);
    $unicodeArray[107] = "005C";
    $chrArray[108] = "]";
    $unicodeArray[108] = "005D";
    $chrArray[109] = "^";
    $unicodeArray[109] = "005E";
    $chrArray[110] = "_";
    $unicodeArray[110] = "005F";
    $chrArray[111] = "`";
    $unicodeArray[111] = "0060";
    $chrArray[112] = "a";
    $unicodeArray[112] = "0061";
    $chrArray[113] = "b";
    $unicodeArray[113] = "0062";
    $chrArray[114] = "c";
    $unicodeArray[114] = "0063";
    $chrArray[115] = "d";
    $unicodeArray[115] = "0064";
    $chrArray[116] = "e";
    $unicodeArray[116] = "0065";
    $chrArray[117] = "f";
    $unicodeArray[117] = "0066";
    $chrArray[118] = "g";
    $unicodeArray[118] = "0067";
    $chrArray[119] = "h";
    $unicodeArray[119] = "0068";
    $chrArray[120] = "i";
    $unicodeArray[120] = "0069";
    $chrArray[121] = "j";
    $unicodeArray[121] = "006A";
    $chrArray[122] = "k";
    $unicodeArray[122] = "006B";
    $chrArray[123] = "l";
    $unicodeArray[123] = "006C";
    $chrArray[124] = "m";
    $unicodeArray[124] = "006D";
    $chrArray[125] = "n";
    $unicodeArray[125] = "006E";
    $chrArray[126] = "o";
    $unicodeArray[126] = "006F";
    $chrArray[127] = "p";
    $unicodeArray[127] = "0070";
    $chrArray[128] = "q";
    $unicodeArray[128] = "0071";
    $chrArray[129] = "r";
    $unicodeArray[129] = "0072";
    $chrArray[130] = "s";
    $unicodeArray[130] = "0073";
    $chrArray[131] = "t";
    $unicodeArray[131] = "0074";
    $chrArray[132] = "u";
    $unicodeArray[132] = "0075";
    $chrArray[133] = "v";
    $unicodeArray[133] = "0076";
    $chrArray[134] = "w";
    $unicodeArray[134] = "0077";
    $chrArray[135] = "x";
    $unicodeArray[135] = "0078";
    $chrArray[136] = "y";
    $unicodeArray[136] = "0079";
    $chrArray[137] = "z";
    $unicodeArray[137] = "007A";
    $chrArray[138] = "{";
    $unicodeArray[138] = "007B";
    $chrArray[139] = "|";
    $unicodeArray[139] = "007C";
    $chrArray[140] = "}";
    $unicodeArray[140] = "007D";
    $chrArray[141] = "~";
    $unicodeArray[141] = "007E";
    $chrArray[142] = "©";
    $unicodeArray[142] = "00A9";
    $chrArray[143] = "®";
    $unicodeArray[143] = "00AE";
    $chrArray[144] = "÷";
    $unicodeArray[144] = "00F7";
    $chrArray[145] = "×";
    $unicodeArray[145] = "00F7";
    $chrArray[146] = "§";
    $unicodeArray[146] = "00A7";
    $chrArray[147] = " ";
    $unicodeArray[147] = "0020";
    $chrArray[148] = "\n";
    $unicodeArray[148] = "000D";
    $chrArray[149] = "\r";
    $unicodeArray[149] = "000A";

    $strResult = "";
    for ($i = 0; $i < strlen($message); $i++) {
        if (in_array(mb_substr($message, $i, 1, 'UTF-8'), $chrArray))
            $strResult.= $unicodeArray[array_search(mb_substr($message, $i, 1, 'UTF-8'), $chrArray)];
    }
    return $strResult;
}
