<?php

namespace App\Http\Controllers\authentications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index()
    {
        return view('content.authenticate.login');
    }
}
