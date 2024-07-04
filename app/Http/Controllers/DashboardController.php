<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use App\Models\Scopes\ReportScope;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $works = Bar::withoutGlobalScope(ReportScope::class)->simplePaginate(30);
        $bar_total = Bar::withoutGlobalScope(ReportScope::class)->sum('bar_amount');
        $kitchen_total = Bar::withoutGlobalScope(ReportScope::class)->sum('kitchen_amount');
        $chamber_total = Bar::withoutGlobalScope(ReportScope::class)->sum('chamber_amount');
        $bingalo_total = Bar::withoutGlobalScope(ReportScope::class)->sum('bingalo_amount');
        $percentages = Bar::withoutGlobalScope(ReportScope::class)->sum('payout');
        $total = $bar_total + $kitchen_total + $chamber_total + $bingalo_total;

        return view('reports.bar.index', compact('works', 'bar_total', 'kitchen_total', 'chamber_total', 'bingalo_total', 'percentages', 'total'));
    }
}
