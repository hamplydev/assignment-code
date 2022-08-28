<div class="row">

    <div class="col-md-4">        
        <div class="form-group">
            <label for="code" class="control-label" style="line-height:20px;">Employee Code</label>
            <div class="controls">
                <input type="text" class="form-control" id="code" name="code" placeholder="Employee Code" value="{{ isset($employee) ? $employee->code : '' }}">
            </div>
        </div>

        <div class="form-group">
            <label for="first_name" class="control-label" style="line-height:20px;">First Name</label>
            <div class="controls">
                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name"  value="{{ isset($employee) ? $employee->first_name : '' }}" required="required">
            </div>
        </div>

        <div class="form-group">
            <label for="last_name" class="control-label" style="line-height:20px;">Last Name</label>
            <div class="controls">
                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name"  value="{{ isset($employee) ? $employee->last_name : '' }}" required>
            </div>
        </div>
        



        <div class="form-group">
            <label for="gender" class="control-label" style="line-height:20px; margin-bottom:20px;">Gender</label>
            <div class="controls">
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="gender" value="0" 
                @if(!isset($employee))
                    checked 
                @else 
                    {{ (isset($employee) && $employee->gender ==0)? 'checked' : '' }}
                @endif > Female
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="gender" value="1" {{ (isset($employee) && $employee->gender ==1)? 'checked' : '' }} >Male
              </label>
            </div>
            </div>
        </div>

        <div class="form-group">
          <label>Date of Birth</label>
            <div class="input-group date" id="date_of_birth" data-target-input="nearest">
                <input type="text" name="date_of_birth" class="form-control datetimepicker-input" data-target="#date_of_birth" value="{{ (isset($employee) && $employee->date_of_birth)? date('d/m/Y',strtotime($employee->date_of_birth)) : '' }}"/>
                <div class="input-group-append" data-target="#date_of_birth" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>



    </div>

    <div class="col-md-4" style="">  

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

        <div class="form-group">
            <label for="position_id" class="control-label" style="line-height:20px;">Postition</label>
            <div class="controls">
                <select name="position_id" id="position_id" class="form-control" required>
                    <option value="0">Choose</option>
                    @if(isset($position))
                        @foreach ($position['data'] as $item)
                        <option value="{{ $item->id }}" @if(isset($employee) && $item->id == $employee->position_id) selected @endif >
                            {{ $item->name }}
                        </option>
                        @endforeach
                    @else
                        <option value=""></option>
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="control-label" style="line-height:20px;">Phone Number</label>
            <div class="controls">
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number"  value="{{ isset($employee) ? $employee->phone : '' }}">
            </div>
        </div>   
        <div class="form-group">
            <label for="email" class="control-label" style="line-height:20px;">E-mail</label>
            <div class="controls">
                <input type="text" id="email" name="email" class="form-control" placeholder="E-mail"  value="{{ isset($employee) ? $employee->email : '' }}" required>
            </div>
        </div>
        <div class="form-group">
            <label for="address" class="control-label" style="line-height:20px;">Address</label>
            <div class="controls">
                <input type="text" id="address" name="address" class="form-control" placeholder="Address"  value="{{ isset($employee) ? $employee->address : '' }}">
            </div>
        </div>
        <!-- <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" name="address" rows="4" placeholder="Address"></textarea>
        </div> -->
    </div>


    <!-- <div class="col-md-4" style="">
        <div class="form-group">
            <label for="v_photo" class="control-label" style="line-height:20px;">Photo</label>
            <div class="control-group">

                <div class="clear"></div>
                <input type="file" id="v_photo" name="v_photo" class="has-preview" />
                <div class="clear"></div>
                <div class="control-group">
                    <label for="del_photo" class="pull-left">Delete Photo</label>
                    <input type="checkbox" class="" name="del_v_photo" id="del_v_photo" />
                    <label  for="del_v_photo" class="form-check-label" for="gridCheck">
                        Delete Photo
                    </label>
                </div>
            </div>
        </div>
    </div> -->


</div>




