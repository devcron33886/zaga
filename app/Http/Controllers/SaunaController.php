<?php

namespace App\Http\Controllers;

use App\Models\Sauna;
use App\Models\Scopes\SaunaScope;

class SaunaController extends Controller
{
    public function __invoke()
    {
        $works = Sauna::withoutGlobalScope(SaunaScope::class)->simplePaginate(30);
        $sauna = Sauna::withoutGlobalScope(SaunaScope::class)->sum('sauna');
        $massage = Sauna::withoutGlobalScope(SaunaScope::class)->sum('massage');
        $gym = Sauna::withoutGlobalScope(SaunaScope::class)->sum('gym');
        $bar_and_kitchen = Sauna::withoutGlobalScope(SaunaScope::class)->sum('bar_and_kitchen');
        $percentages = Sauna::withoutGlobalScope(SaunaScope::class)->sum('payout');
        $total = $sauna + $massage + $gym + $bar_and_kitchen;

        return view('reports.sauna.index', compact('works', 'sauna', 'massage', 'gym', 'bar_and_kitchen', 'percentages', 'total'));
    }
}
