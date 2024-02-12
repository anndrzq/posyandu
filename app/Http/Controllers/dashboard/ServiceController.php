<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Child;
use App\Models\ServiceChild;
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
            'age_at_weighing' => 'required',
            'body_weight_at_weighing' => 'required',
            'height_at_weighing' => 'required',
            'in_accordance' => [
                'required',
                Rule::in(['Y', 'T']),
            ],
            'information_at_weighing' => 'nullable'
        ]);

        // Ambil Objek dari ServiceChild
        $serviceChild = ServiceChild::firstOrNew(['child_id' => $data['child_id']]);
        $serviceChild->fill($data);
        $serviceChild->save();

        return redirect('dashboard')->with('success', 'Anda Berhasil Mengirimkan Data');
    }

    public function ImmunizationChild()
    {
        $children = Child::with('parent')->get();
        return view('content.dashboard.service.immunizationChild.index', compact('children'));
    }
}
