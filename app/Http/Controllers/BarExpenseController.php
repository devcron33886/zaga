<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Scopes\ExpenseScope;

class BarExpenseController extends Controller
{
    public function __invoke()
    {
        $expenses = Expense::where('location', '=', 'bar')->withoutGlobalScope(ExpenseScope::class)->paginate(25);

        $total = Expense::where('location', '=', 'bar')->withoutGlobalScope(ExpenseScope::class)->sum('total');

        return view('expenses.bar.index', ['expenses' => $expenses, 'total' => $total]);
    }
}
