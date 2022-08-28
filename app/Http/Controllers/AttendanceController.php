<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Position;
use App\Models\Employee;
use App\Models\Attendance;
use DB;
use Excel;
use App\Exports\AttendanceExport;
use App\Exports\AttendanceMonthlyExport;

use Carbon\Carbon;

class AttendanceController extends Controller
{
    //

    private function _formatDate($date){
        if (!$date)
            return null;
        $date = trim($date);
        $temp = explode('/', $date);
        $formatedDate = (isset($temp[2]) ? $temp[2] : '0000') . '-' . (isset($temp[1]) ?
            $temp[1] : '01') . '-' . (isset($temp[0]) ? $temp[0] : '01');
        return $formatedDate;
    }

    public function form(){
        $employees = Employee::all();
        return view('attendance.form', compact('employees'));
    }

    public function checkin(Request $request){

        //date("H:i:s", strtotime($request->input('time_in')));
        $datetime_checkin = $request->input('time_in');
        $regdate = Carbon::createFromFormat('d/m/Y h:i A', $datetime_checkin);
        $checkin_date = Carbon::parse($regdate)->format('Y-m-d');
        $checkin_time = Carbon::parse($regdate)->format('H:i:s');
        $check_type = 0;
        $request->validate([
            'employee_id'=>'required',
        ]);
        $attendance = new Attendance;
        $attendance->employee_id    = $request->input('employee_id');
        $attendance->date           = $checkin_date;
        $attendance->check_time     = $checkin_time;
        $attendance->check_type     = $check_type;
        $result     = $attendance->save();        
        if($result){
            return redirect()->back()->with('success','Data added successfully'); 
        }else{
            return redirect()->back()->with('error','Something wrong! Try again later.'); 
        }
    }

    public function checkout(Request $request){
        //date("H:i:s", strtotime($request->input('time_in')));
        $datetime_checkin = $request->input('time_out');
        $regdate = Carbon::createFromFormat('d/m/Y h:i A', $datetime_checkin);
        $checkout_date = Carbon::parse($regdate)->format('Y-m-d');
        $checkout_time = Carbon::parse($regdate)->format('H:i:s');
        $check_type = 1;
        $request->validate([
            'employee_id'=>'required',
        ]);
        $attendance = new Attendance;
        $attendance->employee_id    = $request->input('employee_id');
        $attendance->date           = $checkout_date;
        $attendance->check_time     = $checkout_time;
        $attendance->check_type     = $check_type;
        $result     = $attendance->save();        
        if($result){
            return redirect()->back()->with('success','Data added successfully'); 
        }else{
            return redirect()->back()->with('error','Something wrong! Try again later.'); 
        }
    }


    public function rptDailyPresents(Request $request){

        // --------- in param -------------------
        $department_id  = $request->department_id;
        $att_date       = $request->from_date;
        $employee_id    = $request->employee_id;

        // change format date
        if($att_date){
            $regdate       = Carbon::createFromFormat('d/m/Y', $att_date);
            $check_date    = Carbon::parse($regdate)->format('Y-m-d');
        }else{
            $check_date = '';
        }
        
          
        // --------- Output Param -------------------
        $department['data'] = Department::orderby("name","asc")
             ->select('id','name')
             ->get();
        $employees = Employee::all();


        $attendances = DB::table('attendances AS a');                 

        if($department_id){
            $attendances = $attendances->where('e.department_id', '=', $department_id);
        }
        if($check_date){
            $attendances = $attendances->where('a.date', '=', $check_date);
        }
        if($employee_id){
            $attendances = $attendances->where('a.employee_id', '=', $employee_id);
        }

        if($department_id && $check_date){
            $attendances = $attendances->where([
                            ['e.department_id', '=', $department_id],
                            ['a.date', '=', $check_date]
                        ]);
        }

        if($department_id && $check_date && $employee_id){
            $attendances = $attendances->where([
                            ['e.department_id', '=', $department_id],
                            ['a.date', '=', $check_date],
                            ['e.employee_id', '=', $employee_id],
                        ]);
        }

        $attendances = $attendances
                    ->join('employees AS e', 'e.id', '=', 'a.employee_id')
                    ->leftJoin('departments AS d', 'e.department_id', '=', 'd.id')
                    ->leftJoin('positions AS p', 'e.position_id', '=', 'p.id')                    
                    ->select('e.code', 'e.first_name', 'e.last_name', 'd.name AS department', 'p.name AS position', 'a.date', 
                            DB::raw(
                            "max(case when check_type = 0 then check_time end) as checkin, 
                            max(case when check_type = 1 then check_time end) as checkout"
                            ))
                    ->groupBy('e.code', 'e.first_name', 'e.last_name', 'd.name', 'p.name', 'a.date')
                    ->get();

        
        // die(var_dump($attendances));
        return view('report.att-dailypresents', compact('attendances'))
                    ->with('department', $department)
                    ->with('employees', $employees);
    }

    public function rptMonthlyPresents(Request $request){
        // --------- in param -------------------
        $department_id  = $request->department_id;
        $att_year       = $request->year;
        $att_month      = $request->month;
        $employee_id    = $request->employee_id;

    
          
        // --------- Output Param -------------------
        $department['data'] = Department::orderby("name","asc")
             ->select('id','name')
             ->get();
        $employees = Employee::all();


        $attendances = DB::table('attendances AS a');                 

        if($department_id){
            $attendances = $attendances->where('e.department_id', '=', $department_id);
        }
        if($employee_id){
            $attendances = $attendances->where('a.employee_id', '=', $employee_id);
        }
        if($att_year && $att_month){
            $attendances = $attendances->whereYear('a.date', $att_year)
                    ->whereMonth('a.date', $att_month);
        }
        if($department_id && $att_year && $att_month){
            $attendances = $attendances->where('e.department_id', '=', $department_id)
                    ->whereYear('a.date', $att_year)
                    ->whereMonth('a.date', $att_month);
        }
        if($department_id && $att_year && $att_month && $employee_id){
            $attendances = $attendances->where('e.department_id', '=', $department_id)
                    ->whereYear('a.date', $att_year)
                    ->whereMonth('a.date', $att_month)
                    ->where('a.employee_id', '=', $employee_id);
        }

        $attendances = $attendances
                    ->join('employees AS e', 'e.id', '=', 'a.employee_id')
                    ->leftJoin('departments AS d', 'e.department_id', '=', 'd.id')
                    ->leftJoin('positions AS p', 'e.position_id', '=', 'p.id')                    
                    ->select('e.code', 'e.first_name', 'e.last_name', 'd.name AS department', 'p.name AS position', 'a.date', 
                            DB::raw(
                            "max(case when check_type = 0 then check_time end) as checkin, 
                            max(case when check_type = 1 then check_time end) as checkout"
                            ))
                    ->groupBy('e.code', 'e.first_name', 'e.last_name', 'd.name', 'p.name', 'a.date')
                    ->get();

        
        // die(var_dump($attendances));
        return view('report.att-monthlypresents', compact('attendances'))
                    ->with('department', $department)
                    ->with('employees', $employees);
    }


    public function attDailyExcel(Request $request){
        $file_name = 'att_daily'.date('Y_m_d_H_i_s').'.xlsx';
        return Excel::download(new AttendanceExport, $file_name);
    }

    public function attDailyCSV(){
        $file_name = 'att_daily'.date('Y_m_d_H_i_s').'.csv';
        return Excel::download(new AttendanceExport, $file_name);
    }

    public function attMonthlyExcel(Request $request){
        $file_name = 'att_monthly'.date('Y_m_d_H_i_s').'.xlsx';
        return Excel::download(new AttendanceMonthlyExport, $file_name);
    }

    public function attMonthlyCSV(){
        $file_name = 'att_monthly'.date('Y_m_d_H_i_s').'.csv';
        return Excel::download(new AttendanceMonthlyExport, $file_name);
    }
}
