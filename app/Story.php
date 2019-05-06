<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sassnowski\LaravelShareableModel\Shareable\Shareable;
use Sassnowski\LaravelShareableModel\Shareable\ShareableInterface;

class Story extends Model implements ShareableInterface
{
    const ACCEPTED = 'true';
    const DECLINED = 'declined';
    const PENDING = 'false';
    //
    use Shareable;

    public function user()
    {

        $this->hasOne('App\User');

    }
}
