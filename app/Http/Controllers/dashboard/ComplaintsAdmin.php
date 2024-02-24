<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Proof;
use App\Models\Complaints;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ComplaintsAdmin extends Controller
{
    public function index()
    {
        $complaints = Complaints::all();
        return view('content.dashboard.complaintsAdmin.index', compact('complaints'));
    }

    public function show($id)
    {
        $complaints = Complaints::findOrFail($id);
        $proofs = Proof::where('id_complaints', $complaints->id)->get();
        return view('content.dashboard.complaintsAdmin.show', compact('complaints', 'proofs'));
    }

    public function process(Complaints  $complaints)
    {
        $complaints->update(['status' => 'proses']);
        return redirect('/complaint-message')->with('success', 'Anda Berhasil Memproses Pengaduan');
    }
    public function finished(Complaints  $complaints)
    {
        $complaints->update(['status' => 'selesai']);
        return redirect('/complaint-message')->with('success', 'Anda Berhasil Menyelesaikan Pengaduan');
    }
    public function reject(Complaints  $complaints)
    {
        $complaints->update(['status' => 'tolak']);
        return redirect('/complaint-message')->with('success', 'Anda Berhasil Tolak Pengaduan');
    }
}
