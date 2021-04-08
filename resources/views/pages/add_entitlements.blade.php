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
                            <li><a href="#">Entitlements</a></li>
                            <li class="active">Add Entitlement</li>
                        </ol>
                    </div>
                </div>
            </div>
        </header>
        <div class="box-typical box-typical-padding">
            <form method="post" action="{{url('leave/post-entitlement')}}">
                @csrf
                <div class="form-group row">
                    <div class="col-lg-8">
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Entitlement Name</label>
                            <input type="text" class="form-control" name="leave_name" id="exampleInput" placeholder="Entitlement Name">
						</fieldset>
                        <fieldset class="form-group">
                            <label class="form-label" for="date-mask-input">No of Days</label>
                            <input type="number" class="form-control" name="no_of_days" id="exampleInput">
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label" for="date-mask-input">Period</label>
                            <select class="form-control" name="period" id="exampleInput">
                                <option value="">Select</option>
                                <option value="1 Year">1 Year</option>
                                <option value="6 Months">6 Months</option>
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