<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseDeletionRecord;

class ExpenseDeletionRecordController extends Controller
{
    public function index()
    {
        $deletionRecords = ExpenseDeletionRecord::paginate(10);
        return view('expense-deletion-records.index', compact('deletionRecords'));
    }

    public function show(ExpenseDeletionRecord $deletionRecord)
    {
        return view('expense-deletion-records.show', compact('deletionRecord'));
    }
}
