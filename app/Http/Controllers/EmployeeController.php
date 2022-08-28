<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;

use Excel;
use App\Exports\EmployeeExport;

class EmployeeController extends Controller
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

    public function index()
    {
        // param

        /*$employee = Department::all();
        return view('employee.index', compact('employee'));*/
        $department['data'] = Department::orderby("name","asc")
             ->select('id','name')
             ->get();
        $arr_gender = array(
                  "choose"  => "Choose",
                  "female"  => "Female",
                  "male"    => "Male",
                );

        $employees = Employee::latest()->paginate(5);
        return view('employee.index',compact('employees'))
                ->with('i',(request()->input('page',1)-1)*5)
                ->with('department', $department)
                ->with('arr_gender',$arr_gender);
    }

    public function create(){
       /* $department     = Department::orderBy('name', 'asc')->get();
        $position       = Position::orderBy('name', 'asc')->get();
        return view('employee.create', compact('department','position'));*/

        // fetch departments
        $department['data'] = Department::orderby("name","asc")
             ->select('id','name')
             ->get();
        /*$position['data'] = Position::where("department_id",$emp_id)->orderby("name","asc")
             ->select('id','name')
             ->get();*/
        return view('employee.create')->with("department", $department); //->with("position", $position);
    }

    public function store(Request $request)
    {
        // return ("".$this->_formatDate($request->input('date_of_birth')));
        // return ("".date("H:i:s", strtotime($request->input('working_start_time'))));

        $status = 1;
        $request->validate([
            'first_name'    =>'required',
            'last_name'     =>'required',
            'email'         =>'required',
        ]);
        $employee = new Employee;
        $employee->code             = $request->input('code');
        $employee->first_name       = $request->input('first_name');
        $employee->last_name        = $request->input('last_name');
        $employee->gender           = $request->input('gender');
        $employee->date_of_birth    = $this->_formatDate($request->input('date_of_birth'));
        $employee->ID_card_no       = $request->input('ID_card_no');
        $employee->phone            = $request->input('phone');
        $employee->email            = $request->input('email');
        $employee->address          = $request->input('address');        
        $employee->department_id        = $request->input('department_id');
        $employee->position_id          = $request->input('position_id');
        $employee->joined_date          = $this->_formatDate($request->input('joined_date')); //date("Y-m-d", strtotime($request->input('joined_date')));
        $employee->working_start_time   = date("H:i:s", strtotime($request->input('working_start_time')));
        $employee->working_end_time     = date("H:i:s", strtotime($request->input('working_end_time')));
        $employee->basic_salary         = $request->input('basic_salary');
        $employee->status               = $status;
        $result     = $employee->save();        
        if($result){
            return redirect()->back()->with('success','Data added successfully'); 
        }else{
            return redirect()->back()->with('error','Something wrong! Try again later.'); 
        }
    }
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employee.create', compact('employee'));
    }   
    public function edit($id)
    {
        // $department = Department::orderBy('name', 'asc')->get();
        $employee = Employee::find($id);
        
        if($employee){            
            $department['data'] = Department::orderby("name","asc")
             ->select('id','name')
             ->get();
            $department_id = $employee->department_id;
            $position['data'] = Position::where("department_id",$department_id)->orderby("name","asc")
             ->select('id','name')
             ->get();
        }
        return view('employee.create', compact('employee','department'))->with("position", $position);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'    =>'required',
            'last_name'     =>'required',
            'email'         =>'required',
        ]);
        $employee = Employee::find($id);
        $employee->code             = $request->input('code');
        $employee->first_name       = $request->input('first_name');
        $employee->last_name        = $request->input('last_name');
        $employee->gender           = $request->input('gender');
        $employee->date_of_birth    = $this->_formatDate($request->input('date_of_birth'));
        $employee->ID_card_no       = $request->input('ID_card_no');
        $employee->phone            = $request->input('phone');
        $employee->email            = $request->input('email');
        $employee->address          = $request->input('address');        
        $employee->department_id        = $request->input('department_id');
        $employee->position_id          = $request->input('position_id');
        $employee->joined_date          = $this->_formatDate($request->input('joined_date')); //date("Y-m-d", strtotime($request->input('joined_date')));
        $employee->working_start_time   = date("H:i:s", strtotime($request->input('working_start_time')));
        $employee->working_end_time     = date("H:i:s", strtotime($request->input('working_end_time')));
        $employee->basic_salary         = $request->input('basic_salary');
        // $employee->status               = $status;
        $result     = $employee->update();        
        if($result){
            // return redirect()->back()->with('success','Data updated successfully'); 
            return redirect()->route('employee.index')->with('success','Data updated successfully');
        }else{
            return redirect()->back()->with('error','Something wrong! Try again later.'); 
        }

    } 
    public function destroy($id)
    {
        /*$employee = Employee::find($id);
        $employee->delete();
        return redirect()->back()->with('status','Data deleted successfully.');*/

        $employee = Employee::find($id);
        $employee->delete();
        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }


    public function listSearch(Request $request)
    {
        // --------- in param -------------------
        $emp_code   = $request->code;
        $emp_name   = $request->name;
        $email      = $request->email;
        $gender     = $request->gender;
        $from_date  = $request->from_date;
        $to_date    = $request->to_date;
        $department_id  = $request->department_id;
        $position_id    = $request->position_id;

        // --------- Output Param -------------------
        $department['data'] = Department::orderby("name","asc")
             ->select('id','name')
             ->get();
        $arr_gender = array(
                  "choose"  => "Choose",
                  "female"  => "Female",
                  "male"    => "Male",
                );

        /*$employees = DB::table('employees AS e')
                    ->leftJoin('departments AS d', 'e.department_id', '=', 'd.id')
                    ->leftJoin('positions AS p', 'e.position_id', '=', 'p.id')
                    ->select('e.*', 'd.name AS department', 'p.name AS position')
                    ->get();*/
        $employees = DB::table('employees AS e');                 

        if($emp_code){
            $employees = $employees->where('e.code', 'LIKE', '%'.$emp_code.'%');
            //$employees  = Employee::where('code', 'LIKE', '%'.$emp_code.'%')->get();
        }
        if($emp_name){
            $employees = $employees->where('e.first_name', 'LIKE', '%'.$emp_name.'%')
                    ->orWhere('e.last_name', 'LIKE', '%'.$emp_name.'%')
                    ->orWhere(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%".$emp_name."%");
        }
        if($email){
            $employees = $employees->where('e.email', 'LIKE', '%'.$email.'%');
        }

        if($gender=='female' || $gender=='male'){            
            if($gender=='female'){
                $sex = 0;
            }elseif($gender=='male'){
                $sex = 1;
            }
            $employees = $employees->where('e.gender', '=', $sex);
        }

        if($department_id){
            $employees = $employees->where('e.department_id', '=', $department_id);
        }

        if($position_id){
            $employees = $employees->where('e.position_id', '=', $position_id);
        }

        if($emp_code && $emp_name){
            $employees = $employees->where([
                            ['e.code', 'LIKE', '%'.$emp_code.'%'],
                            ['e.first_name', 'LIKE', '%'.$emp_name.'%']
                        ])
                    ->orWhere([
                            ['e.code', 'LIKE', '%'.$emp_code.'%'],
                            ['e.last_name', 'LIKE', '%'.$emp_name.'%']
                        ])
                    ->orWhere([
                            ['e.code', 'LIKE', '%'.$emp_code.'%'],
                            [DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', '%'.$emp_name.'%']
                        ]);
        }

        if($gender=='female' || $gender=='male' && $department_id && $position_id){
            if($gender=='female'){ $sex = 0; }elseif($gender=='male'){ $sex = 1;}
            $employees = $employees->where([
                            ['e.gender', '=', $gender],
                            ['e.department_id', '=', $department_id],
                            ['e.position_id', '=', $position_id]
                        ]);
        }

        if($department_id && $position_id){
            $employees = $employees->where([
                            ['e.department_id', '=', $department_id],
                            ['e.position_id', '=', $position_id]
                        ]);
        }

        $employees = $employees
                    ->leftJoin('departments AS d', 'e.department_id', '=', 'd.id')
                    ->leftJoin('positions AS p', 'e.position_id', '=', 'p.id')
                    ->select('e.*', 'd.name AS department', 'p.name AS position')
                    ->get();

        
        // die(var_dump($employees));
        return view('employee.index', compact('employees'))
                    ->with('department', $department)
                    ->with('arr_gender',$arr_gender);

    }

    public function exportToExcel(Request $request){
        $file_name = 'employees_'.date('Y_m_d_H_i_s').'.xlsx';
        return Excel::download(new EmployeeExport, $file_name);
    }

    public function exportToCSV(){
        $file_name = 'employees_'.date('Y_m_d_H_i_s').'.csv';
        return Excel::download(new EmployeeExport, $file_name);
    }


    public function getPositionByDept($dep_id=0)
    {
        $positonData['data'] = Position::orderby("name","asc")
            ->select('id','name')
            ->where('department_id',$dep_id)
            ->get();

        return response()->json($positonData);
    }
}
