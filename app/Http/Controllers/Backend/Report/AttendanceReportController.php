<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeeAttendance;
use PDF;
use DB;

class AttendanceReportController extends Controller
{
    public function AttendanceReportView(){
        $data['employees'] = User::where('usertype','employee')->get();
        return view('Backend.report.attend_report.attend_report_view',$data);
    }//End Method


    public function AttendanceReportGet(Request $request)
{

    // Build query conditions
    $singleAttendance = EmployeeAttendance::with('user');

    if ($request->filled('employee_id')) {
        $singleAttendance->where('employee_id', $request->employee_id);
    }

    if ($request->filled('date')) {
        $date = date('Y-m', strtotime($request->date));
        $singleAttendance->where('date', 'like', $date . '%');
    }

    // Retrieve data
    $attendances = $singleAttendance->get();

    if ($attendances->isEmpty()) {
        $notification = [
            'message' => 'Sorry, these criteria do not match.',
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($notification);
    }

    // Aggregate data
    $data = [
        'allData' => $attendances,
        'absents' => $attendances->where('attend_status', 'Absent')->count(),
        'leaves' => $attendances->where('attend_status', 'Leave')->count(),
        'month' => date('m-Y', strtotime($request->date))
    ];

    // Generate and return PDF
    $pdf = PDF::loadView('Backend.report.attend_report.attend_report_pdf', $data);
    $pdf->SetProtection(['copy', 'print'], '', 'pass');

    return $pdf->stream('attendance_report.pdf');

    
}//End Method

}
