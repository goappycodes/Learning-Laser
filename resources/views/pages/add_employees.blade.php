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
                            <li><a href="#">Employees</a></li>
                            <li class="active">Add Employee</li>
                        </ol>
                    </div>
                </div>
            </div>
        </header>
        <div class="box-typical box-typical-padding">
            <form method="post" action="{{url('employee/emp-post')}}">
                @csrf
                <div class="form-group row">
                    <div class="col-lg-8">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">First Name</label>
							<input type="text" class="form-control" name="f_name" id="exampleInput" placeholder="First Name">
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Last Name</label>
							<input type="text" class="form-control" name="l_name" id="exampleInput" placeholder="Last Name">
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Email</label>
							<input type="text" class="form-control" name="email" id="exampleInput" placeholder="Email">
							<small class="text-muted">We'll never share your email with anyone else.</small>
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Employee ID</label>
							<input type="text" class="form-control" name="employee_id" id="exampleInput" placeholder="Employee ID">
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Role</label>
                            <select class="form-control" name="role_id" id="exampleInput">
                                <option value="">Select</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->role_name}}</option>
                                @endforeach
                            </select>
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Department</label>
                            <select class="form-control" name="department_id" id="exampleInput">
                                <option value="">Select</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->department_name}}</option>
                                @endforeach
                            </select>
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Designation</label>
                            <select class="form-control" name="designation_id" id="exampleInput">
                                <option value="">Select</option>
                                @foreach($designations as $designation)
                                <option value="{{$designation->id}}">{{$designation->designation_name}}</option>
                                @endforeach
                            </select>
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Leaves Entitlement</label>
                            <select class="form-control select2" multiple="multiple" name="entitlements[]" id="exampleInput">
                                @foreach($entitlements as $entitlement)
                                <option value="{{$entitlement->id}}">{{$entitlement->leave_name}}</option>
                                @endforeach
                            </select>
						</fieldset>
                        <fieldset class="form-group">
                            <label class="form-label" for="date-mask-input">Joining Date</label>
                            <input type="text" class="form-control date-mask-input" name="joining_date" id="">
                            <small class="text-muted">Date format: 00/00/0000</small>
                        </fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Gender</label>
                            <select class="form-control" name="gender" id="exampleInput">
                                <option value="">Select</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
						</fieldset>
                        <fieldset class="form-group">
                            <label class="form-label" for="date-mask-input">Date Of Birth</label>
                            <input type="text" class="form-control date-mask-input" name="dob" id="">
                            <small class="text-muted">Date format: 00/00/0000</small>
                        </fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Phone Number</label>
							<input type="text" class="form-control" name="ph_no" id="exampleInput" placeholder="Phone Number">
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Local Address</label>
							<textarea class="form-control" name="local_address" id="exampleInput"></textarea>
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Permanent Address</label>
							<textarea class="form-control" name="permanent_address" id="exampleInput"></textarea>
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