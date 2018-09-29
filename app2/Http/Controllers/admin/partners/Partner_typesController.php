<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Partner_type;
use Redirect;

class Partner_typesController extends Controller {

    public function index() {
        $data['partner_types'] = Partner_type::all();
        return view('admin.partners.partner_types.index', $data);
    }

    public function create() {
        return view('admin.partners.partner_types.create');
    }

    public function store(Request $request) {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        Partner_type::create($input);
        return redirect()->back()->with('success', '  لقد تمت عملية الاضافة بنجاح');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $data['partner_type'] = Partner_type::find($id);
        return view('admin.partners.partner_types.edit', $data);
    }

    public function update(Request $request, $id) {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        Partner_type::find($id)->update($input);
        return redirect()->back()->with('success', '  لقد تمت عملية التعديل بنجاح');
    }

    public function destroy($id) {
        Partner_type::find($id)->delete();
        return Redirect::back()->with('success', 'لقد تمت عملية الحذف  بنجاح');
    }

}
