<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\Office;
use App\Http\Requests\MeetingsRequest;
use App\Http\Requests\EmployeesEmailsRequest;
use App\Http\Models\Employee;
use App\MeetingPlace;
use App\MeetingType;
use App\Notification;
use App\Meeting;
use Redirect;

class MeetingsController extends Controller {

    public function index() {
        $meetings = Meeting::all();
        return view('admin.meetings.index', ['meetings' => $meetings, 'i' => 0]);
    }

    public function show($id) {
        $meeting = Meeting::find($id);
        $meeting_event = $meeting->meetingEvent;
        $arr_diff = array_diff(json_decode($meeting->employee_id), json_decode($meeting_event->attendants));
        $absences = Employee::whereIn('id', $arr_diff)->get();
        return view('admin.meetings.show', ['meeting' => $meeting, 'absences' => $absences, 'i' => 0]);
    }

    public function create() {
        $data['offices'] = Office::lists('name', 'id');
        $data['places'] = MeetingPlace::lists('place', 'id');
        $data['types'] = MeetingType::lists('type', 'id');
        return view('admin.meetings.create', ['data' => $data]);
    }

    public function store(MeetingsRequest $request, Notification $notify) {

        $meeting = Meeting::create($request->except('employee_id', 'office') + ['employee_id' => json_encode(array_unique($request->employee_id))]);
        $notify->createNotification($meeting->id, "meeting", "يوجد اجتماع", $meeting->employee_id);
        return Redirect::back()->with('global_s', 'لقد تم انشاء الاجتماع بنجاح');
    }

    public function edit($id) {
        $data['meeting'] = Meeting::find($id);
        $data['offices'] = Office::lists('name', 'id');
        $data['places'] = MeetingPlace::lists('place', 'id');
        $data['types'] = MeetingType::lists('type', 'id');
        $data['employees'] = Employee::whereIn('id', json_decode($data['meeting']->employee_id))->lists('name', 'id');

        return view('admin.meetings.edit', ['data' => $data]);
    }

    public function update(MeetingsRequest $request, Notification $notify, $id) {
        $meeting = Meeting::find($id);

        $meeting->update($request->except('employee_id', 'office') + ['employee_id' => json_encode(array_unique($request->employee_id))]);

        $notify->createNotification($id, "meeting", "تم تعديل الاجتماع متروحوش اللى فات وروحوا دا", json_encode(array_unique($request->employee_id)));

        return Redirect::back()->with('global_s', 'لقد تم تعديل  الاجتماع بنجاح');
    }

    public function destroy($id) {
        $meeting = Meeting::find($id);
        $internal_notifications = $meeting->meetingNotifications->where('type', 'meeting');

        //delete meeting notifications
        if ($internal_notifications != null) {
            foreach ($internal_notifications as $notification)
                $notification->delete();
        }

        //delete meeting's event
        if ($meeting->meetingEvent != null) {
            //delete absences with reasons
            if ($meeting->meetingEvent->absences->count() != 0) {
                foreach ($meeting->meetingEvent->absences as $absence)
                    $absence->delete();
            }

            \File::delete(public_path() . $meeting->meetingEvent->file);
            $meeting->meetingEvent->delete();
        }

        $meeting->delete();
        return Redirect::back()->with('global_s', 'لقد تم حذف الاجتماع بنجاح');
    }

    public function getEmployees() {
        return Employee::where('office_id', $_GET['id'])->get();
    }

    public function getEmails() {
        $data['offices'] = Office::lists('name', 'id');
        return view('admin.meetings.send_emails', $data);
    }

    public function sendEmails(EmployeesEmailsRequest $request) {
        if ($request->all_employees == null && $request->employee_id == null)
            return Redirect::back()->with('global_r', 'من فضلك قم باختيار بريد الكترونى واحد على الاقل لارسال الرسالة')->withInput();

        $employees = [];
        if ($request->all_employees == 1)
            $Emails = Employee::get(['email'])->toArray();
        else
            $employees = Employee::whereIn('id', $request->employee_id)->get(['email'])->toArray();

        $title = $request->title;
        $Smessage = $request->message;

        // send emails to buses suppliers
        \Mail::send('emails.admin.flightReservation.busesSuppliers', array('Smessage' => $Smessage), function($message) use($employees, $title) {
            foreach ($employees as $employee)
                $message->to($employee['email'])->subject($title);
        });
        return Redirect::back()->with('global_s', 'لقد تم ارسال الرسالة الى البريدات الالكترونية المحددة بنجاح');
    }

}
