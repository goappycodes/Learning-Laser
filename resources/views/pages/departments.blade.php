@extends('layouts.default')
@section("content")
@section('assets')
	<link rel="stylesheet" href="/css/crude.css?ver=@php echo date('Y-m-d');@endphp">
@endsection

<div class="page-content">
	<div class="container-fluid">
    <header class="section-header">
				<div class="tbl list-header">
					<div class="tbl-row">
						<div class="tbl-cell list-header">
							<h2>Department Table</h2>
							<div class="subtitle"><button class="btn btn-primary btn-md"  onclick="window.location='{{ route("add_departments") }}'">Add +</button></div>
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>Departments</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						@foreach($departments as $department)
						<tr>
							<td>{{$department->department_name}}</td>
							<td><a href="/department/edit/{{$department->id}}"><i class="fa fa-pencil"></i></a></td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</section>
	</div><!--.container-fluid-->
</div><!--.page-content-->
@stop