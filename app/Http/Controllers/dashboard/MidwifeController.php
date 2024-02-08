<?php

namespace App\Http\Controllers\dashboard;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Midwife;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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
        $midwife = Midwife::all();
        $user = User::all();
        return view('content.dashboard.data-master.midwife.create', compact('midwife', 'user'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'username' => 'required|min:4|unique:users',
                'password' => 'required|confirmed|min:6|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
                'role' => 'required',
                'nik' => 'required|size:16|unique:midwives',
                'nip' => 'required|size:18|unique:midwives',
                'name' => 'required',
                'place_of_birth' => 'required',
                'date_of_birth' => 'required|date',
                'gender' => 'required',
                'address' => 'required',
                'last_educations' => 'required',
                'phone_number' => 'required|between:10,13|unique:midwives'
            ],
            [
                'phone_number.between' => 'Nomor :attribute harus antara :min dan :max karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok dengan password yang dimasukkan.',
                'password.regex' => 'attribute harus mengandung setidaknya satu huruf besar dan satu angka.'
            ]
        );

        $midwife = Midwife::Create([
            'nik' => $data['nik'],
            'nip' => $data['nip'],
            'name' => $data['name'],
            'place_of_birth' => $data['place_of_birth'],
            'date_of_birth' => Carbon::parse($data['date_of_birth'])->format('Y-m-d'),
            'gender' => $data['gender'],
            'address' => $data['address'],
            'last_educations' => $data['last_educations'],
            'phone_number' => $data['phone_number']
        ]);

        $user = User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'midwife_id' => $midwife->id
        ]);

        return redirect('/midwife-data')->with('success', 'Anda Berhasil Menambahkan Bidan');
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
