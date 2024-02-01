<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Child;
use App\Models\family;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ChildController extends Controller
{
    public function index()
    {
        $children = Child::with('parent')->get();
        return view('content.dashboard.data-master.children.index', compact('children'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $children = family::select('id', 'mother_name')->get();
        return view('content.dashboard.data-master.children.create', compact('children'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $familyId = $request->input('family_id');
        $family = family::find($familyId);

        if (!$family) {
            return redirect()->back()->with('error', 'Nama Ibu tidak ditemukan.');
        }

        $maxKidsAllowed = $family->many_kids;
        $currentKidsCount = Child::where('family_id', $familyId)->count();

        if ($currentKidsCount >= $maxKidsAllowed) {
            return redirect()->back()->with('error', 'Maaf, jumlah anak telah mencapai batas yang diizinkan.');
        }

        $data = $request->validate([
            'nik' => 'required|size:16|unique:children',
            'name' => 'required',
            'gender' => 'required|in:L,P',
            'date_of_birth_child' => 'required|date',
            'place_of_birth_child' => 'required',
            'blood_type_child' => 'required',
            'family_id' => 'required'
        ]);

        Child::create($data);

        return redirect('children-data')->with('success', 'Data anak berhasil disimpan.');
    }


    public function show(Child $child)
    {
        //
    }

    public function edit(Child $child)
    {
        //
    }

    public function update(Request $request, Child $child)
    {
        //
    }

    public function destroy(Child $child)
    {
        //
    }
}
