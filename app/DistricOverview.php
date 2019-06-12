<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistricOverview extends Model
{
    public static function getData($string)
    {
        $q =  Metric::all();
        $allDataArray = array();
        foreach($q as $query){
             $x = json_decode($query->data_json_version, true);
             foreach($x as $array) {

                 if(array_search($string, $array)) {
                     $tmpArray[] = $array;
                     $tmpArray[] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $query->file_name);
                     $allDataArray[] = $tmpArray;
                     unset($tmpArray);
                 }
             }
        }
        return $allDataArray;
    }
}
