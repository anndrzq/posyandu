<?php

namespace App\Http\Controllers\dashboard;

use App\Models\User;
use App\Models\Midwife;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MidwifeController extends Controller
{

    public function index()
    {
        $midwives = Midwife::all();
        $midwivesIds = $midwives->pluck('id');
        $usernames = User::whereIn('midwife_id', $midwivesIds)->pluck('username', 'midwife_id');
        $midwives->each(function ($midwife) use ($usernames) {
            $midwife->username = $usernames->get($midwife->id, 'N/A');
        });
        return view('content.dashboard.data-master.midwife.index', compact('midwives'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Midwife $midwife)
    {
        //
    }

    public function edit(Midwife $midwife)
    {
        //
    }

    public function update(Request $request, Midwife $midwife)
    {
        //
    }

    public function destroy(Midwife $midwife)
    {
        //
    }
}
