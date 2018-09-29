<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model {

    protected $fillable = ['name', 'type', 'mobile', 'phone', 'email', 'site_url', 'logo', 'country', 'city', 'street', 'latitude', 'longitude', 'mail_box', 'fax', 'skype', 'twitter', 'facebook', 'other', 'notes'];

    static public function storePartner($data, $logo) {
        $data = [
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'phone' => $data['phone'],
            'email' => json_encode($data['email']),
            'site_url' => $data['site_url'],
            'country' => $data['country'],
            'city' => $data['city'],
            'street' => $data['street'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'mail_box' => $data['mail_box'],
            'fax' => $data['fax'],
            'skype' => $data['skype'],
            'twitter' => $data['twitter'],
            'facebook' => $data['facebook'],
            'other' => $data['other'],
            'notes' => $data['notes'],
            'type' => $data['type'],
            'logo' => $logo
        ];
        $newPartner = Partner::create($data);
        return $newPartner->id;
    }

    static public function updatePartner($data, $logo, $id) {
        $data = [
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'phone' => $data['phone'],
            'email' => json_encode($data['email']),
            'site_url' => $data['site_url'],
            'country' => $data['country'],
            'city' => $data['city'],
            'street' => $data['street'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'mail_box' => $data['mail_box'],
            'fax' => $data['fax'],
            'skype' => $data['skype'],
            'twitter' => $data['twitter'],
            'facebook' => $data['facebook'],
            'other' => $data['other'],
            'notes' => $data['notes'],
            'type' => $data['type'],
            'logo' => $logo
        ];
        Partner::find($id)->update($data);
    }

    public function partnerBankData() {
        return $this->hasMany('App\PartnerBankData');
    }

    public function partnerPayTransfer() {
        return $this->hasMany('App\PartnerPayTransfer');
    }

    public function employees() {
        return $this->hasMany('App\partner_employees');
    }

    public function getCountry() {
        return $this->hasOne('App\Http\Models\Country', 'code', 'country');
    }

    public function getCity() {
        return $this->hasOne('App\Http\Models\City', 'id', 'city');
    }

    public function user() {
        return $this->hasOne('App\User', 'user_id', 'id')->where('type', "partner");
    }

    public function Partner_type() {
        return $this->hasOne('App\Partner_type', 'id', 'type');
    }

}
