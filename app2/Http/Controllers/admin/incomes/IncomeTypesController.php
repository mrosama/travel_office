<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\IncomeTypeRequest;
use App\Http\Models\Employee;
use App\IncomeType;
use Redirect;

class IncomeTypesController extends Controller
{

    public function index()
    {
        $types = IncomeType::all();
        return view('admin.income.incomeTypes.index' , ['types'=>$types , 'i'=>0]);
    }

    
    public function create()
    {
        return view('admin.income.incomeTypes.create');
    }


    public function store(IncomeTypeRequest $request)
    {
        IncomeType::create($request->all());
        return Redirect::back()->with('success' , 'تمت عملية الاضافة بنجاح');
    }


    public function edit($id)
    {
        $type = IncomeType::find($id);
        return view('admin.income.incomeTypes.edit' , ['type'=>$type]);
    }

    
    public function update(IncomeTypeRequest $request, $id)
    {
        IncomeType::find($id)->update($request->all());
        return Redirect::back()->with('success' , 'تمت عملية التعديل بنجاح');
    }

    
    public function destroy($id)
    {
        $type = IncomeType::find($id);

        if($type->incomes->count() != 0)
            foreach($type->incomes as $income)
                $income->delete();

            $type->delete();

            return Redirect::back()->with('success' , 'لقد تمت عملية الحذف بنجاح ! ');
        }
    }
