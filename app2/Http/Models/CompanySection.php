<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySection extends Model {

    protected $fillable = ['sectionName', 'companyId', 'phone', 'mobile', 'email', 'fax', 'ext'];

    public function companyName() {
        return $this->belongsTo('App\company', 'companyId', 'id');
    }

}
