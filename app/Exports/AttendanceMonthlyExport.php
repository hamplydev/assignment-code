<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class AttendanceMonthlyExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
       return [
         '#',
         'Code',
         'Employee',
         'Position',
         'Department',
         'Position',
         'Datte',
         'Check In',
         'Check Out'
       ];
    }

    public function collection()
    {
        // return Attendance::all();
        $attendances = DB::table('attendances AS a')
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

        $result = array();
        foreach($attendances as $record){
           $result[] = array(
              'code'            => $record->code,
              'first_name'      => $record->first_name,
              'department_id'   => $record->department,
              'position_id'     => $record->position,
              'date'            => $record->date,
              'checkin'         => $record->checkin,
              'checkout'        => $record->checkout,
           );
        }

        return collect($result);
    }
}
