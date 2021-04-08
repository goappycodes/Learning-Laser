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
							<h2>Entitlement Table</h2>
							<div class="subtitle"><button class="btn-primary btn-sm"  onclick="window.location='{{ route("add_entitlement") }}'">Add +</button></div>
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
							<th>No of Days</th>
							<th>Period</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>Name</th>
							<th>No of Days</th>
							<th>Period</th>
						</tr>
						</tfoot>
						<tbody>
						@foreach($entitlements as $entitlement)
						<tr>
							<td>{{$entitlement->leave_name}}</td>
							<td>{{$entitlement->no_of_days}}</td>
							<td>{{$entitlement->period}}</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>
	</div><!--.container-fluid-->
</div><!--.page-content-->
@stop