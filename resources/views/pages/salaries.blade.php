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
							<h2>Salary Table</h2>
							@if(Auth::user()->isAdmin())
							<div class="subtitle"><button class="btn-primary btn-sm"  onclick="window.location='{{ route("add_salaries") }}'">Add +</button></div>
							@endif
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>Employee</th>
							<th>Previous Salaray</th>
                            <th>Current Salaray</th>
                            <th>Appraisal Month</th>
                            <th>Note</th>
							<th>Action</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
                            <th>Employee</th>
							<th>Previous Salaray</th>
                            <th>Current Salaray</th>
                            <th>Appraisal Month</th>
                            <th>Note</th>
							<th>Action</th>
						</tr>
						</tfoot>
						<tbody>
						@foreach($salaries as $salary)
						<tr>
							<td>{{$salary->f_name}} {{$salary->l_name}}</td>
							<td>{{$salary->previous_salaray}}</td>
                            <td>{{$salary->current_salary}}</td>
							<td>{{$months[$salary->appraisal_month - 1]}}</td>
                            <td>{{$salary->note}}</td>
							<td><a href="/salary/edit/{{$salary->id}}"><i class="fa fa-pencil"></i></a></td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>
	</div><!--.container-fluid-->
</div><!--.page-content-->
@stop