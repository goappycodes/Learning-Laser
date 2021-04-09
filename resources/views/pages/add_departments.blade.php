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
                        <h3>Departments</h3>
                        <ol class="breadcrumb breadcrumb-simple">
                            <li><a href="/department">Departments</a></li>
                            <li class="active">Add Department</li>
                        </ol>
                    </div>
                </div>
            </div>
        </header>
        <div class="box-typical box-typical-padding">
            <form method="post" action="{{url('department/post')}}">
                @csrf
                <div class="form-group row">
                    <div class="col-lg-8">
                        <fieldset class="form-group">
                            <label class="form-label semibold" for="date-mask-input">Department Name</label>
                            <input type="text" class="form-control" name="department_name" id="department_name" placeholder="Department Name">
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