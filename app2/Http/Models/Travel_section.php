<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel_section extends Model {

    protected $fillable = ['sectionName', 'travel_officeId', 'phone', 'mobile', 'email', 'fax', 'ext'];

    public function officeName() {
        return $this->belongsTo('App\Travel_office', 'travel_officeId', 'id');
    }

}
