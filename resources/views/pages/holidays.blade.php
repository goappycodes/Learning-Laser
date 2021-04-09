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
							<h2>Holiday Table</h2>
							@if(Auth::user()->isAdmin())
							<div class="subtitle"><button class="btn-primary btn-sm"  onclick="window.location='{{ route("add_holidays") }}'">Add +</button></div>
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
							<th>Date & Day</th>
							<th>Name</th>
							<th>Action</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
                            <th>Date & Day</th>
							<th>Name</th>
							<th>Action</th>
						</tr>
						</tfoot>
						<tbody>
						@foreach($holidays as $holiday)
                        <?php
                            $unixTimestamp = strtotime($holiday->holiday_date);
                            $formatted_date = date("d/m/Y", $unixTimestamp);
                            $day = date("l", $unixTimestamp);
                        ?>
						<tr>
							<td>{{$formatted_date}} {{$day}}</td>
							<td>{{$holiday->holiday_name}}</td>
							<td><a href="/holiday/edit/{{$holiday->id}}"><i class="fa fa-pencil"></i></a></td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>
	</div><!--.container-fluid-->
</div><!--.page-content-->
@stop