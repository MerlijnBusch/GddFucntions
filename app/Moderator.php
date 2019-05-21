<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    public static function getFileType($fileName)
    {
        $ext     = explode('.', $fileName);
        $ext_len = count($ext) - 1;
        return $ext[$ext_len];
    }

    public static function checkIfStringIsJson($jsonString)
    {
        $input = trim($jsonString);
        if ((substr($input, 0, 1) == '{' && substr($input, -1) == '}') or (substr($input, 0, 1) == '[' && substr($input, -1) == ']')) {
            $output = json_decode($input, 1);
            if (in_array(gettype($output),['object','array'])) {
                return true;
            }
        }
        return false;
    }
}
