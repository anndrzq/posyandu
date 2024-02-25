<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Child;
use App\Models\Vaccine;
use App\Models\Vitamin;
use App\Models\Weighing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Immunization;

class ServiceController extends Controller
{
    public function WeighingChild()
    {
        $children = Child::with('parent')->get();
        return view('content.dashboard.service.WeighingChild.index', compact('children'));
    }

    public function StoreWeighing(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'child_id' => 'required',
            'weigh_date' => 'required|date',
            'age' => 'required',
            'body_weight' => 'required',
            'height' => 'required',
            'in_accordance' => [
                'required',
                Rule::in(['Y', 'T']),
            ],
            'information' => 'nullable'
        ]);

        Weighing::create($data);

        return redirect('DataWeighing')->with('success', 'Anda Berhasil Mengirimkan Data');
    }

    public function ImmunizationChild()
    {
        $children = Child::with('parent')->get();
        $vaccine = Vaccine::all();
        $vitamins = Vitamin::all();
        return view('content.dashboard.service.immunizationChild.index', compact('children', 'vaccine', 'vitamins'));
    }

    public function ImmunizationStore(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'child_id' => 'required',
            'age' => 'required',
            'immunization_date' => 'date|required',
            'condition' => [
                'required',
                Rule::in(['Y', 'T'])
            ],
            'vaccine_id' => 'nullable',
            'vitamins_id' => 'nullable',
            'information' => 'nullable'
        ]);

        $vaccineId = 'vaccine_id';
        $vitaminsId = 'vitamins_id';

        $vaccine = isset($data[$vaccineId]) && $data[$vaccineId] ? optional(Vaccine::find($data[$vaccineId]))->first() : null;
        $vitamins = isset($data[$vitaminsId]) && $data[$vitaminsId] ? optional(Vitamin::find($data[$vitaminsId]))->first() : null;

        if (($vaccine && $vaccine->stock <= 0) && ($vitamins && $vitamins->stock <= 0)) {
            return redirect()->back()->with('error', 'Stok Vaksin dan Vitamin Habis');
        }

        if ($vaccine && $vaccine->stock <= 0) {
            return redirect()->back()->with('error', 'Stok Vaksin Habis');
        }

        if ($vitamins && $vitamins->stock <= 0) {
            return redirect()->back()->with('error', 'Stok Vitamin Habis');
        }

        if ($vaccine) {
            $vaccine->stock--;
            $vaccine->save();
        }

        if ($vitamins) {
            $vitamins->stock--;
            $vitamins->save();
        }

        Immunization::create($data);

        return redirect('DataImmunization')->with('success', 'Data immunisasi berhasil disimpan');
    }

    public function destroy($id)
    {
        $immunization = Immunization::findOrFail($id);

        if (!$immunization) {
            return redirect()->back()->with('error', 'Data Imunisasi Tidak Ada');
        }

        $vaccine = $immunization->vaccine;
        $vitamins = $immunization->vitamins;

        if ($vaccine) {
            $vaccine->stock++;
            $vaccine->save();
        }

        if ($vitamins) {
            $vitamins->stock++;
            $vitamins->save();
        }
        $immunization->delete();

        return redirect()->back()->with('success', 'Imunisasi Berhasil Di Hapus');
    }

    public function DestroyDataWeighing($id)
    {
        $weighing = Weighing::findOrFail($id);
        $weighing->delete();
        return back()->with('success', 'Berhasil Menghapus Data Penimbangan');
    }

    public function DataImmunizationIndex()
    {
        $immunizations = Immunization::all();
        // dd($immunizations);
        return view('content.dashboard.service.DataImmunization.index', compact('immunizations'));
    }

    public function DataWeighing()
    {
        $weighing = Weighing::all();
        return view('content.dashboard.service.DataWeighing.index', compact('weighing'));
    }
}
