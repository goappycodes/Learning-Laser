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
							<h2>Leave Table</h2>
							<div class="subtitle-btn"><button class="btn-primary btn-sm"  onclick="window.location='{{ route("add_leaves") }}'">Add +</button></div>
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
							<th>Entitlement</th>
							<th>Leave From</th>
							<th>Leave To</th>
							<th>Duration</th>
							<th>Subject</th>
							<th>Applied On</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Emp ID</th>
							<th>Entitlement</th>
							<th>Leave From</th>
							<th>Leave To</th>
							<th>Duration</th>
							<th>Subject</th>
							<th>Applied On</th>
						</tr>
						</tfoot>
						<tbody>
						@foreach($leaves as $leave)
						<tr>
							<td>{{$leave->f_name}} {{$leave->l_name}}</td>
							<td>{{$leave->email}}</td>
							<td>{{$leave->employee_id}}</td>
							<td>{{$leave->entitled}}</td>
							<td>{{$leave->leave_from}}</td>
							<td>{{$leave->leave_to}}</td>
							<td>{{$leave->duration}} days</td>
							<td>{{$leave->leave_subject}}</td>
							<td>{{$leave->created_at}}</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>
	</div><!--.container-fluid-->
</div><!--.page-content-->
@stop