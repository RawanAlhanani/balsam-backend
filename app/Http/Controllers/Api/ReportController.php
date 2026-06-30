<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MeetingReport;
use App\FinanceTransaction;
use App\ActivityReport;
use App\FinanceCategory;
use App\Tuteur;
use App\Enfant;
use Illuminate\Support\Facades\Log;


class ReportController extends Controller
{
    // Activity Reports
    public function getActivities() {
        return response()->json(ActivityReport::orderBy('date', 'desc')->get());
    }

    public function storeActivity(Request $request) {
        try {
            $data = $request->validate([
                'date' => 'required|date|before_or_equal:today',
                'location' => 'nullable|string|max:255',
                'activity_type' => 'nullable|string|max:100',
                'beneficiaries' => 'nullable|string|max:500',
                'moderator' => 'nullable|string|max:255',
                'presentation_title' => 'nullable|string|max:255',
                'start_time' => 'nullable|date_format:H:i',
                'end_time' => 'nullable|date_format:H:i|after:start_time',
                'summary' => 'nullable|string|min:10',
            ]);

            $activity = ActivityReport::create($data);

            Log::info('Activity report created', [
                'report_id' => $activity->id,
                'date' => $activity->date,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'Success', 'data' => $activity]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Activity report validation failed', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating activity report', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error creating activity report.'], 500);
        }
    }

    public function deleteActivity($id) {
        try {
            $activity = ActivityReport::findOrFail($id);
            $activity->delete();

            Log::info('Activity report deleted', [
                'report_id' => $id,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'Deleted']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Activity report not found for deletion', ['id' => $id]);
            return response()->json(['message' => 'Activity report not found.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting activity report', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error deleting activity report.'], 500);
        }
    }

    // Meeting Reports
    public function getMeetings() {
        return response()->json(MeetingReport::orderBy('date', 'desc')->get());
    }

    public function storeMeeting(Request $request) {
        try {
            $data = $request->validate([
                'date' => 'required|date|before_or_equal:today',
                'location' => 'required|string|max:255',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'attendees' => 'nullable|string|max:500',
                'absentees' => 'nullable|string|max:500',
                'agenda' => 'nullable|string|min:10',
                'discussions' => 'nullable|string|min:10',
                'decisions' => 'nullable|string|min:10',
                'next_meeting_date' => 'nullable|date|after:date',
            ]);

            $meeting = MeetingReport::create($data);

            Log::info('Meeting report created', [
                'report_id' => $meeting->id,
                'date' => $meeting->date,
                'location' => $meeting->location,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'Success', 'data' => $meeting]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Meeting report validation failed', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating meeting report', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error creating meeting report.'], 500);
        }
    }

    public function deleteMeeting($id) {
        try {
            $meeting = MeetingReport::findOrFail($id);
            $meeting->delete();

            Log::info('Meeting report deleted', [
                'report_id' => $id,
                'date' => $meeting->date,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'Deleted']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Meeting report not found for deletion', ['id' => $id]);
            return response()->json(['message' => 'Meeting report not found.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting meeting report', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error deleting meeting report.'], 500);
        }
    }

    // Finance
    public function getFinance(Request $request) {
        $month = $request->month;
        $year = $request->year;

        // Current Month Transactions with optimized eager loading
        $query = FinanceTransaction::with(['tuteur:id,id,nom_tuteur,prenom_tuteur,email_tuteur', 'enfant:id,id,nom_enfant,prenom_enfant']);
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
        try {
            $data = $request->validate([
                'type' => 'required|in:income,expense',
                'category' => 'required',
                'amount' => 'required|numeric|min:0',
                'date' => 'required|date|before_or_equal:today',
                'description' => 'nullable|string|max:500',
                'tuteur_id' => 'nullable|exists:tuteurs,id',
                'enfant_id' => 'nullable|exists:enfants,id',
            ]);

            $transaction = FinanceTransaction::create($data);

            Log::info('Finance transaction created', [
                'transaction_id' => $transaction->id,
                'type' => $transaction->type,
                'amount' => $transaction->amount,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'Success', 'data' => $transaction]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Transaction validation failed', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating transaction', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error creating transaction.'], 500);
        }
    }

    public function updateTransaction(Request $request, $id) {
        try {
            $data = $request->validate([
                'type' => 'required|in:income,expense',
                'category' => 'required',
                'amount' => 'required|numeric|min:0',
                'date' => 'required|date|before_or_equal:today',
                'description' => 'nullable|string|max:500',
            ]);

            $transaction = FinanceTransaction::findOrFail($id);
            $transaction->update($data);

            Log::info('Finance transaction updated', [
                'transaction_id' => $id,
                'type' => $transaction->type,
                'amount' => $transaction->amount,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'Updated', 'data' => $transaction]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Transaction not found for update', ['id' => $id]);
            return response()->json(['message' => 'Transaction not found.'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Transaction update validation failed', ['errors' => $e->errors(), 'id' => $id]);
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating transaction', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error updating transaction.'], 500);
        }
    }

    public function deleteTransaction($id) {
        try {
            $transaction = FinanceTransaction::findOrFail($id);
            $transaction->delete();

            Log::info('Finance transaction deleted', [
                'transaction_id' => $id,
                'type' => $transaction->type,
                'amount' => $transaction->amount,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'Deleted']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Transaction not found for deletion', ['id' => $id]);
            return response()->json(['message' => 'Transaction not found.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting transaction', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error deleting transaction.'], 500);
        }
    }

    // Finance Categories
    public function getCategories() {
        return response()->json(\App\FinanceCategory::all());
    }

    public function storeCategory(Request $request) {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255|unique:finance_categories,name',
                'type' => 'required|in:income,expense'
            ]);
            $cat = \App\FinanceCategory::create($data);

            Log::info('Finance category created', [
                'category_id' => $cat->id,
                'name' => $cat->name,
                'type' => $cat->type,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json($cat);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Category creation validation failed', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating category', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error creating category.'], 500);
        }
    }

    public function deleteCategory($id) {
        try {
            $category = \App\FinanceCategory::findOrFail($id);
            $category->delete();

            Log::info('Finance category deleted', [
                'category_id' => $id,
                'name' => $category->name,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'Deleted']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Category not found for deletion', ['id' => $id]);
            return response()->json(['message' => 'Category not found.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting category', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error deleting category.'], 500);
        }
    }


    // ... other methods ...

    public function updateCategory(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|in:income,expense',
            ]);

            $category = FinanceCategory::findOrFail($id);
            $category->name = $request->name;
            $category->type = $request->type;
            $category->save();

            Log::info('Finance category updated', [
                'category_id' => $id,
                'name' => $category->name,
                'type' => $category->type,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return response()->json(['message' => 'Category updated successfully.', 'category' => $category]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Category not found for update', ['id' => $id]);
            return response()->json(['message' => 'Category not found.'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Category update validation failed', ['errors' => $e->errors(), 'id' => $id]);
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating category', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error updating category.'], 500);
        }
    }
}
