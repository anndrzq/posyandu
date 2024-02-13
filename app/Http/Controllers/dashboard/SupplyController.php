<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vaccine;

class SupplyController extends Controller
{
    public function ImmunizationIndex()
    {
        $vaccine = Vaccine::all();
        return view('content.dashboard.supply.immunization.index', compact('vaccine'));
    }

    public function ImmunizationStore(Request $request)
    {
        $data = $request->validate([
            'vaccine_name' => 'required',
            'for_age_value' => 'required',
            'for_age_operator' => 'nullable',
            'for_age_unit' => 'required',
            'stock' => 'required'
        ]);

        $existingRecord = Vaccine::where('vaccine_name', $data['vaccine_name'])
            ->where('for_age_value', $data['for_age_value'])
            ->where('for_age_operator', $data['for_age_operator'])
            ->where('for_age_unit', $data['for_age_unit'])
            ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Data Vaksin dengan nilai yang sama sudah ada.');
        }

        Vaccine::create($data);
        return redirect()->back()->with('success', 'Anda Berhasil Menambahkan Data Vaksin');
    }

    public function ImmunizationEdit($id)
    {
        $vaccine = Vaccine::findOrFail($id);
        return $vaccine;
    }

    public function ImmunizationDestroy($id)
    {
        $vaccine = Vaccine::findOrFail($id);
        $vaccine->delete();

        return redirect()->back()->with('success', 'Anda Berhasil Menghapus Data Vacine');
    }
}
