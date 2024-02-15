<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Child;
use App\Models\Vaccine;
use App\Models\Vitamin;
use App\Models\Weighing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

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

        // Ambil Objek dari ServiceChild
        $serviceChild = Weighing::firstOrNew(['child_id' => $data['child_id']]);
        $serviceChild->fill($data);
        $serviceChild->save();

        return redirect('dashboard')->with('success', 'Anda Berhasil Mengirimkan Data');
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
            'child_id' => 'required',
            'age' => 'required',
            'immunization_date' => 'date|required',
            'condition' => [
                'required',
                Rule::in(['Y', 'T'])
            ],
            'vaccine_id' => 'required',
            'vitamins_id' => 'required',
            'information' => 'nullable'
        ]);
    }
}
