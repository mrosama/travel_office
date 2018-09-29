<?php

/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
 

/*
Route::get('error', function () {
    return view('error_404');
});

Route::get('admin/login', function() {
    return view('admin.login');
});*/

Route::group(['middleware' => ['web']], function () {

Route::get('admin', function () {

  if (Auth::check()) {
         return view('admin.home');

  } else {
      return redirect('/');
    
  }

});

Route::get('admin/logout', function () {
Auth::logout();
return redirect('/');

});




 Route::get('/','admin\loginAdminController@index'); 

Route::post('admin/processlogin','admin\loginAdminController@processlogin');

});
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */
// get all ajax Data
Route::get('partner/get_employee', 'DataAjaxController@get_partner_employee');
Route::get('instructions/get_type', 'DataAjaxController@get_instruction_type');
Route::get('getAjax/getTravelOffice', 'DataAjaxController@getTravelOffice');
Route::get('getSupplier', 'DataAjaxController@getSupplier');
Route::get('getBusses', 'DataAjaxController@getBusses');
// end ajax Data
Route::get('clients/getClientsAjax', 'ClientsController@getAjax');
Route::get('clients/getClientInfo', 'ClientsController@getClientInfo');
Route::get('clients/getClientFamily', 'ClientsController@getClientFamily');
Route::get('clients/getClientWife', 'ClientsController@getClientWife');
Route::get('clients/getClientChild', 'ClientsController@getClientChild');
Route::post('clients/updateClientsAjax/{id}', 'ClientsController@updateAjax');
Route::post('clients/getClientsAjax', 'ClientsController@getAjax');
Route::get('clients/getCode', 'ClientsController@getCode');
Route::get('transport_type/getTransportType', 'TransportTypeController@getTransportType');
Route::get('transport_type/getDuration', 'TransportTypeController@getDuration');
Route::get('companyEmployee/getCompanySection', 'CompanyEmployeeController@getCompanySection');
Route::get('companyEmployee/getEmployeesBySectionId', 'CompanyEmployeeController@getEmployeesBySectionId');
Route::get('companyOrder/getEmpName', 'CompanyOrderController@getEmpName');
Route::get('company/getSections', 'CompanyController@getSections');
Route::get('exchangeType/getDuration', 'exchangeTypeController@getDuration');
Route::get('executing/orders/getTouristApi', 'Executing_orders@getTouristApi');
Route::get('Travel_employees/getTravelSection', 'Travel_employeesController@getTravelSection');
Route::get('Travel_employees/getEmployeesBySectionId', 'Travel_employeesController@getEmployeesBySectionId');
Route::get('travel_orders/getEmpName', 'Travel_ordersController@getEmpName');

//ajax routes
Route::get('city/getCity', 'CityController@getCity');
Route::get('getBusesAndDrivers', 'TouristProgrammesController@getBusesAndDrivers');
Route::get('getBusInformation', 'FlightReservationController@getBusInformation');
Route::get('getDriverInformation', 'FlightReservationController@getDriverInformation');
Route::get('getEmployeeInformation', 'IncomeController@getEmployeeInformation');
Route::get('getTouristProgramIformation', 'FlightReservationController@getTouristProgramIformation');
Route::get('checkIfSeatIsReserved', 'FlightReservationController@checkIfSeatIsReserved');
Route::get('checkIfSeatIsReservedAndGetClientSeats', 'FlightReservationController@checkIfSeatIsReservedAndGetClientSeats');
Route::get('getTouristProgramIBus', 'FlightReservationController@getTouristProgramIBus');
Route::get('getEmployees', 'MeetingsController@getEmployees');

//change notifications to seen
Route::get("changeNotificationsSeen", "BillsController@changeNotificationsSeen");
//cron to get notifications
Route::get("getNotifications", "BillsController@getNotifications");
//change message to seen
Route::get("changeMessagesSeen", "AdvertisementsController@changeMessagesSeen");

//end of ajax routes

Route::group(['middleware' => ['web','CheckAdmin'], 'prefix' => 'admin'], function () {




    Route::resource('admins', 'AdminsController');


    // ============ Warehouse Template ==============
    Route::resource('warehouse_template', 'WarehouseTepmlateController');

    // ============ Supervisors ==============
    Route::resource('supervisors', 'SupervisorsController');

    // ============ Client ==============
    Route::resource('clients', 'ClientsController');
    Route::get('clients/create/first', 'ClientsController@createFirst');
    Route::post('clients/check/first', 'ClientsController@checkFirst');
    Route::get('clients/create/second', 'ClientsController@createSecond');
    Route::post('clients/check/second', 'ClientsController@checkSecond');
    Route::get('clients/create/last', 'ClientsController@createLast');
    Route::get('clients/confirm/last', 'ClientsController@confirmLast');
    Route::get('clients/send_email/{id}', ['uses' => 'ClientsController@send_email', 'as' => 'admin.clients.send_email']);
    Route::post('clients/do_send_email', ['uses' => 'ClientsController@doSendEmail', 'as' => 'admin.client.do_send_email']);
    Route::get('clients/send_sms/{id}', ['uses' => 'ClientsController@send_sms', 'as' => 'admin.clients.send_sms']);
    Route::post('clients/do_send_sms', ['uses' => 'ClientsController@doSendSms', 'as' => 'admin.client.do_send_sms']);
    // Send Group Email
    Route::get('clients/get/group_email', ['uses' => 'ClientsController@get_group_email', 'as' => 'admin.clients.get_group_email']);
    Route::get('clients/send/group_email', ['uses' => 'ClientsController@send_group_email', 'as' => 'admin.clients.send_group_email']);
    Route::post('clients/do_send_group_email', ['uses' => 'ClientsController@do_send_group_email', 'as' => 'admin.clients.do_send_group_email']);
    Route::get('partners/get/notifications', 'PartnersController@getNotifications');
    #Send Group SMS
    Route::get('clients/get/group_sms', ['uses' => 'ClientsController@get_group_sms', 'as' => 'admin.clients.get_group_sms']);
    Route::get('clients/send/group_sms', ['uses' => 'ClientsController@send_group_sms', 'as' => 'admin.clients.send_group_sms']);
    Route::post('clients/do_send_group_sms', ['uses' => 'ClientsController@do_send_group_sms', 'as' => 'admin.clients.do_send_group_sms']);
    Route::get('clients/edit/first/{id}', 'ClientsController@editFirst');
    Route::get('clients/delete/clientNumber/{id}', 'ClientsController@deleteClientNumber');
    Route::get('clients/delete/clientُEmail/{id}', 'ClientsController@deleteClientEmail');
    Route::post('clients/update/first/{id}', 'ClientsController@updateFirst');
    Route::get('clients/edit/second/{id}', 'ClientsController@editSecond');
    Route::post('clients/update/second/{id}', 'ClientsController@updateSecond');
    Route::get('clients/show/families', 'ClientsController@familiesIndex');
    Route::get('clients/show/families/{id}', 'ClientsController@familiesShow');
    Route::get('clients/family/{id}', ['uses' => 'ClientsController@family', 'as' => 'admin.clients.family']);
    Route::post('clients/addWife', 'ClientsController@addWife');
    Route::put('clients/updateWife/{id}', ['uses' => 'ClientsController@updateWife', 'as' => 'admin.clients.updateWife']);
    Route::post('clients/addChild', 'ClientsController@addChild');
    Route::post('clients/updateChild', 'ClientsController@updateChild');
    Route::resource('clients_orders', 'Clients_ordersController');
    // End client
    // ============ Company ==============
    Route::get('company/delete_section/{id}', 'CompanyController@delete_section');
    Route::resource('company', 'CompanyController');
    Route::resource('companySection', 'CompanySectionController');
    Route::resource('companyEmployee', 'CompanyEmployeeController');
    Route::resource('companyOrder', 'CompanyOrderController');
    Route::get('company/send_email/{id}', ['uses' => 'CompanyController@send_email', 'as' => 'admin.company.send_email']);
    Route::post('company/do_send_email', ['uses' => 'CompanyController@doSendEmail', 'as' => 'admin.company.do_send_email']);
    Route::get('company/send_sms/{id}', ['uses' => 'CompanyController@send_sms', 'as' => 'admin.company.send_sms']);
    Route::post('company/do_send_sms', ['uses' => 'CompanyController@doSendSms', 'as' => 'admin.company.do_send_sms']);
    // end company

    Route::resource('travel_offices', 'Travel_officesController');
    Route::get('travel_offices/sendEmail/{id}', 'Travel_officesController@sendEmail');
    Route::post('travel_offices/doSendEmail/{id}', 'Travel_officesController@doSendEmail');
    Route::get('travel_offices/sendSMS/{id}', 'Travel_officesController@sendSMS');
    Route::post('travel_offices/doSendSMS/{id}', 'Travel_officesController@doSendSMS');
    Route::resource('travel_sections', 'Travel_sectionsController');
    Route::get('travel_sections/delete_section/{id}', 'Travel_sectionsController@delete_section');
    Route::resource('travel_employees', 'Travel_employeesController');
    Route::resource('travel_orders', 'Travel_ordersController');
    Route::resource('employee', 'EmployeeController');
    Route::resource('country', 'CountryController');
    Route::resource('city', 'CityController');
    Route::resource('partners', 'PartnersController');
    Route::resource('partner_types', 'Partner_typesController');
    Route::resource('bill', 'BillController');
    Route::resource('banking/accounts', 'BankingAccountsController');
    Route::resource('employees', 'EmployeesController');
    Route::resource('employee_vacations', 'Employee_vacationsController');
    Route::resource('vacation_types', 'Vacation_typesController');
    Route::resource('trips', 'TripsController');
    Route::resource('nature_work', 'Nature_workController');
    Route::resource('income', 'IncomeController', ['except' => 'show']);
    Route::resource('income/types', 'IncomeTypesController');
    Route::resource('exchangeType', 'exchangeTypeController');
    Route::resource('expenses', 'ExpensesController');
    Route::resource('transport_type', 'TransportTypeController');
    Route::resource('transportations', 'TransportationsController');
    Route::resource('useful_link', 'useful_linkController');
    Route::resource('orders_types', 'Orders_typesController');
    Route::resource('loginSite', 'loginSiteController');
    Route::get('useful_link/deleteAttachment/{id}', ['uses' => 'useful_linkController@deleteAttachment', 'as' => 'admin.useful_link.deleteAttachment']);
    Route::resource('types', 'TypesController');
    Route::resource('employee', 'EmployeeController');
    Route::resource('offices', 'OfficeController');
    Route::resource('salaries', 'SalariesController');
    Route::resource('bills', 'BillsController');

    # booking flight
    Route::resource('busses/suppliers', 'BussesSuppliersController');
    Route::get('busses/suppliers/send/emails', 'BussesSuppliersController@getEmails');
    Route::post('busses/suppliers/send/emails', ['uses' => 'BussesSuppliersController@sendEmails', 'as' => 'suppliers.send.emails']);
    Route::get('busses/suppliers/send/sms', 'BussesSuppliersController@getSms');
    Route::post('busses/suppliers/send/sms', ['uses' => 'BussesSuppliersController@sendSms', 'as' => 'suppliers.send.sms']);
    Route::resource('busses/Handings', 'BussesHandingsController');
    Route::resource('busses/reservations', 'BussesReservationsController');
    Route::resource('busses/branches', 'BussesBranchesController');
    Route::resource('busses', 'BussesController');
    Route::resource('busStops', 'BusStopsController');
    Route::resource('drivers', 'DriversController');
    Route::resource('tourist/programmes', 'TouristProgrammesController');
    Route::resource('flight/reservations', 'FlightReservationController');
    #meetings routes
    Route::resource('meeting_places', 'MeetingPlacesController');
    Route::resource('meeting_types', 'MeetingTypesController');
    Route::resource('meetings', 'MeetingsController');
    Route::get('meetings/{id}/create/event', ['middleware' => 'MeetingEvents', 'uses' => 'MettingEventsController@create']);
    Route::post('meetings/{id}/store/event', ['middleware' => 'MeetingEvents', 'uses' => 'MettingEventsController@store', 'as' => 'admin.meetings.events.store']);
    Route::get('meetings/{id}/edit/event', ['uses' => 'MettingEventsController@edit', 'as' => 'admin.meetings.events.edit']);
    Route::put('meetings/{id}/update/event', ['uses' => 'MettingEventsController@update', 'as' => 'admin.meetings.events.update']);
    Route::get('meetings/{id}/event/absences', 'MettingEventsController@getAbsences');
    Route::post('meetings/event/absences/{event_id}/{employee_id}', ['uses' => 'MettingEventsController@storeAbsenceReason', 'as' => 'store.reason']);
    Route::get('meetings/send/emails', 'MeetingsController@getEmails');
    Route::post('meetings/send/emails', ['uses' => 'MeetingsController@sendEmails', 'as' => 'employees.send.emails']);
    #transactions routes
    Route::resource("transactions/types", 'TransactionsTypesController');
    Route::resource("transactions", 'TransactionsController');
    #instructions routes
    Route::resource("instructions", 'InstructionsController');
    Route::get("instructions/delete_instruction/{id}", 'InstructionsController@delete_instruction');
    #advertisements routes
    Route::resource("advertisements", 'AdvertisementsController');
    Route::resource("designer_advertising", 'DesignerAdvertisingController');
    Route::get("advertisements/send/advertise/{id}", 'AdvertisementsController@sendAdvertise');
    Route::post("advertisements/send/advertise/{id}", ['uses' => 'AdvertisementsController@sendAdvertiseToClients', 'as' => 'send.advertise']);
    #visas routes
    Route::resource("visas", "VisasController");
    Route::resource("embassies", "EmbassiesController");
    Route::resource("embassy/branches", "EmbassybranchesController");
    #courses routes
    Route::resource("courses", "CoursesController");
    #courses routes
    Route::resource('institutes', 'InstitutesController');
    Route::get('institutes/{id}/students/get', 'InstitutesController@showInstituteStudents');
    #students routes
    Route::resource('institutes/{id}/students', 'StudentsController', ['names' => [
            'store' => 'admin.students.store', 'update' => 'admin.students.update', 'show' => 'admin.students.show', 'destroy' => 'admin.students.destroy']]);
    #executing orders
    Route::get('executing/orders/{id}', 'Executing_orders@create');
});

Route::group(['prefix' => 'api', 'middleware' => 'apis'], function() {
    //hotelApi
    Route::get('country/list', 'HotelApiController@CountryList');
    Route::get('top/destinations', 'HotelApiController@TopDestinations');
    Route::get('city/list/{country_id}', 'HotelApiController@DestinationCityList');
    Route::any('hotel/search', 'HotelApiController@HotelSearch');
    Route::get('hotel/details', 'HotelApiController@HotelDetails');
    Route::get('hotel/available/rooms/{SessionId}/{HotelCode}', 'HotelApiController@AvailableHotelRooms');
    Route::get('hotel/cancellation/policies/{SessionId}', 'HotelApiController@HotelCancellationPolicies');
    Route::get('hotel/availability/and/pricing/{SessionId}/{HotelCode}', 'HotelApiController@AvailabilityAndPricing');
    Route::get('hotel/rooms/to/book/{order_id}/{SessionId}/{HotelCode}', 'HotelApiController@RoomsToBook');
    Route::get('hotel/book/{order_id}/{SessionId}', 'HotelApiController@HotelBook');
    //transferApi
    Route::get('transfer/{order_id}', 'TransferController@transfer');
    Route::any('transfer/get/details/{order_id}', 'TransferController@getTransferDetails');
    Route::any('transfer/booking/{order_id}', 'TransferController@booking');
    Route::any('transfer/final/process', 'TransferController@finalProcess');
    //sportApi
    Route::get('sport/{order_id}', 'SportController@sport');
    Route::any('sport/get/details/{order_id}', 'SportController@getSportDetails');
    Route::any('sport/booking/{order_id}', 'SportController@booking');
    Route::any('sport/final/process', 'SportController@finalProcess');
});

Route::get('cities', function() {
    $cities = file_get_contents("http://iatacodes.org/api/v4/cities?api_key=e7f7ed17-7115-4041-b127-7c6631eff6c3");
    $cities = json_decode($cities);
    $cities = $cities->response;
    foreach ($cities as $key) {
        echo "<pre>";
// print_r($key);
        print_r("[ name=>" . '"' . $key->name . '"' . ", code=>" . '"' . $key->code . '"' . ", country_code=>" . '"' . $key->country_code . '"' . "],");
        echo "<pre>";
    }
});



Route::get('test', function() {
    $CheckOutDate = "2016-07-26";
    $request = '<?xml version="1.0" encoding="UTF-8"?>
	<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:hot="http://TekTravel/HotelBookingApi"><soap:Header xmlns:wsa="http://www.w3.org/2005/08/addressing"><hot:Credentials UserName="kuldeepapi" Password="12345"/><wsa:Action>http://TekTravel/HotelBookingApi/HotelSearch</wsa:Action><wsa:To>http://api.tbotechnology.in/hotelapi_v7/hotelservice.svc</wsa:To></soap:Header><soap:Body><hot:HotelSearchRequest><hot:CheckInDate>2016-07-25</hot:CheckInDate><hot:CheckOutDate>' . $CheckOutDate . '</hot:CheckOutDate><hot:CountryName>United Arab Emirates</hot:CountryName><hot:CityName>Dubai</hot:CityName><hot:CityId>25921</hot:CityId><hot:NoOfRooms>1</hot:NoOfRooms><hot:GuestNationality>AE</hot:GuestNationality><hot:RoomGuests><hot:RoomGuest AdultCount="1"/></hot:RoomGuests><hot:Filters><hot:StarRating>All</hot:StarRating></hot:Filters></hot:HotelSearchRequest></soap:Body></soap:Envelope>
	';

    $location = "http://api.tbotechnology.in/hotelapi_v7/hotelservice.svc";
    $action = "http://TekTravel/HotelBookingApi/HotelSearch";
    $client = new SoapClient("http://api.tbotechnology.in/hotelapi_v7/hotelservice.svc?wsdl");
    $resp = $client->__doRequest($request, $location, $action, 2);
    $xml = $resp;

    $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $xml);
    $xml = simplexml_load_string($xml);
    $xml = $xml->$xml->xpath('//sBody')[0]->HotelSearchResponse->HotelResultList;
    // dd($xml);
    $responseArray = json_encode($xml);
    foreach (json_decode($responseArray, true) as $value) {
        foreach ($value as $hotel) {
            echo "<pre>";
            dd($hotel);
            echo "</pre>";
        }
    }
// 	$apiKey       = "8z8a7tupn5hubhjxqh8ubuz7";
// 	$sharedSecret = "jsSJq2msbU";
// 	$signature = hash("sha256", $apiKey.$sharedSecret.time());
// 	// $stay = json_encode(['stay'=>['checkIn'=>'2016-06-08' , 'checkOut'=>'2016-06-10' , 'shiftDays'=>'2'] , 'occupancies'=>['rooms'=>'1' , 'children'=>'0']]);
// // dd($stay);
// 	$para = json_encode(['codes'=>[['activityCode'=>'E-E10-JAMONEXPER' , 'modalityCodes'=>["ENGLISH"] ]],'language'=>'en']);
// // dd($para);
// 	$endpoint = "https://api.test.hotelbeds.com/activity-content-api/3.0/activities/";
// 	$request = new \http\Client\Request("POST",
// 		$endpoint,
// 		[ "Api-Key"     => $apiKey,
// 		"X-Signature"   => $signature,
// 		"Accept"        => "application/json" ,
// 		"Content-Type"  => "application/json" ,
// 		// $para
// 		]);
// 	// $request->getBody()->addForm([
// 	// 	$para
// 	// 	]);
// 	$request->getBody()->append(new http\QueryString(
// 		$para
// 		));
// 	try
// 	{
// 		$client = new \http\Client;
// 		$client->enqueue($request)->send();
//     // pop the last retrieved response
// 		$response = $client->getResponse();
// // dd($response);
// 		if ($response->getResponseCode() != 200) {  
// 			printf("%s returned '%s' (%d)\n",
// 				$response->getTransferInfo("effective_url"),
// 				$response->getInfo(),
// 				$response->getResponseCode()
// 				);
// 		}
// 		else {
// 			echo "<pre>";
// 			print_r(json_decode($response->getBody()));
// 			echo "</pre>";
// 		}
// 	} catch (Exception $ex) {
// 		printf("Error while sending request, reason: %s\n",$ex->getMessage());
// 	}
});



Route::get('test2', function() {
// Your API Key and secret
    $apiKey = "me8s4yx8qxrz2dhzghwtu8x2";
    $sharedSecret = "YZ3SfunCH8";

// Signature is generated by SHA256 (Api-Key + Shared Secret + Timestamp (in seconds))
    $signature = hash("sha256", $apiKey . $sharedSecret . time());

// Example of call to the API
    $endpoint = "https://api.test.hotelbeds.com/hotel-api/1.0/hotels/6914?checkIn=2016-06-19&checkOut=2016-06-21&occupancies=1~1~0~AD-30";

    $request = new \http\Client\Request("GET", $endpoint, [ "Api-Key" => $apiKey,
        "X-Signature" => $signature,
        "Accept" => "application/json",
    ]);

    // $q = new http\QueryString("checkIn=2016-06-19&checkOut=2016-06-21&occupancies=1~1~0~AD-30");
    // $request->setQuery($q);
    try {
        $client = new \http\Client;

        $client->enqueue($request)->send();

        // pop the last retrieved response

        $response = $client->getResponse();

        if ($response->getResponseCode() != 200) {

            printf("%s returned '%s' (%d)\n", $response->getTransferInfo("effective_url"), $response->getInfo(), $response->getResponseCode()
            );
        } else {
            echo "<pre>";
            print_r($response->getBody());
            echo "</pre>";
            // 	$i = 0;
            // 	foreach(json_decode($response->getBody()) as $key)
            // 	{
            // 		if(++$i >= 3)
            // 		{
            // 			foreach($key as $val)
            // 			{
            // 				echo "<pre>";
            // 				print_r($val);
            // 				echo "</pre>";
            // 			}
            // 		}
            // 	}
            // 	// printf("ok %s" , $response->getBody());
        }
    } catch (Exception $ex) {

        printf("Error while sending request, reason: %s\n", $ex->getMessage());
    }
});
