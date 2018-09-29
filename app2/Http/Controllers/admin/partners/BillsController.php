<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use App\PartnerBankData;
use App\Client;
use App\Notification;
use App\PartnerPayTransfer;
use App\Http\Requests;
use App\Http\Requests\PartnerRequest;
use App\Http\Requests\PayTransferRequest;
use Redirect;
use File;

class BillsController extends Controller
{

	public function index()
	{
		$bills = PartnerPayTransfer::all();
		return view('admin.partners.bills.index' , ['bills'=>$bills , 'i'=>0]);
	}

	
	public function create()
	{
		$partners = Partner::lists('name' , 'id');
		return view('admin.partners.bills.create' , ['partners'=>$partners]);
	}

	public function store(PayTransferRequest $request , Client $upload)
	{
		if($request->bill_photo != null)
			$bill_photo = $upload->uploadFile($request->bill_photo);
		else
			$bill_photo = "/noimage.gif";

		PartnerPayTransfer::create($request->except('bill_photo') + ['bill_photo'=>$bill_photo]);

		return Redirect::back()->with('global_s' , 'لقد تم اضافة الفاتورة بنجاح');
	}

	public function show($id)
	{
		$bill = PartnerPayTransfer::find($id);
		return view('admin.partners.bills.show' , ['bill'=>$bill]);
	}

	public function edit($id)
	{
		$bill = PartnerPayTransfer::find($id);
		$partners = Partner::lists('name' , 'id');
		return view('admin.partners.bills.edit' , ['bill'=>$bill , 'partners'=>$partners]);
	}

	public function update(PayTransferRequest $request , Client $upload , $id)
	{
		$bill = PartnerPayTransfer::find($id);

		if($request->bill_photo != null)
		{
			if($bill->bill_photo != "/noimage.gif")
				File::delete(public_path().$bill->bill_photo);
			$bill_photo = $upload->uploadFile($request->bill_photo);
		}
		else
			$bill_photo = $bill->bill_photo;

		$bill->update($request->except('bill_photo') + ['bill_photo'=>$bill_photo]);
		return Redirect::back()->with('global_s' , 'لقد تم تعديل الفاتورة بنجاح');
	}

	public function destroy($id)
	{
		$bill = PartnerPayTransfer::find($id);
		$internal_notifications = $bill->billsNotifications->where('type' , 'partner_bill');

         //delete bill notifications
		if($internal_notifications != null)
		{
			foreach ($internal_notifications as $notification) {
				$notification->delete();
			}
		}

		if($bill->bill_photo != "/noimage.gif")
			File::delete(public_path().$bill->bill_photo);
		$bill->delete();
		return Redirect::back()->with('global_s' , 'لقد تم حذف الفاتورة بنجاح');
	}

	public function changeNotificationsSeen()
	{
		Notification::where('seen' , 0)->update(['seen'=>1]);
	}

	public function getNotifications(Notification $notify)
	{
		 //make cron runs every 24h
		// if(billsNotifications::where('bill_id' , $bill->id)->first() == null)
		foreach (PartnerPayTransfer::all() as $bill)
		{
			$date1 = new \DateTime(Date('Ymd'));
			$date2 = new \DateTime($bill->pay_to_date);
			$interval = $date1->diff($date2);

			if($interval->format('%r') != '-')
			{
				if($interval->format('%d') <= 5)
				{
					$message =  ($interval->format('%d') == 0)?"اليوم" : "باقى ".$interval->format('%d يوم');

					$notify->createNotification($bill->id , "partner_bill" , $message );
				}
			}
		}
	}

}
