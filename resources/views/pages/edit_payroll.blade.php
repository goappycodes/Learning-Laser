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
                        <h3>Payrolls</h3>
                        <ol class="breadcrumb breadcrumb-simple">
                            <li><a href="/payroll">Payrolls</a></li>
                            <li class="active">Edit Payroll</li>
                        </ol>
                    </div>
                </div>
            </div>
        </header>
        <div class="box-typical box-typical-padding">
            <form method="post" action="{{url('payroll/post')}}">
                @csrf
                <input type="hidden" name="id" id="exampleInput" value="{{$payroll->id}}">
                <div class="form-group row">
                    <div class="col-lg-8">
						<fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Employee</label>
							<select class="form-control" name="user_id" id="exampleInput">
                                <option value="">Select</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}" @if($payroll->user_id == $user->id) selected @endif>{{$user->f_name}} {{$user->l_name}}</option>
                                @endforeach
                            </select>
						</fieldset>
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="date-mask-input">Salary</label>
                            <input type="number" class="form-control" name="salary" id="salary" value="{{$payroll->salary}}">
                        </fieldset>
                        <fieldset class="form-group">
                        <label class="form-label semibold" for="date-mask-input">Payment Method</label>
                            <input type="text" class="form-control" name="payment_method" id="payment_method" value="{{$payroll->payment_method}}">
                        </fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Month</label>
							<select class="form-control" name="month" id="month">
                                <option value="">Select</option>
                                @foreach($months as $month_key => $month)
                                <option value="{{$month_key + 1}}" @if($payroll->month == ($month_key + 1)) selected @endif>{{$month}}</option>
                                @endforeach
                            </select>
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Note</label>
							<textarea class="form-control" name="note" id="exampleInput">{{$payroll->note}}</textarea>
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