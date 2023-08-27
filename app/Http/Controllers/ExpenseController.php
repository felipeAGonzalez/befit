<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Models\ExpenseDeletionRecord;


class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::where(['archived' => false])->with('subsidiary', 'user')->paginate(10);
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {

        return view('expenses.form');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'expenses_description' => 'nullable',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);
        $user = Auth::user();
        if ($validator->fails()) {
            return redirect()->route('expenses.create')
                ->withErrors($validator)
                ->withInput();
        }
        $expenses = $request->all();
        $expenses['subsidiary_id'] = $user->subsidiary_id;
        $expenses['shift'] = $user->shift;
        $expenses['user_id'] = $user->id;
        Expense::create($expenses);
        return redirect()->route('expenses.index')->with('success', 'Gasto creado satisfactoriamente');
    }

    public function edit(Expense $expense)
    {
        return view('expenses.form', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $expense->update($request->all());
        return redirect()->route('expenses.index')->with('success', 'Gasto actualizado satisfactoriamente');
    }

    public function delete(Expense $expense)
    {
        return view('expenses.delete', compact('expense'));
    }

    public function destroy(Request $request, Expense $expense)
    {
        $request->validate([
            'reason' => 'required|string',
        ]);

        ExpenseDeletionRecord::create([
            'expense_id' => $expense->id,
            'reason' => $request->input('reason'),
            'user_id' => auth()->user()->id,
        ]);

        $expense->update(['archived' => true]);

        return redirect()->route('expenses.index')->with('success', 'Gasto eliminado exitosamente.');
    }

}
