<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use App\Models\Employee;
use App\Models\Scopes\ReportScope;

class BarSalaryController extends Controller
{
    public function __invoke()
    {
        $employees = Employee::where('location', '=', 'bar')->simplePaginate(30);
        // Calculate the sum of salaries for each employee
        $employeeSalaries = [];
        foreach ($employees as $employee) {
            $totalSalary = $employee->bars()->withoutGlobalScope(ReportScope::class)->sum('payout');
            $employeeSalaries[$employee->id] = $totalSalary;
        }

        $sortedEmployees = $employees->sortByDesc(function ($employee) use ($employeeSalaries) {
            return $employeeSalaries[$employee->id];
        });

        $total = Bar::withoutGlobalScope(ReportScope::class)->sum('payout');

        return view('salaries.bar.index', ['employees' => $sortedEmployees, 'employeeSalaries' => $employeeSalaries, 'total' => $total]);
    }
}
