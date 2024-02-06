<?php

namespace App\Http\Controllers\dashboard;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Officer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class OfficerController extends Controller
{

    public function index()
    {

        $officers = Officer::all();
        $officerIds = $officers->pluck('id');
        $usernames = User::whereIn('officer_id', $officerIds)->pluck('username', 'officer_id');
        $officers->each(function ($officer) use ($usernames) {
            $officer->username = $usernames->get($officer->id, 'N/A');
        });
        return view('content.dashboard.data-master.officer.index', compact('officers'));
    }

    public function create()
    {
        $officers = Officer::all();
        $users = User::all();
        return view('content.dashboard.data-master.officer.create', compact('users', 'officers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'username' => 'required|min:4|unique:users',
                'password' => 'required|confirmed|min:6|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
                'role' => 'required',
                'nik' => 'required|size:16|unique:officers',
                'nip' => 'required|size:18|unique:officers',
                'name' => 'required',
                'place_of_birth' => 'required',
                'date_of_birth' => 'required|date',
                'gender' => 'required',
                'address' => 'required',
                'position' => 'required',
                'last_educations' => 'required',
                'phone_number' => 'required|between:10,13|unique:officers'
            ],
            [
                'phone_number.between' => 'Nomor :attribute harus antara :min dan :max karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok dengan password yang dimasukkan.',
                'password.regex' => 'attribute harus mengandung setidaknya satu huruf besar dan satu angka.'
            ]
        );

        $officer = Officer::create([
            'nik' => $data['nik'],
            'nip' => $data['nip'],
            'name' => $data['name'],
            'place_of_birth' => $data['place_of_birth'],
            'date_of_birth' => Carbon::parse($data['date_of_birth'])->format('Y-m-d'),
            'gender' => $data['gender'],
            'address' => $data['address'],
            'position' => $data['position'],
            'last_educations' => $data['last_educations'],
            'phone_number' => $data['phone_number']
        ]);

        $user = User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'officer_id' => $officer->id
        ]);

        return redirect('/officer-data')->with('success', 'Anda Berhasil Menambahkan Data Petugas');
    }

    public function show(Officer $officer)
    {
        //
    }

    public function edit(Officer $officer)
    {
        //
    }


    public function update(Request $request, Officer $officer)
    {
        //
    }

    public function destroy($id)
    {
        $officers = Officer::findOrFail($id);
        if ($officers->user) {
            $officers->user->delete();
        }
        $officers->delete();
        return redirect('/officer-data')->with('success', 'Petugas Berhasil Di Hapus');
    }
}
