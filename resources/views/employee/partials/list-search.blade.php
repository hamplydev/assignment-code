<form action="{{ route('employee.list-search') }}" class="form-horizontal form-search" method="get">


<div class="row" style="">
    <div class="col-md-3">
        <div class="form-group">
            <label for="code" class="control-label">Employee Code </label>
            <input type="text" id="code" name="code" class="date form-control" placeholder=""  value=""  />
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="email" class="control-label">Email </label>
            <input type="text" id="email" name="email" class="date form-control" placeholder=""  value=""  />
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="from_date" class="control-label">From Date </label>
            <div class="input-group date" id="from_date" data-target-input="nearest">
                <input type="text" name="from_date" class="form-control datetimepicker-input" data-target="#from_date" value="{{ (isset($employee) && $employee->date_of_birth)? date('d/m/Y',strtotime($employee->date_of_birth)) : '' }}" />
                <div class="input-group-append" data-target="#from_date" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- <div class="col-md-3">
        <div class="form-group">
            <label for="category" class="control-label">Department </label>
            <div class="controls">
                <select name="category" id="category" class="form-control">
                    <option value>Choose</option>
                        <option value="" ></option>
                </select>
            </div>
        </div>
    </div> -->
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

</div>

<div class="row" style="">
    <div class="col-md-3">
        <div class="form-group">
            <label for="name" class="control-label">Employee Name </label>
            <input type="text" id="name" name="name" class="date form-control" placeholder=""  value=""  />
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="gender" class="control-label">Gender </label>
            <div class="controls">
                <select name="gender" id="gender" class="form-control">
                    @if(isset($arr_gender))
                    @foreach ($arr_gender as $key=>$value)
                    <!-- <option value>Choose</option> -->
                    <option value="{{ $key }}" >{{ $value }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="to_date" class="control-label">To Date </label>
            <div class="input-group date" id="to_date" data-target-input="nearest">
                <input type="text" name="to_date" class="form-control datetimepicker-input" data-target="#to_date" value="{{ (isset($employee) && $employee->date_of_birth)? date('d/m/Y',strtotime($employee->date_of_birth)) : '' }}" />
                <div class="input-group-append" data-target="#to_date" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="col-md-3">
        <div class="form-group">
            <label for="position_id" class="control-label">Position </label>
            <div class="controls">
                <select name="position_id" id="position_id" class="form-control">
                    <option value>Choose</option>
                        <option value="" ></option>
                </select>
            </div>
        </div>
    </div>

</div>

<div class="row" style="">
    <div class="col-md-6">
    <div class="control-group">
        <div class="controls">
            <button class="btn btn-success">Search</button>
            <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
            <a href="{{ route('employee.index') }}" class="btn btn-secondary">Reset</a>
            <!-- <button type="submit" name="export" value="1" class="btn btn-success">Export</button> -->
            <a href="{{ route('employee.list-export-excel') }}" class="btn btn-info">Excel</a>
            <a href="{{ route('employee.list-export-csv') }}" class="btn btn-warning">CSV</a>
        </div>
    </div>
    </div>
</div>


</form>


