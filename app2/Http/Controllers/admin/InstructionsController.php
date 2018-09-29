<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Instructions;
use App\Http\Models\Country;
use App\Http\Requests\InstructionsRequest;
use Redirect;
use App\Client;
use File;
use App\Http\Models\City;

class InstructionsController extends Controller {

    public function index() {
        $instructions = Instructions::all();
        return view('admin.instructions.index', ['instructions' => $instructions, 'i' => 0]);
    }

    public function create() {
        $data['countries'] = Country::lists('name', 'code');
        return view('admin.instructions.create', ['data' => $data]);
    }

    public function store(InstructionsRequest $request, Client $upload) {
        if ($request->file != null)
            $file = $upload->uploadFile($request->file, 1);
        else
            $file = null;

        Instructions::create($request->except('file') + ['file' => $file]);
        return Redirect::back()->with('global_s', 'تم اضافة المعلومات بنجاح');
    }

    public function show($id) {
        $instruction = Instructions::find($id);
        return view('admin.instructions.show', ['instruction' => $instruction]);
    }

    public function edit($id) {
        $data['instruction'] = Instructions::find($id);
        $data['countries'] = Country::lists('name', 'code');
        $data['cities'] = City::where('country_code', $data['instruction']->country)->lists('name', 'id');
        return view('admin.instructions.edit', ['data' => $data]);
    }

    public function update(InstructionsRequest $request, Client $upload, $id) {
        $instruction = Instructions::find($id);

        if ($request->file != null) {
            if ($instruction->file != "/noimage.gif")
                File::delete(public_path() . $instruction->file);
            $file = $upload->uploadFile($request->file, 1);
        } else
            $file = $instruction->file;

        $instruction->update($request->except('file') + ['file' => $file]);
        return Redirect::back()->with('global_s', 'لقد تم تعديل المعلومات بنجاح');
    }

    public function destroy($id) {
        $instruction = Instructions::find($id);
        File::delete(public_path() . $instruction->file);
        $instruction->delete();
        return Redirect::back()->with('success', 'لقد تم حذف المعلومات بنجاح');
    }

    public function delete_instruction($id) {
        $instruction = Instructions::find($id);
        File::delete(public_path() . $instruction->file);
        $instruction->delete();
        return Redirect::back()->with('success', 'لقد تم حذف المعلومات بنجاح');
    }

}
