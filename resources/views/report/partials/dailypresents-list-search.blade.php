<form action="{{ route('attendance.daily-presents') }}" class="form-horizontal form-search" method="get">


<div class="row" style="">
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="department_id" class="control-label" style="line-height:20px;">Department</label>
            <div class="controls">
                <select name="department_id" id="department_id" class="form-control">
                    <option value>Choose</option>
                    @if(isset($department))
                    @foreach ($department['data'] as $item)
                        <option value="{{ $item->id }}" @if(isset($employee) && $item->id == $employee->department_id) selected @endif >
                            {{ $item->name }}
                        </option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="from_date" class="control-label">Date </label>
            <div class="input-group date" id="from_date" data-target-input="nearest">
                <input type="text" name="from_date" class="form-control datetimepicker-input" data-target="#from_date" value="{{ (isset($employee) && $employee->date_of_birth)? date('d/m/Y',strtotime($employee->date_of_birth)) : '' }}" />
                <div class="input-group-append" data-target="#from_date" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">  
        <div class="form-group">
                  <label>Employee Name</label>
                  <div class="controls">
                  <select class="form-control select2" name="employee_id" style="width: 100%;">
                        <option value>Choose</option>
                        @if(isset($employees))
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->first_name.' '.$employee->last_name }}</option>
                            @endforeach
                        @endif
                  </select>
                </div>
        </div>

    </div>


</div>


<div class="row" style="">
    <div class="col-md-6">
    <div class="control-group">
        <div class="controls">
            <button class="btn btn-info">Search</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
            <a href="{{ route('attendance.att-daily-excel') }}" class="btn btn-success">Excel</a>
            <a href="{{ route('attendance.att-daily-csv') }}" class="btn btn-warning">CSV</a>
        </div>
    </div>
    </div>
</div>


</form>


