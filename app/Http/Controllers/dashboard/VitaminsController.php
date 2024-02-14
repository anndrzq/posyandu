<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Vitamin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VitaminsController extends Controller
{
    public function VitaminsIndex()
    {
        $vitamins = Vitamin::all();
        $vitamins_edit = '';
        return view('content.dashboard.supply.vitamins.index', compact('vitamins', 'vitamins_edit'));
    }

    public function VitaminsStore(Request $request)
    {
        $data = $request->validate([
            'vitamins_name' => 'required',
            'stock' => 'required|numeric'
        ]);

        $existingRecord = Vitamin::where('vitamins_name', $data['vitamins_name'])
            ->where('stock', $data['stock'])
            ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Data Vitamin dengan nilai yang sama sudah ada');
        }

        Vitamin::create($data);
        return redirect()->back()->with('success', 'Data Vitamin Berhasil Ditambahkan');
    }

    public function VitaminsEdit($id)
    {
        $vitamins = Vitamin::findOrFail($id);
        if ($vitamins) {
            $vitamins_edit = $vitamins;
            $vitamins = Vitamin::all();
            return view('content.dashboard.supply.vitamins.index', compact('vitamins_edit', 'vitamins'));
        }
    }

    public function VitaminsUpdate(Request $request, $id)
    {
        $vitamins = Vitamin::findOrFail($id);
        $data = $request->validate([
            'vitamins_name' => 'required',
            'stock' => 'required|numeric'
        ]);

        $existingRecord = Vitamin::where('vitamins_name', $data['vitamins_name'])
            ->where('stock', $data['stock'])
            ->where('id', '!=', $id)
            ->first();
        if ($existingRecord) {
            return redirect()->back()->with('error', 'Data Vitamin dengan nilai yang sama sudah ada');
        }

        $vitamins->update($data);
        return redirect()->back()->with('success', 'Data Vitamin Berhasil DiEdit');
    }

    public function VitaminsDestroy($id)
    {
        $vitamins = Vitamin::findOrFail($id);
        $vitamins->delete();

        return redirect('/vitamins')->with('success', 'Data Vitamin Berhasil Di Hapus');
    }
}
