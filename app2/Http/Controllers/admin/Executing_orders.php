<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client_order;
use App\Http\Models\Country;
use DB;

class Executing_orders extends Controller
{
	public function create($id)
	{
		$data['order'] = Client_order::find($id);
		$i         = 0;
		$data['j'] = 0;
		if($data['order']->id_wife != 0)
			$i++;
		if($data['order']->id_child != null)
			$data['i'] = $i+count(json_decode($data['order']->id_child));

		$data['countries']   = Country::lists('name' , 'code');
		$data['Hotelcities'] = DB::table('ApiCities')->lists('CityName' , 'CityCode');
		$data['trs_api_city'] = DB::table('trs_api_city')->lists('city_name' , 'id');

		return view('admin.clients_orders.executing.create' , $data);
	}




	public function getTouristApi()
	{


		$city_id =  $_GET['city_id'];
		$result = DB::table('trs_api_city')->where('id', $city_id)->first();
		$region_name = $result->region_name;
		$country_name = $result->country_name;
		$city_name = $result->city_name;

		$url = 'http://api.metglobaldmc.com/?store_key=120615TEST&service_type=DTR&d1='.$region_name.'&d2='.$country_name.'&d3='.$city_name;
		
		$sxml = simplexml_load_file($url);

		$show_photos = array();
		foreach ($sxml->daily_tours as $row) 
		{
			array_push($show_photos , (string)$row->show_photos);
		}


		$doc = new \DOMDocument();
		$doc->load($url);
		// get all record id
		$record_id = array();
		$results = $doc->getElementsByTagName("record_id");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$record_id[] = $child->textContent;
				}
			}
		}
		// get all region
		$region = array();
		$results = $doc->getElementsByTagName("region");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$region[] = $child->textContent;
				}
			}
		} 
		// get all country
		$country = array();
		$results = $doc->getElementsByTagName("country");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$country[] = $child->textContent;
				}
			}
		} 

		// get all city
		$city = array();
		$results = $doc->getElementsByTagName("city");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$city[] = $child->textContent;
				}
			}
		} 

		// get all city_code
		$city_code = array();
		$results = $doc->getElementsByTagName("city_code");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$city_code[] = $child->textContent;
				}
			}
		} 

		// get all departure point
		$departure_point = array();
		$results = $doc->getElementsByTagName("departure_point");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$departure_point[] = $child->textContent;
				}
			}
		} 

		// get all ending_point
		$ending_point = array();
		$results = $doc->getElementsByTagName("ending_point");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$ending_point[] = $child->textContent;
				}
			}
		} 

		// get all product name
		$product_name = array();
		$results = $doc->getElementsByTagName("product_name");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$product_name[] = $child->textContent;
				}
			}
		} 

		// get all highlight
		$highlight = array();
		$results = $doc->getElementsByTagName("highlight");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$highlight[] = $child->textContent;
				}
			}
		} 

		// get all included
		$included = array();
		$results = $doc->getElementsByTagName("included");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$included[] = $child->textContent;
				}
			}
		} 

		// get all excluded
		$excluded = array();
		$results = $doc->getElementsByTagName("excluded");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$excluded[] = $child->textContent;
				}
			}
		} 

		// get all tax
		$tax = array();
		$results = $doc->getElementsByTagName("tax");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$tax[] = $child->textContent;
				}
			}
		} 

		// get all conditions
		$conditions = array();
		$results = $doc->getElementsByTagName("conditions");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$conditions[] = $child->textContent;
				}
			}
		} 

		// get all notes
		$notes = array();
		$results = $doc->getElementsByTagName("notes");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$notes[] = $child->textContent;
				}
			}
		} 

		// get all language
		$language = array();
		$results = $doc->getElementsByTagName("language");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$language[] = $child->textContent;
				}
			}
		} 

		// get all pickup
		$pickup = array();
		$results = $doc->getElementsByTagName("pickup");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$pickup[] = $child->textContent;
				}
			}
		} 

		// get all pickup_type
		$pickup_type = array();
		$results = $doc->getElementsByTagName("pickup_type");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$pickup_type[] = $child->textContent;
				}
			}
		} 

		// get all pickup_time
		$pickup_time = array();
		$results = $doc->getElementsByTagName("pickup_time");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$pickup_time[] = $child->textContent;
				}
			}
		} 

		// get all pickup_note
		$pickup_note = array();
		$results = $doc->getElementsByTagName("pickup_note");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$pickup_note[] = $child->textContent;
				}
			}
		} 


		// get all duration
		$duration = array();
		$results = $doc->getElementsByTagName("duration");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$duration[] = $child->textContent;
				}
			}
		} 

		// get all duration type
		$duration_type = array();
		$results = $doc->getElementsByTagName("duration_type");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$duration_type[] = $child->textContent;
				}
			}
		} 


		// get all release
		$release = array();
		$results = $doc->getElementsByTagName("release");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$release[] = $child->textContent;
				}
			}
		} 

		// get all minimum_pax
		$minimum_pax = array();
		$results = $doc->getElementsByTagName("minimum_pax");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$minimum_pax[] = $child->textContent;
				}
			}
		} 

		// get all maximum_pax
		$maximum_pax = array();
		$results = $doc->getElementsByTagName("maximum_pax");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$maximum_pax[] = $child->textContent;
				}
			}
		} 

		// get all cxl_policy
		$cxl_policy = array();
		$results = $doc->getElementsByTagName("cxl_policy");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$cxl_policy[] = $child->textContent;
				}
			}
		} 

		// get all guides_type
		$guides_type = array();
		$results = $doc->getElementsByTagName("guides_type");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$guides_type[] = $child->textContent;
				}
			}
		} 

		// get all guides_language
		$guides_language = array();
		$results = $doc->getElementsByTagName("guides_language");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$guides_language[] = $child->textContent;
				}
			}
		} 

		// get all cancellation_policy
		$cancellation_policy = array();
		$results = $doc->getElementsByTagName("cancellation_policy");
		foreach ($results as $result) 
		{
			foreach($result->childNodes as $child) 
			{
				if ($child->nodeType == XML_CDATA_SECTION_NODE) 
				{
					$cancellation_policy[] = $child->textContent;
				}
			}
		} 



		$all = Array();
		for($i = 0 ; $i < count($record_id)  ; $i++) 
		{
			$new_arr = ['record_id' => $record_id[$i] , 'region' => $region[$i] ,'country' => $country[$i] , 
			'city' => $city[$i] , 'city_code' =>  $city_code[$i], 'departure_point' => $departure_point[$i],
			'product_name' =>$product_name[$i] , 'highlight' => $highlight[$i] , 'included' => $included[$i] ,
			'excluded' => $excluded[$i] , 'tax' => $tax[$i] , 'conditions' => $conditions[$i],'notes' => $notes[$i] ,
			'language' => $language[$i] , 'pickup' => $pickup[$i] , 'pickup_type' => $pickup_type[$i],
			'pickup_time' => $pickup_time[$i], 'pickup_note' => $pickup_note[$i], 'duration' =>$duration[$i] ,
			'duration_type' => $duration_type[$i] , 'relase' => $release[$i] , 'minimum_pax' => $minimum_pax[$i],
			'maximum_pax' => $maximum_pax[$i], 'cxl_policy' =>$cxl_policy[$i], 'guides_type' => $guides_type[$i] ,
			'guides_language' => $guides_language[$i], 'cancellation_policy' => $cancellation_policy[$i] ,
			'show_photos' => $show_photos[$i]];
			array_push($all , $new_arr);
		}
		return json_encode($all);


	}




}
