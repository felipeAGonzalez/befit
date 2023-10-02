<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Subsidiary;
use App\Models\Expense;


class ReportController extends Controller
{
    public function salesReport(Request $request)
    {
        $date = $request->query('date');

        $sales = Sale::query();
        $expenses = Expense::query();

        if ($date ?? false) {
            $sales = Sale::whereBetween('sale_date', [$date, now()]);
            $expenses = Expense::whereBetween('date', [$date, now()]);
        }
        $salesTotal= $sales->sum('total');
        $expensesTotal = $expenses->sum('amount');

        $sales = $sales->paginate(10);
        $expenses = $expenses->paginate(10);
        return view('reports.sales', compact('sales','expenses','salesTotal','expensesTotal'));
    }
    public function salesExcel(Request $request)
    {
        $date = $request->query('date');
        $today = date('Y-m-d');
        return Excel::download(new SalesExport($date), $today.'SalesReport.xlsx');
    }
    public function subsidiaryReport(Request $request)
    {
        $date = $request->query('date');
        $subsidiaries = Subsidiary::query();

        if ($date ?? false) {
            $subsidiaries = Subsidiary::whereHas('sales', function($query) use ($date){
                $query->whereBetween('sale_date', [$date, now()]);
            });
        }
        $subsidiaries = $subsidiaries->paginate(10);

        return view('reports.subsidiary', compact('subsidiaries'));
    }

    public function reportByShift()
    {
        $salesByShift = Sale::select('shift', \DB::raw('SUM(total) as total_sales'))
            ->groupBy('shift')
            ->get();

            \Log::info($salesByShift);
        return view('reports.shift', compact('salesByShift'));
    }
}
