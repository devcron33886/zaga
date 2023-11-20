<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Scopes\ExpenseScope;

class SaunaExpenseController extends Controller
{
    public function __invoke()
    {
        $expenses = Expense::withoutGlobalScope(ExpenseScope::class)->where('location', '=', 'sauna')->paginate(25);

        $total = Expense::withoutGlobalScope(ExpenseScope::class)->where('location', '=', 'sauna')->sum('total');

        return view('expenses.sauna.index', ['expenses' => $expenses, 'total' => $total]);
    }
}
