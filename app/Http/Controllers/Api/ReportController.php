<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MeetingReport;
use App\FinanceTransaction;
use App\ActivityReport;

class ReportController extends Controller
{
    // Activity Reports
    public function getActivities() {
        return response()->json(ActivityReport::orderBy('date', 'desc')->get());
    }

    public function storeActivity(Request $request) {
        $data = $request->validate([
            'date' => 'required|date',
            'location' => 'nullable',
            'activity_type' => 'nullable',
            'beneficiaries' => 'nullable',
            'moderator' => 'nullable',
            'presentation_title' => 'nullable',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'summary' => 'nullable',
        ]);

        $activity = ActivityReport::create($data);
        return response()->json(['message' => 'Success', 'data' => $activity]);
    }

    public function deleteActivity($id) {
        ActivityReport::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }

    // Meeting Reports
    public function getMeetings() {
        return response()->json(MeetingReport::orderBy('date', 'desc')->get());
    }

    public function storeMeeting(Request $request) {
        $data = $request->validate([
            'date' => 'required|date',
            'location' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'attendees' => 'nullable',
            'absentees' => 'nullable',
            'agenda' => 'nullable',
            'discussions' => 'nullable',
            'decisions' => 'nullable',
            'next_meeting_date' => 'nullable|date',
        ]);

        $meeting = MeetingReport::create($data);
        return response()->json(['message' => 'Success', 'data' => $meeting]);
    }

    public function deleteMeeting($id) {
        MeetingReport::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }

    // Finance
    public function getFinance(Request $request) {
        $month = $request->month;
        $year = $request->year;

        // Current Month Transactions
        $query = FinanceTransaction::with(['tuteur', 'enfant']);
        if ($month && $year) {
            $query->whereMonth('date', $month)
                  ->whereYear('date', $year);
        }
        $transactions = $query->orderBy('date', 'asc')->get();

        // Calculate Previous Balance (Carry-over from all time before this month)
        $previous_balance = 0;
        if ($month && $year) {
            $firstDayOfMonth = "$year-$month-01";
            $prev_income = FinanceTransaction::where('date', '<', $firstDayOfMonth)->where('type', 'income')->sum('amount');
            $prev_expense = FinanceTransaction::where('date', '<', $firstDayOfMonth)->where('type', 'expense')->sum('amount');
            $previous_balance = $prev_income - $prev_expense;
        }

        $total_income = $transactions->where('type', 'income')->sum('amount');
        $total_expense = $transactions->where('type', 'expense')->sum('amount');

        return response()->json([
            'transactions' => $transactions,
            'total_income' => $total_income,
            'total_expense' => $total_expense,
            'previous_balance' => $previous_balance,
            'balance' => $previous_balance + $total_income - $total_expense
        ]);
    }

    public function storeTransaction(Request $request) {
        $data = $request->validate([
            'type' => 'required|in:income,expense',
            'category' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable',
            'tuteur_id' => 'nullable|exists:tuteurs,id',
            'enfant_id' => 'nullable|exists:enfants,id',
        ]);

        $transaction = FinanceTransaction::create($data);
        return response()->json(['message' => 'Success', 'data' => $transaction]);
    }

    public function updateTransaction(Request $request, $id) {
        $data = $request->validate([
            'type' => 'required|in:income,expense',
            'category' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable',
        ]);

        $transaction = FinanceTransaction::findOrFail($id);
        $transaction->update($data);
        return response()->json(['message' => 'Updated', 'data' => $transaction]);
    }

    public function deleteTransaction($id) {
        FinanceTransaction::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }

    // Finance Categories
    public function getCategories() {
        return response()->json(\App\FinanceCategory::all());
    }

    public function storeCategory(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required|in:income,expense'
        ]);
        $cat = \App\FinanceCategory::create($data);
        return response()->json($cat);
    }

    public function deleteCategory($id) {
        \App\FinanceCategory::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
