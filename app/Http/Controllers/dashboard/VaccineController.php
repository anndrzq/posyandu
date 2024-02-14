<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Vaccine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VaccineController extends Controller
{
    public function ImmunizationIndex()
    {
        $vaccine = Vaccine::all();
        $vaccine_edit = '';
        return view('content.dashboard.supply.immunization.index', compact('vaccine', 'vaccine_edit'));
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
        $vaccine = Vaccine::find($id);

        if ($vaccine) {
            return view('content.dashboard.supply.immunization.index', [
                'vaccine_edit' => $vaccine,
                'vaccine' => Vaccine::all()
            ]);
        }
    }

    public function ImmunizationUpdate(Request $request, $id)
    {
        $vaccine = Vaccine::findOrFail($id);
        $data = $request->validate([
            'vaccine_name' => 'required',
            'for_age_value' => 'required',
            'for_age_operator' => 'nullable',
            'for_age_unit' => 'required',
            'stock' => 'required|numeric'
        ]);

        $existingRecord = Vaccine::where('vaccine_name', $data['vaccine_name'])
            ->where('for_age_value', $data['for_age_value'])
            ->where('for_age_operator', $data['for_age_operator'])
            ->where('for_age_unit', $data['for_age_unit'])
            ->where('id', '!=', $id)
            ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Data Vaksin dengan nilai yang sama sudah ada.');
        }

        $vaccine->update($data);
        return redirect()->back()->with('success', 'Anda Berhasil Mengubah Data');
    }

    public function ImmunizationDestroy($id)
    {
        $vaccine = Vaccine::findOrFail($id);
        $vaccine->delete();

        return redirect('/immunization')->with('success', 'Anda Berhasil Menghapus Data Vacine');
    }
}
