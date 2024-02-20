<?php

namespace App\Http\Controllers\dashboard;

use App\Models\User;
use App\Models\Weighing;
use App\Models\Immunization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\family;
use App\Models\Midwife;
use App\Models\Officer;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAdmin = User::countAdmin();
        $totalUser = family::countParent();
        $totalOfficer = Officer::countOfficer();
        $totalMidwife = Midwife::countMidwife();

        $vaccineData = Immunization::whereIn('condition', ['Y', 'T'])->get();
        $groupedData = $vaccineData->groupBy('immunization_date');
        $dailyTotalsY = [];
        $dailyTotalsT = [];

        foreach ($groupedData as $date => $group) {
            $dailyTotalsY[$date] = $group->where('condition', 'Y')->count();
            $dailyTotalsT[$date] = $group->where('condition', 'T')->count();
        }

        $weighing = Weighing::whereIn('in_accordance', ['Y', 'T'])->get();
        $groupedData = $weighing->groupBy('weigh_date');
        $TotalsWeighingY = [];
        $TotalsWeighingT = [];
        foreach ($groupedData as $data => $group) {
            $TotalsWeighingY[$date] = $group->where('in_accordance', 'Y')->count();
            $TotalsWeighingT[$date] = $group->where('in_accordance', 'T')->count();
        }

        // dd($dailyTotals);
        return view('content.dashboard.dashboard', compact('totalAdmin', 'totalUser', 'totalOfficer', 'totalMidwife', 'dailyTotalsY', 'dailyTotalsT', 'TotalsWeighingY', 'TotalsWeighingT'));
    }
}
