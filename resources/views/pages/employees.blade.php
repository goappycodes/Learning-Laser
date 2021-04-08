@extends('layouts.default')
@section("content")
@section('assets')
	<link rel="stylesheet" href="/css/crude.css?ver=<?php echo date('Y-m-d');?>">
@endsection

<div class="page-content">
	<div class="container-fluid">
    <header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell list-header">
							<h2>Employee Table</h2>
							<div class="subtitle"><button class="btn-primary btn-sm"  onclick="window.location='{{ route("add_employees") }}'">Add +</button></div>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Emp ID</th>
							<th>Phone</th>
							<th>Gender</th>
							<th>Joining Date</th>
							<th>Department Name</th>
							<th>Role Name</th>
							<th>Designation Name</th>
							<th>DOB</th>
							<th>Address</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Emp ID</th>
							<th>Phone</th>
							<th>Gender</th>
							<th>Joining Date</th>
							<th>Department Name</th>
							<th>Role Name</th>
							<th>Designation Name</th>
							<th>DOB</th>
							<th>Address</th>
						</tr>
						</tfoot>
						<tbody>
						@foreach($users as $user)
						<tr>
							<td>{{$user->f_name}} {{$user->l_name}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->employee_id}}</td>
							<td>{{$user->ph_no}}</td>
							<td>{{$user->gender}}</td>
							<td>{{$user->joining_date}}</td>
							<td>{{$user->department_name}}</td>
							<td>{{$user->role_name}}</td>
							<td>{{$user->designation_name}}</td>
							<td>{{$user->dob}}</td>
							<td>{{$user->local_address}}</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>
	</div><!--.container-fluid-->
</div><!--.page-content-->
@stop