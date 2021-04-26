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
                            <li class="active">Process Payroll</li>
                        </ol>
                    </div>
                </div>
            </div>
        </header>
        <div class="box-typical box-typical-padding">
            <form method="post" action="{{url('payroll/create-post')}}">
                @csrf
                <div class="form-group row">
                    <div class="col-lg-8">
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Month</label>
							<select class="form-control" name="month" id="month">
                                <option value="">Select</option>
                                @foreach($months as $month_key => $month)
                                <option value="{{$month_key}}">{{$month}}</option>
                                @endforeach
                            </select>
						</fieldset>
                        <fieldset class="form-group">
                            <button type="submit" class="btn btn-inline">Process</button>
                        </fieldset>
					</div>
                </div>
            </form>
        </div>
	</div><!--.container-fluid-->
</div><!--.page-content-->
@stop