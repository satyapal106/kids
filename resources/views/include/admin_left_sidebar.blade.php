<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{url('admin/dashboard')}}" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>

            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="flaticon-381-notepad"></i>
                    <span class="nav-text">Branch</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{url('admin/all-branch')}}">All Branch</a></li>
                    <li><a href="{{url('admin/new-branch')}}">New Branch</a></li>
                </ul>
            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                <i class="flaticon-381-television"></i>
                    <span class="nav-text">School</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{url('admin/all-school')}}">All School</a></li>

                    <li><a href="{{url('admin/new-school')}}">Add School</a></li>
                </ul>
            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="flaticon-381-internet"></i>
                    <span class="nav-text">Users</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="#">All Teachers</a></li>
                    <li><a href="#">All Students</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="flaticon-381-heart"></i>
                    <span class="nav-text">Types Of Media</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{url('admin/new-media')}}">All Media Type</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <i class="flaticon-381-heart"></i>
                    <span class="nav-text">Reports</span>
                </a>
{{--                <ul aria-expanded="false">--}}
{{--                    <li><a href="{{url('admin/new-media')}}">All Media Type</a></li>--}}
{{--                </ul>--}}
            </li>
        </ul>
    </div>
</div>
