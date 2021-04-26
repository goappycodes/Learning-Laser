<div class="mobile-menu-left-overlay"></div>
<nav class="side-menu">
    <ul class="side-menu-list">
        <!-- <li class="gold">
            <a href="#">
                <i class="font-icon font-icon-speed"></i>
                <span class="lbl">Performance</span>
            </a>
        </li> -->
        @if(Auth::user()->isAdmin())
        <li class="pink-red  with-sub {{ (request()->segment(1) == 'employee' || request()->segment(1) == 'role' || request()->segment(1) == 'designation' || request()->segment(1) == 'department') ? 'opened' : '' }}">
            <span>
                <i class="font-icon font-icon-user"></i>
                <span class="lbl">Employees</span>
            </span>
            <ul>
                <li><a href="/employee"><span class="lbl">List</span></a></li>
                <li><a href="/employee/add"><span class="lbl">Add</span></a></li>
                <li><a href="/role"><span class="lbl">Roles</span></a></li>
                <li><a href="/role/add"><span class="lbl">Add Role</span></a></li>
                <li><a href="/designation"><span class="lbl">Designations</span></a></li>
                <li><a href="/designation/add"><span class="lbl">Add Designation</span></a></li>
                <li><a href="/department"><span class="lbl">Departments</span></a></li>
                <li><a href="/department/add"><span class="lbl">Add Department</span></a></li>
            </ul>
        </li>
        @endif
        <li class="red with-sub {{ (request()->segment(1) == 'holiday') ? 'opened' : '' }}">
            <span class="label-right">
                <i class="font-icon font-icon-contacts"></i>
                <span class="lbl">Holidays</span>
                <!-- <span class="label label-custom label-pill label-danger">35</span> -->
            </span>
            <ul>
                <li><a href="/holiday"><span class="lbl">List</span></a></li>
                @if(Auth::user()->isAdmin())
                <li><a href="/holiday/add"><span class="lbl">Add</span></a></li>
                @endif
            </ul>
        </li>
        <li class="magenta with-sub {{ (request()->segment(1) == 'leave') ? 'opened' : '' }}">
            <span>
                <i class="font-icon font-icon-calend"></i>
                <span class="lbl">Leave</span>
            </span>
            <ul>
                <li><a href="/leave"><span class="lbl">List</span></a></li>
                <li><a href="/leave/add"><span class="lbl">Add</span></a></li>
                <li><a href="/leave/entitlement"><span class="lbl">Entitlement</span></a></li>
                @if(Auth::user()->isAdmin())
                <li><a href="/leave/add-entitlement"><span class="lbl">Add Entitlement</span></a></li>
                @endif
            </ul>
        </li>
        <li class="blue-dirty with-sub {{ (request()->segment(1) == 'salary') ? 'opened' : '' }}">
            <span>
                <i class="font-icon font-icon-notebook"></i>
                <span class="lbl">Salary</span>
            </span>
            <ul>
                <li><a href="/salary"><span class="lbl">List</span></a></li>
                @if(Auth::user()->isAdmin())
                <li><a href="/salary/add"><span class="lbl">Add</span></a></li>
                @endif
            </ul>
        </li>
        <li class="grey with-sub {{ (request()->segment(1) == 'payroll') ? 'opened' : '' }}">
            <span>
            <i class="fa fa-university"></i>
                <span class="lbl">Payroll</span>
            </span>
            <ul>
                <li><a href="/payroll"><span class="lbl">Payroll</span></a></li>
                @if(Auth::user()->isAdmin())
                <li><a href="/payroll/add"><span class="lbl">Process</span></a></li>
                @endif
            </ul>
        </li>
    </ul>
</nav>