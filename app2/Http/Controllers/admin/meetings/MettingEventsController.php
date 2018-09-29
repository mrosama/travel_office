<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Models\Employee;
use Redirect;
use App\Meeting;
use App\Meeting_event;
use App\Meeting_Reason;
use App\Http\Requests\MettingEventsRequest;
use App\Client;

class MettingEventsController extends Controller
{

	public function create($id)
	{
		$data['meeting']   = Meeting::find($id);
		$data['employees'] = Employee::whereIn('id' , json_decode($data['meeting']->employee_id))->lists('name' , 'id');

		return view('admin.meetings.events.create' , ['data'=>$data]);
	}

	public function store(MettingEventsRequest $request ,  Client $upload , $id)
	{
		$meeting   = Meeting::find($id);

		if($request->file != null)
			$file = $upload->uploadFile($request->file);
		else
			$file = null;


		Meeting_event::create($request->except("attendants" , "file") + ['meeting_id'=>$id , 'attendants'=>json_encode($request->attendants) , 'file'=>$file]);

		//send emails to attenders
		\Mail::send('emails.admin.meetings.meetingEvents', array('data'=> $request->except("attendants" , "file") , "meeting"=>$meeting), function($message) use($request , $meeting)
		{
			$attendants = Employee::whereIn('id' , json_decode($meeting->employee_id))->get();
			foreach($attendants as $attendant)
			{
				$message->to($attendant->email)->subject("احداث الاجتماع ".$meeting->address);
			}
		});

		return Redirect::route("admin.meetings.events.edit" , $id)->with('global_s' , 'لقد اتم اضافة وارسال احداث الاجتماع بنجاح');
	}

	public function edit($id)
	{
		$data['event_meeting'] = Meeting_event::where("meeting_id" , $id)->first();
		$data['employees']     = Employee::whereIn('id' , json_decode($data['event_meeting']->meeting->employee_id))->lists('name' , 'id');
		return view('admin.meetings.events.edit' , ['data'=>$data]);
	}

	public function update(MettingEventsRequest $request , Client $upload , $id)
	{
		$meeting_event = Meeting_event::find($id);
		$meeting = $meeting_event->meeting;

		if($request->file != null)
		{
			if($meeting_event->file != "/noimage.gif")
				\File::delete(public_path().$meeting_event->file);
			$file = $upload->uploadFile($request->file);
		}
		else
			$file = $meeting_event->file;

		$meeting_event->update($request->except('file' , 'attendants') + ['file'=>$file , 'attendants'=>json_encode($request->attendants)]);

		//send emails to attenders
		\Mail::send('emails.admin.meetings.meetingEvents', array('data'=> $request->except("attendants" , "file") , "meeting"=>$meeting), function($message) use($request , $meeting)
		{
			$attendants = Employee::whereIn('id' , json_decode($meeting->employee_id))->get();
			foreach($attendants as $attendant)
			{
				$message->to($attendant->email)->subject("احداث الاجتماع ".$meeting->address);
			}
		});

		return Redirect::back()->with('global_s' , 'لقد تم تعديل احداث الاجتماع بنجاح');
	}

	public function getAbsences($id)
	{
		$meeting_event 		= Meeting_event::find($id);
		$meeting       		= $meeting_event->meeting->employee_id;
		$arr_diff   	    = array_diff(json_decode($meeting) , json_decode($meeting_event->attendants));

		$data['absences']   = Employee::whereIn('id' , $arr_diff)->get();
		$data['i']          = 0;
		$data['event_id']   = $id;
		return view('admin.meetings.events.absences' , $data);
	}

	public function storeAbsenceReason($event_id , $employee_id)
	{
		$reason = \Request::get('reason');
		if($reason == null)
			return Redirect::back()->with('global_r' , 'من فضلك اكتب سبب عدم الحضور')->withInput();

		$checkReason = Meeting_Reason::where('meeting_event_id' , $event_id)->where('employee_id' , $employee_id);
		

		if($checkReason->count() == 0)
			Meeting_Reason::create([
				'meeting_event_id' => $event_id,
				'employee_id'      => $employee_id,
				'reason'           => $reason
				]);
		else
			$checkReason->update([
				'reason'           => $reason
				]);

		return Redirect::back()->with('global_s' , 'لقد تم اضافة السبب بنجاح')->withInput();
	}

}
