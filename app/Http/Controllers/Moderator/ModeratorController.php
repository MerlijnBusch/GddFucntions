<?php

namespace App\Http\Controllers\Moderator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModeratorController extends Controller
{
    public function index()
    {
        return view('moderator.dashboard.index');
    }
}
