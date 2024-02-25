<?php

namespace App\Http\Controllers\dashboard;

use App\Models\User;
use App\Models\Child;
use App\Models\family;
use App\Models\Midwife;
use App\Models\Officer;
use App\Models\Weighing;
use App\Models\Immunization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAdmin = User::countAdmin();
        $totalUser = family::countParent();
        $totalOfficer = Officer::countOfficer();
        $totalMidwife = Midwife::countMidwife();
        $totalChild = Child::countChild();

        $vaccineData = Immunization::whereIn('condition', ['Y', 'T'])->get();
        $groupedData = $vaccineData->groupBy('immunization_date');
        $dailyTotalsY = [];
        $dailyTotalsT = [];

        foreach ($groupedData as $date => $group) {
            $dailyTotalsY[$date] = $group->where('condition', 'Y')->count();
            $dailyTotalsT[$date] = $group->where('condition', 'T')->count();
        }

        $weighing = Weighing::whereIn('in_accordance', ['Y', 'T'])->get();
        $groupedWeighingData = $weighing->groupBy('weigh_date');
        $TotalsWeighingY = [];
        $TotalsWeighingT = [];

        foreach ($groupedWeighingData as $date => $group) {
            $TotalsWeighingY[$date] = $group->where('in_accordance', 'Y')->count();
            $TotalsWeighingT[$date] = $group->where('in_accordance', 'T')->count();
        }


        $familyId = Auth::user()->family_id;

        $childData = Child::where('family_id', $familyId)->get();
        $childIds = $childData->pluck('id');
        $weighingData = Weighing::whereIn('child_id', $childIds)->get();

        // dd($childData);
        return view('content.dashboard.dashboard', compact('totalAdmin', 'totalChild', 'totalUser', 'totalOfficer', 'totalMidwife', 'dailyTotalsY', 'dailyTotalsT', 'TotalsWeighingY', 'TotalsWeighingT', 'weighingData', 'childData'));
    }
}
