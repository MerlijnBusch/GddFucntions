<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    protected $guarded = ['file_name','data_json_version'];
}
