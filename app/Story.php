<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    const ACCEPTED = 'true';
    const DECLINED = 'declined';
    const PENDING = 'false';
    //
    public function user()
    {

        $this->hasOne('App\User');

    }
}
