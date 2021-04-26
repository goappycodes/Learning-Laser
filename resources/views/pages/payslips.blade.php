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
							<h2>Payroll Total - {{count($payrolls)}}</h2>
							@if(Auth::user()->isAdmin())
							<div class="subtitle"><button class="btn btn-primary btn-md"  onclick="window.location='{{ route("add_payrolls") }}'">Add +</button></div>
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
							<th>Salary</th>
                            <th>Net Payable</th>
                            <th>Month</th>
                            <th>Year</th>
							<th>Difference (if any)</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>Employee</th>
							<th>Salary</th>
                            <th>Net Payable</th>
                            <th>Month</th>
                            <th>Year</th>
							<th>Difference (if any)</th>
						</tr>
						</tfoot>
						<tbody>
						@foreach($payrolls as $payroll)
                        <?php
                            $user = \App\User::find($payroll->user_id);
							$joining_date = date("d-m-Y", strtotime($payroll->joining_date));
                        ?>
						<tr>
							<td>{{$user->f_name}} {{$user->l_name}}</td>
							<td>{{$payroll->salary}}</td>
                            <td>{{$payroll->net_payable}}</td>
							<td>{{$months[$payroll->month - 1]}}</td>
                            <td>{{$payroll->year}}</td>
							<td>{{$payroll->difference_any}}</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>
	</div><!--.container-fluid-->
</div><!--.page-content-->
@stop