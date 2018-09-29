<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Advertisement;
use App\Http\Models\Country;
use App\Http\Requests\AdvertisementsRequest;
use Redirect;
use App\Client;
use File;
use App\Http\Models\City;
use App\Message;
use App\DesignerAdvertising;

class AdvertisementsController extends Controller {

    public function index() {
        $advertisements = Advertisement::all();
        return view('admin.advertisements.index', ['advertisements' => $advertisements, 'i' => 0]);
    }

    public function create() {
        $data['countries'] = Country::lists('name', 'code');
        $data['designers'] = DesignerAdvertising::lists('name', 'id');
        return view('admin.advertisements.create', $data);
    }

    public function store(AdvertisementsRequest $request, Client $upload) {
        if ($request->file != null)
            $file = $upload->uploadFile($request->file);
        else
            $file = null;

        Advertisement::create($request->except('file') + ['file' => $file]);
        return Redirect::back()->with('global_s', 'تم اضافة الاعلان بنجاح');
    }

    public function show($id) {
        $advertisement = Advertisement::find($id);
        return view('admin.advertisements.show', ['advertisement' => $advertisement]);
    }

    public function edit($id) {
        $data['advertisement'] = Advertisement::find($id);
        $data['countries'] = Country::lists('name', 'code');
        $data['designers'] = DesignerAdvertising::lists('name', 'id');
        $data['cities'] = City::where('country_code', $data['advertisement']->country)->lists('name', 'id');
        return view('admin.advertisements.edit', $data);
    }

    public function update(AdvertisementsRequest $request, Client $upload, $id) {
        $advertisement = Advertisement::find($id);

        if ($request->file != null) {
            if ($advertisement->file != "/noimage.gif")
                File::delete(public_path() . $advertisement->file);
            $file = $upload->uploadFile($request->file);
        } else
            $file = $advertisement->file;

        $advertisement->update($request->except('file') + ['file' => $file]);
        return Redirect::back()->with('global_s', 'لقد تم تعديل الاعلان بنجاح');
    }

    public function sendAdvertise($id) {
        $clients = Client::lists('username', 'id');
        return view('admin.advertisements.sendAdvertise', ['clients' => $clients, 'id' => $id]);
    }

    public function sendAdvertiseToClients(Message $message, $id) {
        $ids_arr = [];
        $data = \Request::all();
        $advertisement = Advertisement::find($id);
        $file = \URL::to(Advertisement::find($id)->file);

        if (isset($data['all_clients']))
            $clients = Client::all();
        elseif (isset($data['clients']))
            $clients = Client::whereIn('id', $data['clients'])->get();
        else
            return Redirect::back()->with('global_r', 'يجب اختيار احد العملاء لنتمكن من ارسال الاعلان');


        //send internal message to clients
        foreach ($clients as $client)
            array_push($ids_arr, $client->id);
        $message->createMessage($id, "advertise", "يوجد اعلان جديد", json_encode($ids_arr));

        //send emails to clients
        \Mail::send('emails.admin.advertisements.newAdvertisement', array('advertisement' => $advertisement), function($message) use($clients, $file) {
            foreach ($clients as $client) {
                $message->to($client->email_address)->subject("اعلان جديد");
                $message->attach($file);
            }
        });

        return Redirect::back()->with('global_s', 'لقد تم ارسال الاعلان الى العملاء بنجاح');
    }

    public function changeMessagesSeen() {
        Message::where('seen', 0)->update(['seen' => 1]);
    }

    public function destroy($id) {
        $advertisement = Advertisement::find($id);
        $internal_messages = $advertisement->messageNotifications->where('type', 'advertise');

        //delete messages notification
        if ($internal_messages != null) {
            foreach ($internal_messages as $message) {
                $message->delete();
            }
        }

        File::delete(public_path() . $advertisement->file);
        $advertisement->delete();
        return Redirect::back()->with('success', 'لقد تم حذف الاعلان بنجاح');
    }

}
