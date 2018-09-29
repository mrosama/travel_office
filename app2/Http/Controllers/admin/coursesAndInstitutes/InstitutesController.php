<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\InstituteRequest;
use App\Http\Models\Country;
use App\Institute;
use Redirect;
use App\Student;

class InstitutesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all_institute'] = Institute::all();
        return view('admin.coursesAndInstitutes.institutes.index' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['all_country'] = country::lists('name' , 'code');
        return view('admin.coursesAndInstitutes.institutes.create' , $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstituteRequest $request)
    {
        Institute::create($request->all());
        return Redirect::back()->with('success' , 'لقد تمت عملية الاضافة بنجاح !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['institute_data'] = Institute::find($id);
        $data['all_country'] = country::lists('name' , 'code');
        return view('admin.coursesAndInstitutes.institutes.edit' , $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstituteRequest $request, $id)
    {
        Institute::find($id)->update($request->all());
        return Redirect::back()->with('success' , 'تمت عملية التعديل بنجاح !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $institute = Institute::find($id);
        if($institute->students != null)
        {

            foreach ($institute->students as $student) 
            {
                $student->delete();
            }
        }

        $institute->delete();
        return Redirect::back()->with('success' , 'تمت عملية حذف المعهد بنجاح !');     
    }

    public function showInstituteStudents($id)
    {
        $data['institute'] = Institute::find($id); 
        return view('admin.coursesAndInstitutes.institutes.showStudents' , ['data'=>$data]);
    }
}
