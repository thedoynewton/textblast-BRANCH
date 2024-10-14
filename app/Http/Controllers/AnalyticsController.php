<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MessageLog;
use App\Models\MessageRecipient;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function getBroadcastedMessagesData(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        // Fetch data from the message_recipient table, applying filters based on date, campus, and recipient type
        $messagesData = MessageRecipient::selectRaw("
            CONVERT(date, created_at) as date, 
            COUNT(CASE WHEN sent_status = 'Sent' THEN 1 END) as success_count,
            COUNT(CASE WHEN sent_status = 'Failed' THEN 1 END) as failed_count
        ")
            ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->when($request->campus, function ($query) use ($request) {
                return $query->where('campus_id', $request->campus); // Filter by campus if selected
            })
            ->when($request->recipient_type === 'students', function ($query) use ($request) {
                return $query->whereNotNull('stud_id') // Filter for students
                    ->when($request->college !== 'all', fn($q) => $q->where('college_id', $request->college))
                    ->when($request->program !== 'all', fn($q) => $q->where('program_id', $request->program))
                    ->when($request->major !== 'all', fn($q) => $q->where('major_id', $request->major))
                    ->when($request->year !== 'all', fn($q) => $q->where('year_id', $request->year));
            })
            ->when($request->recipient_type === 'employees', function ($query) use ($request) {
                return $query->whereNotNull('emp_id') // Filter for employees
                    ->when($request->office !== 'all', fn($q) => $q->where('office_id', $request->office))
                    ->when($request->status !== 'all', fn($q) => $q->where('status_id', $request->status))
                    ->when($request->type !== 'all', fn($q) => $q->where('type_id', $request->type));
            })
            ->groupByRaw('CONVERT(date, created_at)')
            ->orderBy('date')
            ->get();
        // Format data for the chart
        $chartData = [
            'labels' => $messagesData->pluck('date'),
            'success' => $messagesData->pluck('success_count'),
            'failed' => $messagesData->pluck('failed_count')
        ];
        return response()->json($chartData);
    }
}
