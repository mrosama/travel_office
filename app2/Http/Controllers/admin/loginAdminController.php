<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
class loginAdminController extends Controller {
public function index(){

 return view('admin.adminlogin');

}


public function processlogin(Request $request){
if ($request->isMethod('post')) {
$email = $request->input('email');
$password = $request->input('password');
 


if (Auth::attempt(['user_name' => $email, 'password' => $password], false)) {
 	return redirect()->intended('admin');


}
else {

 return redirect('/')->withInput($request->except('password'))->with('error','Error Login');
 //return redirect('/')->with('error','Error Login');
}





}

}





}
