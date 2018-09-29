<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ClientsOrdersRequest;
use App\Http\Models\Country;
use App\Http\Models\City;
use App\Client_order;
use App\Orders_type;
use App\Client;
use App\Client_family;
use App\Order_transport;
use Redirect;

class Clients_ordersController extends Controller
{

    public function index()
    {
        $client_orders = Client_order::all();
        
        return view('admin.clients_orders.index' , compact('client_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orders_type = Orders_type::lists('type' , 'id');
        $all_countries = Country::lists('name' , 'code');
        $all_clients = Client::lists('username' , 'id');
        return view('admin.clients_orders.create' , compact('all_countries' , 'all_clients' , 'orders_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientsOrdersRequest $request)
    {
        $data = $request->all();
        $data['id_child']     = json_encode([$request->id_child]);
        $data['order_type']   = json_encode($request->order_type);
        $data['country_from'] = json_encode($request->country_from);
        $data['city_from']    = json_encode($request->city_from);
        $data['country_to']   = json_encode($request->country_to);
        $data['city_to']      = json_encode($request->city_to);
        $Client_order         = Client_order::create($data);
        return Redirect::back()->with(['success' => 'تمت عملية الاضافة بنجاح لتنفيذ الطلب يرجى الضغط هنا ' , 'order_id' => $Client_order->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client_order = Client_order::find($id);
        $wife_id      = Client_family::where(['parent_id' => $client_order->client_id , 'type' => 0])->first();

        if($wife_id != null)
            $wife         = Client::find($wife_id->new_client_id);
        else
            $wife         = null;

        $child_id     = Client_family::where(['parent_id' => $client_order->client_id , 'type' => 1])->get();
        $child        = [];

        foreach ($child_id as $row) 
            array_push($child , Client::find($row->new_client_id));

        return view('admin.clients_orders.show' , compact('client_order' , 'wife' , 'child'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $client_order = Client_order::find($id);

        $client_id   = $client_order->client_id;
        $wife_id     = Client_family::where(['parent_id' => $client_id , 'type' => 0])->first();
      
        if($wife_id != null)
            $wife        = Client::find($wife_id->new_client_id);
        else
            $wife        = null;

        $child_id    = Client_family::where(['parent_id' => $client_id , 'type' => 1])->get();
        $child       = [];
        $orders_type = Orders_type::all();
        $all_clients = Client::all();

        foreach ($child_id as $row) 
            array_push($child , Client::find($row->new_client_id));
        
        return view('admin.clients_orders.edit' , compact('all_clients'  , 'client_order' , 'wife' , 'child'  , 'orders_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();
        if(isset($data['id_wife']))
        {
            $data['id_wife'] = $data['id_wife'];
        }
        else
        {
            $data['id_wife'] = 0;
        }
        $data['id_child'] =json_encode($request->id_child);
        $data['order_type'] =json_encode($request->order_type);
        $data['country_from'] =json_encode($request->country_from);
        $data['city_from'] =json_encode($request->city_from);
        $data['country_to'] =json_encode($request->country_to);
        $data['city_to'] =json_encode($request->city_to);
        $client_order =Client_order::find($id)->update($data);
        return Redirect::back()->with('success' , 'تمت عملية التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client_order::find($id)->delete($id);
        return redirect::back()->with('success' , 'لقد تمت عملية الحذف بنجاح !');
    }
}
