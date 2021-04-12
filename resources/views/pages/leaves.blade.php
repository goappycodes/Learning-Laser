@extends('layouts.default')
@section("content")
@section('assets')
    <link rel="stylesheet" href="/css/crude.css?ver=<?php echo date('Y-m-d');?>">
	<script src="/js/leaves.js"></script>
@endsection

<div class="page-content">
	<div class="container-fluid">
    <header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell list-header">
							<h2>Leave Table</h2>
							@if($is_admin == 0)
								<div>
								<h5>Leaves Left</h5>
								<table>
									<?php
										foreach($entitled as $entitle)
										{
											$total_days = $entitle->no_of_days;
											$days_taken = 0;
											foreach($leaves as $leave)
											{
												if($leave->entitled == $entitle->leave_name)
												{
													$days_taken = floatval($days_taken + $leave->duration);
												}
											}
											$days_left = floatval($total_days - $days_taken);
											?>
											<tr>
												<td><strong>{{$entitle->leave_name}} :</strong></td>
												<td>{{$days_left}}</td>
											</tr>
											<?php
										}
									?>
								</table>
								</div>
							@endif
							<div class="subtitle-btn"><button class="btn btn-primary btn-md"  onclick="window.location='{{ route("add_leaves") }}'">Add +</button></div>
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
							<th>Status</th>
							<th>Subject</th>
							<th>Applied On</th>
							<th>Action</th>
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
							<th>Status</th>
							<th>Subject</th>
							<th>Action</th>
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
							<td>@if($leave->status == 0) Pending @elseif($leave->status == 1) Approved @else Rejected @endif</td>
							<td>{{$leave->leave_subject}}</td>
							<td>{{$leave->created_at}}</td>
							<td data-leave-id="{{$leave->id}}" data-remote="{{action('LeaveController@approve_reject_leaves')}}">@if($leave->status == 0) <a class="leave-approve" data-toggle="tooltip" title="Approve"><i class="fa fa-check"></i></a> <a class="leave-reject" data-toggle="tooltip" title="Reject"><i class="fa fa-times"></i></a>@elseif($leave->status == 1) <a class="leave-approve" data-toggle="tooltip" title="Reject"><i class="fa fa-times"></i></a> @else <a class="leave-reject" data-toggle="tooltip" title="Approve"><i class="fa fa-check"></i></a> @endif</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>
	</div><!--.container-fluid-->
</div><!--.page-content-->
@stop