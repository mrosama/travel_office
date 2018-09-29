<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\partner_employees;
use App\Instructions;
use App\Travel_section;
use App\Travel_office;
use App\BussesSupplier;
use App\Bus;

class DataAjaxController extends Controller {

    public function getBusses() {
        return Bus::where('supplier_id', $_GET['supplier_id'])->select('number', 'id')->get();
    }

    public function getSupplier() {
        return BussesSupplier::where('branch_id', $_GET['branch_id'])->select('name', 'id')->get();
    }

    public function get_partner_employee() {
        $emp_data = partner_employees::where('id', $_GET['emp_id'])->get();
        return $emp_data;
    }

    public function getTravelOffice() {

        $officeName = Travel_office::find($_GET['officeID'])->name;
        $travelOfficeSecion = Travel_section::where('travel_officeId', $_GET['officeID'])->with('officeName')->get();
        return $travelOfficeSecion;
    }

    public function get_instruction_type() {
        if ($_GET['order_type'] == "all") {
            $instruction_data = Instructions::all();
            return $instruction_data;
        } else {
            $dola = array();
            $instruction_data = Instructions::where('type', $_GET['order_type'])->get();
            foreach ($instruction_data as $row) {
                // Type
                if ($row->type == "s")
                    $type = 'خاص للعميل';
                elseif ($row->type == "g")
                    $type = 'عام للعميل';
                else
                    $type = 'خاص للمكتب';

                // File
                if ($row->file != null)
                    $file_link = $row->file;
                else
                    $file_link = '';
                array_push($dola, ['id' => $row->id, 'title' => $row->title, 'type' => $type, 'country' => $row->getCountry->name, 'city' => $row->getCity->name, 'file' => $file_link, 'notes' => $row->notes]);
            }
            return $dola;
        }
    }

}
