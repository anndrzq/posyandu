<?php

namespace App\Http\Controllers\dashboard;

use App\Models\User;
use App\Models\family;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    public function index()
    {
        $parents = Family::all();
        $familyIds = $parents->pluck('id');
        $usernames = User::whereIn('family_id', $familyIds)->pluck('username', 'family_id');
        $parents->each(function ($family) use ($usernames) {
            $family->username = $usernames->get($family->id, 'N/A');
        });

        return view('content.dashboard.data-master.parent.index', ['parents' => $parents]);
    }

    public function create()
    {
        return view('content.dashboard.data-master.parent.create', [
            'parents' => family::all(),
            'users' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'username' => 'required|min:4|unique:users',
                'password' => 'required|confirmed|min:6|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
                'role' => 'required',
                'nik' => 'required|size:16|unique:families',
                'mother_name' => 'required',
                'father_name' => 'required',
                'date_of_birth_mom' => 'required|date',
                'date_of_birth_father' => 'required|date',
                'place_of_birth_mom' => 'required',
                'place_of_birth_father' => 'required',
                'blood_type_mom' => 'required',
                'blood_type_father' => 'required',
                'many_kids' => 'required|min:1',
                'address' => 'required',
                'city' => 'required',
                'subdistrict' => 'required',
                'ward' => 'required',
                'postal_code' => 'required|min:5',
                'phone_number' => 'required|between:10,13|unique:families'
            ],
            [
                'phone_number.between' => 'Nomor :attribute harus antara :min dan :max karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok dengan password yang dimasukkan.',
                'password.regex' => 'attribute harus mengandung setidaknya satu huruf besar dan satu angka.'
            ]
        );


        $family = family::create([
            'nik' => $data['nik'],
            'mother_name' => $data['mother_name'],
            'father_name' => $data['father_name'],
            'date_of_birth_mom' => date('Y-m-d', strtotime($data['date_of_birth_mom'])),
            'date_of_birth_father' => date('Y-m-d', strtotime($data['date_of_birth_father'])),
            'place_of_birth_mom' => $data['place_of_birth_mom'],
            'place_of_birth_father' => $data['place_of_birth_father'],
            'blood_type_mom' => $data['blood_type_mom'],
            'blood_type_father' => $data['blood_type_father'],
            'many_kids' => $data['many_kids'],
            'address' =>  $data['address'],
            'city'  => $data['city'],
            'subdistrict' =>  $data['subdistrict'],
            'ward' =>   $data['ward'],
            'postal_code' =>   $data['postal_code'],
            'phone_number' => $data['phone_number']
        ]);

        $user = User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'family_id' => $family->id
        ]);


        return redirect('/parent-data')->with('success', 'Keluarga Berhasil Di Tambah');
    }

    public function show(family $family)
    {
        //
    }


    public function edit(family $family)
    {
        //
    }

    public function update(Request $request, family $family)
    {
        //
    }

    
    public function destroy($id)
    {
        $family = Family::findOrFail($id);
        if ($family->user) {
            $family->user->delete();
        }
        $family->delete();
        return redirect('/parent-data')->with('success', 'Keluarga Berhasil Dihapus');
    }
}
