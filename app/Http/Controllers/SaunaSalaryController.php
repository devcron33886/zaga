<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Sauna;
use App\Models\Scopes\SaunaScope;

class SaunaSalaryController extends Controller
{
    public function __invoke()
    {
        $employees = Employee::where('location', '=', 'sauna')->simplePaginate(30);
        // Calculate the sum of salaries for each employee
        $employeeSalaries = [];
        foreach ($employees as $employee) {
            $totalSalary = $employee->saunas()->withoutGlobalScope(SaunaScope::class)->sum('payout');
            $employeeSalaries[$employee->id] = $totalSalary;
        }

        $sortedEmployees = $employees->sortByDesc(function ($employee) use ($employeeSalaries) {
            return $employeeSalaries[$employee->id];
        });

        $total = Sauna::withoutGlobalScope(SaunaScope::class)->sum('payout');

        return view('salaries.bar.index', ['employees' => $sortedEmployees, 'employeeSalaries' => $employeeSalaries, 'total' => $total]);
    }
}
