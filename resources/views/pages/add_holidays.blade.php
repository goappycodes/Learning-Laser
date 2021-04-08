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
                        <h3>Holidays</h3>
                        <ol class="breadcrumb breadcrumb-simple">
                            <li><a href="#">Holidays</a></li>
                            <li class="active">Add Holiday</li>
                        </ol>
                    </div>
                </div>
            </div>
        </header>
        <div class="box-typical box-typical-padding">
            <form method="post" action="{{url('holiday/post')}}">
                @csrf
                <div class="form-group row">
                    <div class="col-lg-8">
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="date-mask-input">Holiday Date</label>
                            <input type="text" class="form-control date-mask-input" name="holiday_date" id="holiday_date">
                            <small class="text-muted">Date format: 00/00/0000</small>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="date-mask-input">Holiday Name</label>
                            <input type="text" class="form-control" name="holiday_name" id="holiday_name" placeholder="Holiday Name">
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