@extends('layouts.default')
@section("content")
@section('assets')
    <link rel="stylesheet" href="/css/separate/vendor/select2.min.css?ver=<?php echo date('Y-m-d');?>">
    <script src="/js/lib/select2/select2.full.min.js"></script>
    <script src="/js/employees.js"></script>
@endsection
<div class="page-content">
	<div class="container-fluid">
        <header class="section-header">
            <div class="tbl">
                <div class="tbl-row">
                    <div class="tbl-cell">
                        <h3>Employees</h3>
                        <ol class="breadcrumb breadcrumb-simple">
                            <li><a href="/employee">Employees</a></li>
                            <li class="active">Edit Employee</li>
                        </ol>
                    </div>
                </div>
            </div>
        </header>
        <div class="box-typical box-typical-padding">
            <form method="post" action="{{url('employee/emp-post')}}">
                @csrf
                <input type="hidden" name="id" id="exampleInput" value="{{$user->id}}">
                <div class="form-group row">
                    <div class="col-lg-8">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">First Name</label>
							<input type="text" class="form-control" name="f_name" id="exampleInput" placeholder="First Name" value="{{$user->f_name}}">
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Last Name</label>
							<input type="text" class="form-control" name="l_name" id="exampleInput" placeholder="Last Name" value="{{$user->l_name}}">
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Email</label>
							<input type="text" class="form-control" name="email" id="exampleInput" placeholder="Email" value="{{$user->email}}">
							<small class="text-muted">We'll never share your email with anyone else.</small>
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Employee ID</label>
							<input type="text" class="form-control" name="employee_id" id="exampleInput" placeholder="Employee ID" value="{{$user->employee_id}}">
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Role</label>
                            <select class="form-control" name="role_id" id="exampleInput">
                                <option value="">Select</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}" @if($role->id == $user->role_id) selected @endif>{{$role->role_name}}</option>
                                @endforeach
                            </select>
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Department</label>
                            <select class="form-control" name="department_id" id="exampleInput">
                                <option value="">Select</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}" @if($department->id == $user->department_id) selected @endif>{{$department->department_name}}</option>
                                @endforeach
                            </select>
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Designation</label>
                            <select class="form-control" name="designation_id" id="exampleInput">
                                <option value="">Select</option>
                                @foreach($designations as $designation)
                                <option value="{{$designation->id}}" @if($designation->id == $user->designation_id) selected @endif>{{$designation->designation_name}}</option>
                                @endforeach
                            </select>
						</fieldset>
                        @php
                            $leaves_entitled = json_decode($user->entitlements, true);
                            if (!$leaves_entitled)
                                $leaves_entitled = array();
                        @endphp
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Leaves Entitlement</label>
                            <select class="form-control select2" multiple="multiple" name="entitlements[]" id="exampleInput">
                                @foreach($entitlements as $entitlement)
                                <option value="{{$entitlement->id}}" @if(in_array($entitlement->id, $leaves_entitled)) selected @endif>{{$entitlement->leave_name}}</option>
                                @endforeach
                            </select>
						</fieldset>
		                @php
                            $date_arr = explode('-',$user->joining_date);
                            $joining_date = $date_arr[2].'/'.$date_arr[1].'/'.$date_arr[0];
                        @endphp
                        <fieldset class="form-group">
                            <label class="form-label" for="date-mask-input">Joining Date</label>
                            <input type="text" class="form-control date-mask-input" name="joining_date" id="" value="{{$joining_date}}">
                            <small class="text-muted">Date format: 00/00/0000</small>
                        </fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Gender</label>
                            <select class="form-control" name="gender" id="exampleInput">
                                <option value="">Select</option>
                                <option value="1" @if($user->gender == 1) selected @endif>Male</option>
                                <option value="2" @if($user->gender == 2) selected @endif>Female</option>
                            </select>
						</fieldset>
                        <?php
                            $date_arr = explode('-',$user->dob);
                            $dob = $date_arr[2].'/'.$date_arr[1].'/'.$date_arr[0];
                        ?>
                        <fieldset class="form-group">
                            <label class="form-label" for="date-mask-input">Date Of Birth</label>
                            <input type="text" class="form-control date-mask-input" name="dob" id="" value="{{$dob}}">
                            <small class="text-muted">Date format: 00/00/0000</small>
                        </fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Phone Number</label>
							<input type="text" class="form-control" name="ph_no" id="exampleInput" placeholder="Phone Number" value="{{$user->ph_no}}">
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Local Address</label>
							<textarea class="form-control" name="local_address" id="exampleInput">{{$user->local_address}}</textarea>
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Permanent Address</label>
							<textarea class="form-control" name="permanent_address" id="exampleInput">{{$user->permanent_address}}</textarea>
						</fieldset>
                        <fieldset class="form-group">
                            <button type="submit" class="btn btn-inline">Submit</button>
                        </fieldset>
					</div>
                </div>
            </form>
        </div>
	</div><!--.container-fluid-->
</div><!--.page-content-->
@stop