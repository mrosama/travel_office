<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Client_order;

class TransferController extends Controller
{

	public function doRequest($city_id , $type)
	{
		$result       = DB::table('trs_api_city')->where('id', $city_id)->first();
		$region_name  = $result->region_name;
		$country_name = $result->country_name;
		$city_name    = $result->city_name;
		$show_photos  = [];

		$url = 'http://api.metglobaldmc.com/?store_key=120615TEST&service_type='.$type.'&d1='.$region_name.'&d2='.$country_name.'&d3='.$city_name;
		
		$sxml = simplexml_load_file($url);

		foreach ($sxml->daily_tours as $row) 
			array_push($show_photos , (string)$row->show_photos);


		$doc = new \DOMDocument();
		$doc->load($url);

		if($type == "TRS")#Transfer Api
		return $this->TransferFun($doc);
		
	}

	public function TransferFun($doc)
	{
		$last_arr 			 = [];
		$record_id 		     = $this->getArray($doc->getElementsByTagName("record_id"));
		$region    		     = $this->getArray($doc->getElementsByTagName("region"));
		$country  		     = $this->getArray($doc->getElementsByTagName("country"));
		$city      		     = $this->getArray($doc->getElementsByTagName("city"));
		$city_code           = $this->getArray($doc->getElementsByTagName("city_code"));
		$a_point     		 = $this->getArray($doc->getElementsByTagName("a_point"));
		$b_point     		 = $this->getArray($doc->getElementsByTagName("b_point"));
		$transfer_name       = $this->getArray($doc->getElementsByTagName("transfer_name"));
		$transfer_detail     = $this->getArray($doc->getElementsByTagName("transfer_detail"));
		$vehicle    	     = $this->getArray($doc->getElementsByTagName("vehicle"));
		$tax                 = $this->getArray($doc->getElementsByTagName("tax"));
		$conditions          = $this->getArray($doc->getElementsByTagName("conditions"));
		$notes               = $this->getArray($doc->getElementsByTagName("notes"));
		$language            = $this->getArray($doc->getElementsByTagName("language"));
		$release             = $this->getArray($doc->getElementsByTagName("release"));
		$cxl_policy          = $this->getArray($doc->getElementsByTagName("cxl_policy"));
		$cancel_policy       = $this->getArray($doc->getElementsByTagName("cancel_policy"));
		$pickup_note         = $this->getArray($doc->getElementsByTagName("pickup_note"));
		$show_price          = $this->getArray($doc->getElementsByTagName("show_price"));
		$currency            = $this->getArray($doc->getElementsByTagName("currency"));
		$show_photos         = $this->getArray($doc->getElementsByTagName("show_photos"));

		for($i = 0 ; $i < count($record_id) ; $i++) 
		{
			$periods = $this->getTransferPeriods($record_id[$i]);
			$new_arr = [
			'record_id'        =>  $record_id[$i] ,
			'region'           =>  $region[$i] ,
			'country'          =>  $country[$i] , 
			'city'             =>  $city[$i] ,
			'city_code'        =>  $city_code[$i],
			'a_point'          =>  $a_point[$i] ,
			'b_point'          =>  $b_point[$i] ,
			'transfer_name'    =>  $transfer_name[$i] ,
			'transfer_detail'  =>  $transfer_detail[$i] ,
			'vehicle'          =>  $vehicle[$i] ,
			'tax'              =>  $tax[$i] ,
			'conditions'       =>  $conditions[$i] ,
			'notes'            =>  $notes[$i] ,
			'language'         =>  $language[$i] ,
			'release'          =>  $release[$i] ,
			'cxl_policy'       =>  $cxl_policy[$i] ,
			'cancel_policy'    =>  $cancel_policy[$i] ,
			'pickup_note'	   =>  $pickup_note[$i] ,
			'show_price' 	   =>  $show_price[$i] ,
			'currency' 		   =>  $currency[$i] ,
			'show_photos' 	   =>  $show_photos[$i] ,
			'periods' 	       =>  $periods ,
			];
			array_push($last_arr , $new_arr);
		}
		return $last_arr;
	}

	public function getArray($results)
	{
		$arr = [];
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
					array_push($arr , $child->textContent);
				else
					array_push($arr , $child->wholeText);
			}
		}
		return $arr;
	}

	
	function getTransferPeriods($record_id)
	{
		$url = 'http://api.metglobaldmc.com/v2/periods/?store_key=120615TEST&service_type=TRS&tour_id='.$record_id;

		$arr = [];
		$periods = simplexml_load_file($url);
		$i = 0;
		foreach ($periods as $period) 
		{
			$arr[$i]["tour_id"]        =(string)$period->tour_id;
			$arr[$i]["period_id"]      =(string)$period->period_id;
			$arr[$i]["transfer_basis"] =(string)$period->transfer_basis;
			$arr[$i]["tariff"]         =(string)$period->tariff;
			$arr[$i]["tariff_clock"]   =(string)$period->tariff_clock;
			$arr[$i]["depar_type"]     =(string)$period->depar_type;
			$arr[$i]["start_period"]   =(string)$period->start_period;
			$arr[$i]["end_period"]     =(string)$period->end_period;
			$arr[$i]["adult_price"]    =(string)$period->adult_price;
			$arr[$i]["children_price"] =(string)$period->children_price;
			$arr[$i]["infant_price"]   =(string)$period->infant_price;
			$arr[$i]["vehicle_price"]  =(string)$period->vehicle_price;
			$arr[$i]["currency"]       =(string)$period->currency;
			$i++;
		}
		return $arr;
	}


	public function finalProcess()
	{
		$data      = \Request::all();
		$url = "http://api.metglobaldmc.com/booking/";

		$response = \Laracurl::post($url, $data);
		// echo $response->code;

		if(strpos($response->body , "TAKIP NO"))
			echo 1;	
		if(strpos($response->body , "Error"))
			return [-1 , "<div class='alert alert-danger'>".strstr($response->body , "Error")."</div>"];

		// echo $response->body;
	}

	public function booking($order_id)
	{
		$data      = \Request::all();
		// dd($data);
		$order  =  Client_order::find($order_id);
		return view('admin.clients_orders.executing.transfer.book' , $data + ['order'=>$order]);
	}

	public function getTransferDetails($order_id)
	{
		// dd(\Request::all());
		$data      = \Request::all();
		$order_id  =  $order_id;
		return view('admin.clients_orders.executing.transfer.details' , $data + ['order_id'=>$order_id]);
	}

	public function transfer($order_id)
	{
		$city_id 		  =  $_GET['city_id'];
		$data['arr']      =  json_encode($this->doRequest($city_id , "TRS"));
		$order_id 		  =  $order_id;
		return view('admin.clients_orders.executing.transfer.search' , $data + ['order_id'=>$order_id]);
	}


}