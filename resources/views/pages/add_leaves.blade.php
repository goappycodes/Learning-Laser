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
                        <h3>Leaves</h3>
                        <ol class="breadcrumb breadcrumb-simple">
                            <li><a href="#">Leaves</a></li>
                            <li class="active">Add Leave</li>
                        </ol>
                    </div>
                </div>
            </div>
        </header>
        <div class="box-typical box-typical-padding">
            <form method="post" action="{{url('leave/post')}}">
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
							<label class="form-label semibold" for="exampleInput">Entitlement</label>
							<select class="form-control" name="entitled" id="exampleInput">
                                <option value="">Select</option>
                                @foreach($entitled as $leave)
                                <option value="{{$leave->id}}">{{$leave->leave_name}} ({{$leave->no_of_days}})</option>
                                @endforeach
                            </select>
						</fieldset>
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="date-mask-input">Leave From</label>
                            <input type="text" class="form-control date-mask-input" name="leave_from" id="leave_from">
                            <small class="text-muted">Date format: 00/00/0000</small>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="date-mask-input">Leave To</label>
                            <input type="text" class="form-control date-mask-input" name="leave_to" id="leave_to">
                            <small class="text-muted">Date format: 00/00/0000</small>
                        </fieldset>
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="date-mask-input">Session</label>
                            <select class="form-control" name="session" id="session">
                                <option value="">Select</option>
                                <option value="Full Day">Full Day</option>
                                <option value="1st Half">1st Half</option>
                                <option value="2nd Half">2nd Half</option>
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Duration</label>
							<input type="number" class="form-control" name="duration" id="duration" placeholder="" readonly="readonly">
						</fieldset>
                        <fieldset class="form-group">
							<label class="form-label semibold" for="exampleInput">Subject</label>
							<textarea class="form-control" name="leave_subject" id="exampleInput"></textarea>
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