<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Child;
use App\Models\Proof;
use App\Models\Complaints;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    public function index()
    {
        $regardingComplaints = Complaints::all();
        return view('content.dashboard.complaints.index', compact('regardingComplaints'));
    }

    public function create()
    {
        $familyId = Auth::user()->id;
        $childData = Child::where('family_id', $familyId)->get();
        return view('content.dashboard.complaints.create', compact('childData'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'user_id' => 'required',
            'child_id' => 'required',
            'regarding' => 'required|max:255',
            'chronology' => 'required|min:10',
            'proof.*' => 'image|file|max:2048|required'
        ], [
            'proof.*.image' => 'The proof must be an image file.',
            'proof.*.file' => 'Invalid file format for proof.',
            'proof.*.max' => 'The proof file size must not exceed 2MB.',
        ]);

        $complaints = Complaints::create($data);

        if ($request->hasFile('proof')) {
            foreach ($request->file('proof') as $file) {
                Proof::create([
                    'id_complaints' => $complaints->id,
                    'proof' => $file->store('Bukti-Pengaduan')
                ]);
            }
        }

        return redirect('/my-complaint')->with('success', 'Anda Berhasil Membuat Pengaduan');
    }

    public function show(Complaints $complaints, $id)
    {
        $complaints = Complaints::findOrFail($id);
        $proofs = Proof::where('id_complaints', $complaints->id)->get();
        return view('content.dashboard.complaints.show', compact('complaints', 'proofs'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
    }
}
