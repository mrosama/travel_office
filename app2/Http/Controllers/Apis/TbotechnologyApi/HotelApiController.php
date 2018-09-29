<?php 

namespace App\Http\Controllers;
use SoapClient;
use Session;
use App\Client_order;
use App\Client;

class HotelApiController extends Controller
{

	public function doRequest($body , $action)
	{
		$request ='<?xml version="1.0" encoding="UTF-8"?><soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:hot="http://TekTravel/HotelBookingApi"><soap:Header xmlns:wsa="http://www.w3.org/2005/08/addressing"><hot:Credentials UserName="noor" Password="noor@123"/><wsa:Action>http://TekTravel/HotelBookingApi/'.$action.'</wsa:Action><wsa:To>http://api.tbotechnology.in/hotelapi_v7/hotelservice.svc</wsa:To></soap:Header><soap:Body>'.$body.'</soap:Body></soap:Envelope>
		';

		$location = "http://api.tbotechnology.in/hotelapi_v7/hotelservice.svc";
		$action   = "http://TekTravel/HotelBookingApi/{$action}";
		$client   = new SoapClient("http://api.tbotechnology.in/hotelapi_v7/hotelservice.svc?wsdl");

		// dd($client->__getFunctions());
	   // dd($client->__getTypes());

		$resp = $client->__doRequest($request , $location , $action , 2 );
		$xml  = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $resp);
		return simplexml_load_string($xml);
	}

	public function CountryList()
	{
		$action  = "CountryList";
		$body    = "<hot:CountryListRequest/>";

		$resp    = $this->doRequest($body , $action);
		dd($resp);
		$xml     = $resp->$resp->xpath('//sBody')[0]->CountryListResponse->CountryList;
		$responseArray = json_encode($xml);
		return $responseArray;
	}

	public function DestinationCityList($CountryCode = "")
	{
		$action  = "DestinationCityList";
		$body    = "<hot:DestinationCityListRequest><hot:CountryCode>{$CountryCode}</hot:CountryCode></hot:DestinationCityListRequest>";

		$resp    = $this->doRequest($body , $action);
		$xml     = $resp->$resp->xpath('//sBody')[0]->DestinationCityListResponse->CityList;

		$responseArray = json_encode($xml);
		$arr 		   = [];
		foreach (json_decode($responseArray) as $city) {
			foreach ($city as $value) {
				array_push($arr , $value->{"@attributes"});
			}
		}

		return $arr;
	}

	public function TopDestinations()
	{
		$action  = "TopDestinations";
		$body    = "<hot:TopDestinationsRequest/>";

		$resp    = $this->doRequest($body , $action);
		// dd($resp);
		$xml     = $resp->$resp->xpath('//sBody')[0]->TopDestinationsResponse->CityList;
		$responseArray = json_encode($xml);
		// foreach (json_decode($responseArray , TRUE) as $value) {

		// 	foreach ($value as $soso)
		// 	{
		// 		// dd($soso['@attributes']['CityCode']);
		// 		\DB::table('ApiCities')->insert(['CityCode'=>$soso['@attributes']['CityCode'] , 'CityName'=>$soso['@attributes']['CityName'] , 'CountryCode'=>$soso['@attributes']['CountryCode']]);
		// 	}
		// }
		return $responseArray;
	}

	public function HotelSearch()
	{
		$request = \Request::all();
		$data    = [];

		if(isset($request['ages']))
			$data['ages'] = $request['ages'];
		else
			$data['ages'] = [];

		$data['hotelName']    = $request['hotelName'];
		$data['checkInDate']  = $request['checkInDate'];
		$data['checkOutDate'] = $request['checkOutDate'];
		$data['country']      = $request['country'];
		$data['cityId']       = $request['cityId'];
		$data['cityName']     = $request['cityName'];
		$data['nationality']  = $request['nationality'];
		$data['stars'] 	      = $request['stars'];	
		$data['roomsCount']   = $request['roomsCount'];
		$data['rooms']   	  = $request['rooms'];
		$data['nights']       = $request['nights'];
		$data['order_id']     = $request['order_id'];

		$adults    = [];
		$children  = [];
		$RoomGuest = "";

		//get adults and children count in each room
		foreach(array_chunk($data['rooms'], 2) as $singleRoom)
		{
			array_push($adults   , $singleRoom[0]);
			array_push($children , $singleRoom[1]);
		}

		for ($i=0; $i < $data['roomsCount'] ; $i++)
		{
			$RoomGuest .= '<hot:RoomGuest AdultCount="'.$adults[$i].'" ChildCount="'.$children[$i].'">';
			if($children[$i] != "")
			{
				$RoomGuest .= '<hot:ChildAge>';
				for ($j=0; $j < $children[$i] ; $j++)
				{
					$RoomGuest .= '<hot:int>'.$data['ages'][$j].'</hot:int>';
					unset($data['ages'][$j]);
				}
				$data['ages'] = array_values($data['ages']);
				$RoomGuest .= '</hot:ChildAge>';
			}
			$RoomGuest .= '</hot:RoomGuest>';
		}

		$data['ChildrenCount'] = array_sum($children);
		$data['adultCount']    = array_sum($adults);
		$action  = "HotelSearch";
		$body    = '<hot:HotelSearchRequest><hot:CheckInDate>'.$data['checkInDate'].'</hot:CheckInDate><hot:CheckOutDate>'.$data['checkOutDate'].'</hot:CheckOutDate><hot:HotelName>'.$data['hotelName'].'</hot:HotelName><hot:CountryName>'.$data['country'].'</hot:CountryName><hot:CityName>'.$data['cityName'].'</hot:CityName><hot:CityId>'.$data['cityId'].'</hot:CityId><hot:IsNearBySearchAllowed>false</hot:IsNearBySearchAllowed><hot:NoOfRooms>'.$data['roomsCount'].'</hot:NoOfRooms><hot:GuestNationality>IN</hot:GuestNationality><hot:RoomGuests>'.$RoomGuest.'</hot:RoomGuests><hot:ResultCount>0</hot:ResultCount><hot:Filters><hot:StarRating>'.$data['stars'].'</hot:StarRating><hot:OrderBy>PriceAsc</hot:OrderBy></hot:Filters></hot:HotelSearchRequest>';
		// dd($body);
		$resp      = $this->doRequest($body , $action);
		// dd($resp);
		$xml       = $resp->$resp->xpath('//sBody')[0]->HotelSearchResponse->HotelResultList;

		$RoomGuest = $resp->$resp->xpath('//sBody')[0]->HotelSearchResponse->RoomGuests;
		$RoomGuest = json_encode($RoomGuest);
		Session::forget('RoomGuest');
		Session::push('RoomGuest' , $RoomGuest);

		$data['SessionId'] = $resp->$resp->xpath('//sBody')[0]->HotelSearchResponse->SessionId;
		$data['status']    = $resp->$resp->xpath('//sBody')[0]->HotelSearchResponse->Status;
		$data['sFault']    = $resp->$resp->xpath('//sBody')[0]->sFault->sReason;
		$data['responseArray'] = json_encode($xml);
		return view('admin.clients_orders.executing.hotel.search' , $data);
	}

	public function HotelDetails()
	{
		$request  = \Request::all();
		$data     = [];
		$data['SessionId']   = $request['SessionId'];
		$data['ResultIndex'] = $request['ResultIndex'];
		$data['HotelCode']   = $request['HotelCode'];

		$action  = "HotelDetails";
		$body    = '<hot:HotelDetailsRequest><hot:ResultIndex>'.$data['ResultIndex'].'</hot:ResultIndex><hot:SessionId>'.$data['SessionId'].'</hot:SessionId><hot:HotelCode>'.$data['HotelCode'].'</hot:HotelCode></hot:HotelDetailsRequest>';

		$resp    = $this->doRequest($body , $action);
		// dd($resp);
		$xml     = $resp->$resp->xpath('//sBody')[0]->HotelDetailsResponse->HotelDetails;
		$data['responseArray'] = json_encode($xml);

		return view('admin.clients_orders.executing.hotel.details' , $data);
	}

	public function AvailableHotelRooms($SessionId , $HotelCode)
	{
		$request  = \Request::all();
		$data     = [];
		$data['SessionId']   = $SessionId;
		$data['ResultIndex'] = $request['ResultIndex'];
		$data['HotelCode']   = $HotelCode;

		$action  = "AvailableHotelRooms";
		$body    = '<hot:HotelRoomAvailabilityRequest><hot:SessionId>'.$data['SessionId'].'</hot:SessionId><hot:ResultIndex>'.$data['ResultIndex'].'</hot:ResultIndex><hot:HotelCode>'.$data['HotelCode'].'</hot:HotelCode></hot:HotelRoomAvailabilityRequest>';

		$resp    = $this->doRequest($body , $action);
		// dd($resp);
		$xml     = $resp->$resp->xpath('//sBody')[0]->HotelRoomAvailabilityResponse->HotelRooms;
		$data['responseArray'] = json_encode($xml);

		return view('admin.clients_orders.executing.hotel.rooms' , $data);
	}

	public function HotelCancellationPolicies($SessionId)
	{
		$request  = \Request::all();
		$data     = [];
		$data['SessionId']   = $SessionId;
		$data['ResultIndex'] = $request['ResultIndex'];

		$action  = "HotelCancellationPolicy";
		$body    = '<hot:HotelCancellationPolicyRequest><hot:ResultIndex>'.$request['ResultIndex'].'</hot:ResultIndex><hot:SessionId>'.$data['SessionId'].'</hot:SessionId><hot:OptionsForBooking><hot:FixedFormat>true</hot:FixedFormat><hot:RoomCombination><hot:RoomIndex>1</hot:RoomIndex></hot:RoomCombination></hot:OptionsForBooking></hot:HotelCancellationPolicyRequest>';

		$resp    = $this->doRequest($body , $action);
		// dd($resp);

		$xml     = $resp->$resp->xpath('//sBody')[0]->HotelCancellationPolicyResponse->CancelPolicies;
		$data['responseArray'] = json_encode($xml);

		return view('admin.clients_orders.executing.hotel.cancellationPolicies' , $data);
	}	

	public function RoomsToBook($order_id , $SessionId , $HotelCode)
	{
		$request  = \Request::all();
		$data     = [];
		$data['SessionId']   = $SessionId;
		$data['HotelCode']   = $HotelCode;
		$data['ResultIndex'] = $request['ResultIndex'];
		$data['RoomsCount']  = $request['RoomsCount'];
		$data['order_id']    = $order_id;

		$action  = "AvailableHotelRooms";
		$body    = '<hot:HotelRoomAvailabilityRequest><hot:SessionId>'.$data['SessionId'].'</hot:SessionId><hot:ResultIndex>'.$data['ResultIndex'].'</hot:ResultIndex><hot:HotelCode>'.$data['HotelCode'].'</hot:HotelCode></hot:HotelRoomAvailabilityRequest>';

		$resp    = $this->doRequest($body , $action);
		// dd($resp);
		$xml     = $resp->$resp->xpath('//sBody')[0]->HotelRoomAvailabilityResponse;
		$data['responseArray'] = json_encode($xml);

		return view('admin.clients_orders.executing.hotel.roomsToBook' , $data);
	}

	public function AvailabilityAndPricing($data)
	{
		$action  = "AvailabilityAndPricing";
		$body    = '<hot:AvailabilityAndPricingRequest><hot:ResultIndex>'.$data['ResultIndex'].'</hot:ResultIndex><hot:HotelCode></hot:HotelCode><hot:SessionId>'.$data['SessionId'].'</hot:SessionId><hot:OptionsForBooking><hot:FixedFormat>false</hot:FixedFormat><hot:RoomCombination>';
		foreach ($data['rooms'] as $room)
			$body   .= '<hot:RoomIndex>'.$room.'</hot:RoomIndex>';

		$body   .= '</hot:RoomCombination></hot:OptionsForBooking></hot:AvailabilityAndPricingRequest>';

		$resp    = $this->doRequest($body , $action);
		return     $resp;
	}

	public function HotelBook($order_id , $SessionId)
	{
		$request  			 = \Request::all();
		$data     			 = [];
		$data['i']           = 0;
		$data['rooms']       = $request['rooms'];
		$data['SessionId']   = $SessionId;
		$data['order_id']    = $order_id;
		$data['ResultIndex'] = $request['ResultIndex'];
		$data['adults']	     = [];
		$data['children']    = [];
		// $resp = $this->AvailabilityAndPricing($data);
		if(Session::get('RoomGuest')[0] == "{}")
			dd('empty array');

		if(property_exists(json_decode(Session::get('RoomGuest')[0]) , "RoomGuest"))
			$data['RoomGuest'] = json_decode(Session::get('RoomGuest')[0])->RoomGuest;
		else
			$data['RoomGuest'] = json_decode(Session::get('RoomGuest')[0])->{"0"};

		//get family
		$data['order'] = Client_order::find($order_id);
		$data['adults'][$data['order']->get_client_name->id] = $data['order']->get_client_name->username;
		if($data['order']->id_wife != 0)
		{
			$data['adults'][$data['order']->get_wife_name->client->id] = $data['order']->get_wife_name->client->username;
		}

		if($data['order']->id_child != "null")
		{
			foreach(json_decode($data['order']->id_child) as $id)
			{
				$from = new \DateTime(Client::find($id)->birth_date);
				$to   = new \DateTime('today');

				$data['children'][$id] = Client::find($id)->username." - ".$from->diff($to)->y." سنة";
			}

		}
		return view('admin.clients_orders.executing.hotel.book' , $data);

	}
}
