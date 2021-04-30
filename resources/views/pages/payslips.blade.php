@extends('layouts.default')
@section("content")
@section('assets')
	<link rel="stylesheet" href="/css/crude.css?ver=@php echo date('Y-m-d');@endphp">
	<script src="/js/employees.js"></script>
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
							<th>Bonus (if any)</th>
							<th>Difference (if any)</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>Employee</th>
							<th>Salary</th>
                            <th>Net Payable</th>
                            <th>Month</th>
                            <th>Year</th>
							<th>Bonus (if any)</th>
							<th>Difference (if any)</th>
							<th>Actions</th>
						</tr>
						</tfoot>
						<tbody>
						@foreach($payrolls as $payroll)
                        @php
                            $user = \App\User::find($payroll->user_id);
							$joining_date = date("d-m-Y", strtotime($payroll->joining_date));
						@endphp
						<tr>
							<td>{{$user ? $user->f_name: ""}} {{$user ? $user->l_name: ""}}</td>
							<td>{{$payroll->salary}}</td>
                            <td>{{$payroll->net_payable}}</td>
							<td>{{$months[$payroll->month - 1]}}</td>
                            <td>{{$payroll->year}}</td>
							<td>{{$payroll->bonus_any}}</td>
							<td>{{$payroll->difference_any}}</td>
							<td data-payroll-id="{{$payroll->id}}" ><a class="add_bonus" data-toggle="tooltip" title="Add Bonus"><i class="fa fa-plus"></i></a> &nbsp;&nbsp;<a class="add_difference" data-toggle="tooltip" title="Reduce Amount"><i class="fa fa-minus"></i></a></td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>
	</div><!--.container-fluid-->
</div><!--.page-content-->
<div id="bonus_difference_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Put Amount</h4>
      </div>
      <div class="modal-body">
        <p><input type="number" class="form-control" id="bonus_difference_amount" /></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="bonus_difference_submit" is-bonus="" data-payroll-id="" data-remote="{{action('EmployeeController@add_bonus_differences')}}">Submit</button>
      </div>
    </div>

  </div>
</div>
@stop