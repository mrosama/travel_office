<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model {

    protected $fillable = ["number", "model", "color", "size", "photo", 'license_number', 'branch_id', 'supplier_id', 'notes', "latitude", "longitude", "run_card_number", "hajj_permit", "permit_number", "permit_duration", "permit_date", "permit_end_date"];

    public function supplier() {
        return $this->belongsTo('App\BussesSupplier', 'supplier_id');
    }

    public function branch() {
        return $this->belongsTo('App\BussesBranch', 'branch_id');
    }

}
