<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
      <div id="sidebar-menu" class="sidebar-menu">
          <ul>
              <li class="">
                  <a href="{{ route('dashboard') }}"><i class="la la-dashboard"></i> <span> Dashboard</span></a>
                  <a href="{{ route('apply_leave') }}"><i class="la la-dashboard"></i> <span> Apply leave</span></a>

                </li>
                @if(auth()->user()->is_admin ==1)
                <li><a href="{{url('attendance-list')}}"><i class="la la-edit"></i> <span> Attendance</span></a></li>
                <li><a href="{{url('departments')}}"><i class="la la-files-o"></i> <span> Departments</span></a></li>
                {{-- <li><a href="{{url('designations')}}"><i class="la la-object-ungroup"></i> <span> Designations</span></a></li> --}}
                <li><a href="{{url('all-employees')}}"><i class="la la-user"></i> <span> Employee Details</span></a></li>
                <li><a href="{{url('employee_stats')}}"><i class="la la-users"></i> <span>Employee Ranking</span> </a></li>
                <li><a href="{{url('leaves')}}"><i class="la la-table"></i> <span>Leaves</span> </a></li>
                {{-- <li><a href="{{url('roles')}}"><i class="la la-object-ungroup"></i> <span>Roles</span> </a></li> --}}
                {{-- <li><a href="{{url('permissions')}}"><i class="la la-table"></i> <span>Permission</span> </a></li> --}}
                <li><a href="{{url('posts')}}"><i class="la la-columns"></i> <span>Posts</span> </a></li>

                {{-- <li><a href="{{url('all-users')}}"><i class="la la-user-plus"></i> <span>Users</span> </a></li> --}}
                @endif

            </ul>
      </div>
    </div>
  </div>

