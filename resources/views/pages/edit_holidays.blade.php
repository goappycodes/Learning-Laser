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
                            <li><a href="/holiday">Holidays</a></li>
                            <li class="active">Add Holiday</li>
                        </ol>
                    </div>
                </div>
            </div>
        </header>
        <div class="box-typical box-typical-padding">
            <form method="post" action="{{url('holiday/post')}}">
                @csrf
                <input type="hidden" name="id" id="exampleInput" value="{{$holiday->id}}">
                <div class="form-group row">
                    <div class="col-lg-8">
                        <?php
                            $date_arr = explode('-',$holiday->holiday_date);
                            $holiday_date = $date_arr[2].'/'.$date_arr[1].'/'.$date_arr[0];
                        ?>
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="date-mask-input">Holiday Date</label>
                            <input type="text" class="form-control date-mask-input" name="holiday_date" id="holiday_date"  value="{{$holiday_date}}">
                            <small class="text-muted">Date format: 00/00/0000</small>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="date-mask-input">Holiday Name</label>
                            <input type="text" class="form-control" name="holiday_name" id="holiday_name" placeholder="Holiday Name" value="{{$holiday->holiday_name}}">
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