<form action="{{ route('attendance.monthly-presents') }}" class="form-horizontal form-search" method="get">


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
            <label for="year" class="control-label" style="line-height:20px;">Year</label>
            <div class="controls">
                <select name="year" id="year" class="form-control">
                    {{ $last= date('Y')-20 }}
                    {{ $now = date('Y') }}
                    <option value>Choose Year</option>
                        @for ($i = $now; $i >= $last; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor

                </select>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="month" class="control-label" style="line-height:20px;">Month</label>
            <div class="controls">
                <select name="month" id="month" class="form-control">
                    <option value>Choose Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
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
            <a href="{{ route('attendance.att-monthly-excel') }}" class="btn btn-success">Excel</a>
            <a href="{{ route('attendance.att-monthly-csv') }}" class="btn btn-warning">CSV</a>
        </div>
    </div>
    </div>
</div>


</form>


