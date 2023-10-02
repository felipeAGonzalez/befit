<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SalesExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    public function view(): View
    {
        $data = $this->filter;
        $sales = Sale::query();
        $salesDetail = SaleDetail::query();
        $expenses = Expense::query();

        if ($date ?? false) {
            $sales = Sale::whereBetween('sale_date', [$date, now()]);
            $expenses = Expense::whereBetween('date', [$date, now()]);
        }
        $salesTotal= $sales->sum('total');
        $expensesTotal = $expenses->sum('amount');
        // $salesDetails = collect($salesDetail->with('sale')->get())->groupBy('sale_id');
        // $salesDetails = $salesDetail->with('sale')->get())->groupBy('sale_id');
        // $data = json_decode($json, true);
        return view('reports.excel.sales', [
            // 'salesDetails' => json_decode($salesDetails,true),
            'salesDetails' => $salesDetail->get(),
            'Expenses' => $expenses->get(),
            'SalesTotal' => $salesTotal,
            'ExpensesTotal' => $expensesTotal
        ]);
    }
}
