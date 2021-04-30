@extends('layouts.default')
@section("content")
@section('assets')
    <script src="/js/leaves.js"></script>
@endsection
<div class="page-content">
	<div class="container-fluid">
        <header class="section-header">
            <div class="tbl">
                <div class="tbl-row">
                    <div class="tbl-cell">
                        <h3>Salaries</h3>
                        <ol class="breadcrumb breadcrumb-simple">
                            <li><a href="/salary">Salaries</a></li>
                            <li class="active">Add Salary</li>
                        </ol>
                    </div>
                </div>
            </div>
        </header>
        <div class="box-typical box-typical-padding">
            <form method="post" action="{{url('salary/post')}}">
                @csrf
                <div class="form-group row">
                    <div class="col-lg-8">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Employee</label>
							<select class="form-control" name="user_id" id="exampleInput">
                                <option value="">Select</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->f_name}} {{$user->l_name}}</option>
                                @endforeach
                            </select>
						</fieldset>
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="date-mask-input">Previous Salary</label>
                            <input type="number" class="form-control" name="previous_salaray" id="previous_salaray" step=".01">
                        </fieldset>
                        <fieldset class="form-group">
                        <label class="form-label semibold" for="date-mask-input">Current Salary</label>
                            <input type="number" class="form-control" name="current_salary" id="current_salary" step=".01">
                        </fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Appraisal Month</label>
							<select class="form-control" name="appraisal_month" id="appraisal_month">
                                <option value="">Select</option>
                                @foreach($months as $month_key => $month)
                                <option value="{{$month_key + 1}}">{{$month}}</option>
                                @endforeach
                            </select>
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Note</label>
							<textarea class="form-control" name="note" id="exampleInput"></textarea>
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