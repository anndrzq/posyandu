<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function WeighingChild()
    {
        return view('content.dashboard.service.WeighingChild.index');
    }
}
