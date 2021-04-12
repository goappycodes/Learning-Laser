@extends('layouts.default')
@section("content")

<div class="page-content">
	<div class="container-fluid">
        <header class="section-header">
            <div class="tbl">
                <div class="tbl-row">
                    <div class="tbl-cell">
                        <h3>Entitlements</h3>
                        <ol class="breadcrumb breadcrumb-simple">
                            <li><a href="/entitlements">Entitlements</a></li>
                            <li class="active">Add Entitlement</li>
                        </ol>
                    </div>
                </div>
            </div>
        </header>
        <div class="box-typical box-typical-padding">
            <form method="post" action="{{url('leave/post-entitlement')}}">
                @csrf
                <input type="hidden" name="id" id="exampleInput" value="{{$entitlement->id}}">
                <div class="form-group row">
                    <div class="col-lg-8">
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Entitlement Name</label>
                            <input type="text" class="form-control" name="leave_name" id="exampleInput" placeholder="Entitlement Name" value="{{$entitlement->leave_name}}">
						</fieldset>
                        <fieldset class="form-group">
                            <label class="form-label" for="date-mask-input">No of Days</label>
                            <input type="number" class="form-control" name="no_of_days" id="exampleInput" value="{{$entitlement->no_of_days}}">
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label" for="date-mask-input">Period</label>
                            <select class="form-control" name="period" id="exampleInput">
                                <option value="">Select</option>
                                <option value="1 Year" @if($entitlement->period == '1 Year') selected @endif>1 Year</option>
                                <option value="6 Months" @if($entitlement->period == '6 Months') selected @endif>6 Months</option>
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label" for="date-mask-input">Starting Month</label>
                            <select class="form-control" name="starting_month" id="exampleInput">
                                <option value="">Select</option>
                                @foreach($months as $month_key => $month)
                                    <option value="{{$month_key + 1}}" @if($entitlement->starting_month == ($month_key + 1)) selected @endif>{{$month}}</option>
                                @endforeach
                            </select>
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