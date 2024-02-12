<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Child;

class ServiceController extends Controller
{
    public function WeighingChild()
    {
        $children = Child::with('parent')->get();
        return view('content.dashboard.service.WeighingChild.index', compact('children'));
    }
}
