<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BussesSupplier extends Model {

    protected $fillable = ["logo", "name", "branch_id", "tel", "mobile", "email", "twitter", "face", "skype", "Commercial_record_no", "country", "city", "street", "lat", "long", "notes", "mailbox", "postal_code", "fax", "website", "commercial_reg_img"];

    public function bussesBranch() {
        return $this->belongsTo('App\BussesBranch', 'branch_id', 'id');
    }

    static public function checkIfImgNotNull($logo, $img) {
        $upload = new Client;

        if ($logo != null) {
            if ($img != "/noimage.gif")
                \File::delete(public_path() . $img);
            $logo = $upload->uploadFile($logo);
        } else
            $logo = $img;

        return $logo;
    }

}
