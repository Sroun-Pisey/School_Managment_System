
    @php
        $prefix = Request::route()->getPrefix();
        $route = Route::current()->getName();
    @endphp


    <aside class="main-sidebar">
        <!-- sidebar-->
        <section class="sidebar">

            <div class="user-profile">
                <div class="ulogo">
                    <a href="dashboard">
                    <!-- logo for regular state and mobile devices -->
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ asset('backend/images/LOGO.png') }}" width="40px" alt="">
                            <h5 class="fontadd" style="padding-top: 10px"><b>មជ្ឈមណ្ឌលកុំព្យូទ័រ និង​ ភាសា</b></h5>
                        </div>
                    </a>
                </div>
            </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ ($route == 'dashboard')?'active':'' }}">
            <a href="{{ route('dashboard') }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>
            </li>

        @if (Auth::user()->role =='Admin')
            <li class="treeview {{ ($prefix == '/user')?'active':'' }} ">
                <a href="#">
                    <i class="fa-solid fa-users"></i>
                    <span>គ្រប់គ្រងអ្នកប្រើប្រាស់</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'user.view')?'active':'' }}"><a href="{{ route('user.view') }}"><i class="ti-more"></i>មើលអ្នកប្រើប្រាស់</a></li>

                    <li class="{{ ($route == 'user.add')?'active':'' }}"><a href="{{ route('user.add') }}"><i class="ti-more"></i>បន្ថែមអ្នកប្រើប្រាស់</a></li>
                </ul>
            </li>
        @endif

            <li class="treeview {{ ($prefix == '/setup')?'active':'' }}">
                <a href="#">
                    <i class="fa-solid fa-gear"></i><span>រៀបចំការគ្រប់គ្រង</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                        <li class="{{ ($route == 'student.class.view')?'active':'' }}"><a href="{{ route ('student.class.view') }}"><i class="ti-more"></i>ថ្នាក់រៀន</a></li>

                        <li class="{{ ($route == 'student.year.view')?'active':'' }}"><a href="{{ route ('student.year.view') }}"><i class="ti-more"></i>ឆ្នាំសិក្សា</a></li>

                        <li class="{{ ($route == 'study.time.view')?'active':'' }}"><a href="{{ route ('study.time.view') }}"><i class="ti-more"></i>ម៉ោងសិក្សា</a></li>

                        <li class="{{ ($route == 'fee.category.view')?'active':'' }}"><a href="{{ route ('fee.category.view') }}"><i class="ti-more"></i>ប្រភេទថ្លៃសេវា</a></li><!-- Fee Category -->

                        <li class="{{ ($route == 'fee.amount.view')?'active':'' }}"><a href="{{ route ('fee.amount.view') }}"><i class="ti-more"></i>បង់ថ្លៃសេវា</a></li><!-- Fee Category Amount -->

                        <li class="{{ ($route == 'school.subject.view')?'active':'' }}"><a href="{{ route ('school.subject.view') }}"><i class="ti-more"></i>មុខវិជ្ជាសិក្សារបស់សាលា</a></li><!-- School Subject -->

                        <li class="{{ ($route == 'designation.view')?'active':'' }}"><a href="{{ route ('designation.view') }}"><i class="ti-more"></i>មុខតំណែង</a></li><!-- Designation -->
                </ul>
            </li>


            <li class="treeview {{ ($prefix == '/student')?'active':'' }}">
                <a href="#">
                    <i class="fa-solid fa-people-roof"></i> <span>គ្រប់គ្រងសិស្សចុះឈ្មោះ</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'student.registration.view')?'active':'' }}"><a href="{{ route ('student.registration.view') }}"><i class="ti-more"></i>ការចុះឈ្មោះសិស្ស</a></li>

                    <li class="{{ ($route == 'registration.fee.view')?'active':'' }}"><a href="{{ route ('registration.fee.view') }}"><i class="ti-more"></i>ថ្លៃចុះឈ្មោះ</a></li><!-- -->


                </ul>
            </li>


            <li class="treeview {{ ($prefix == '/employee')?'active':'' }}">
                <a href="#">
                    <i class="fa-solid fa-user-group"></i> <span>ការគ្រប់គ្រងបុគ្គលិក</span><!-- -->
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ ($route == 'employee.registration.view')?'active':'' }}"><a href="{{ route ('employee.registration.view') }}"><i class="ti-more"></i>ការចុះឈ្មោះបុគ្គលិក</a></li><!-- -->

                    <li class="{{ ($route == 'employee.salary.view')?'active':'' }}"><a href="{{ route ('employee.salary.view') }}"><i class="ti-more"></i>ប្រាក់ខែបុគ្គលិក</a></li><!-- -->

                    <li class="{{ ($route == 'employee.leave.view')?'active':'' }}"><a href="{{ route ('employee.leave.view') }}"><i class="ti-more"></i>បុគ្គលិកសម្រាក</a></li><!-- -->

                    <li class="{{ ($route == 'employee.attendance.view')?'active':'' }}"><a href="{{ route ('employee.attendance.view') }}"><i class="ti-more"></i>វត្តមានបុគ្គលិក</a></li><!-- -->

                    <li class="{{ ($route == 'employee.monthly.salary')?'active':'' }}"><a href="{{ route ('employee.monthly.salary') }}"><i class="ti-more"></i>ប្រាក់ប្រចាំខែបុគ្គលិក</a></li><!-- -->

                </ul>
            </li>


            <li class="treeview {{ ($prefix == '/accounts')?'active':'' }}">
                <a href="#">
                    <i class="fa-solid fa-file-invoice-dollar"></i> <span>គ្រប់គ្រងគណនេយ្យ</span><!-- -->
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ ($route == 'student.fee.view')?'active':'' }}"><a href="{{ route ('student.fee.view') }}"><i class="ti-more"></i>ថ្លៃសិក្សា</a></li><!-- -->

                    <li class="{{ ($route == 'account.salary.view')?'active':'' }}"><a href="{{ route ('account.salary.view') }}"><i class="ti-more"></i>ប្រាក់ប្រចាំខែបុគ្គលិក</a></li><!-- -->

                    <li class="{{ ($route == 'other.cost.view')?'active':'' }}"><a href="{{ route ('other.cost.view') }}"><i class="ti-more"></i>ការចំណាយផ្សេងៗ</a></li><!-- -->
                </ul>
            </li>




            <li class="header nav-small-cap">Report Interface</li>

            <li class="treeview {{ ($prefix == '/reports')?'active':'' }}">
                <a href="#">
                    <i class="fa-regular fa-file"></i> <span>គ្រប់គ្រងរបាយការណ៍</span><!-- -->
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ ($route == 'monthly.profit.view')?'active':'' }}"><a href="{{ route ('monthly.profit.view') }}"><i class="ti-more"></i>ប្រាក់ចំំណេញខែ-ឆ្នាំ</a></li>

                    <li class="{{ ($route == 'attendance.report.view')?'active':'' }}"><a href="{{ route('attendance.report.view') }}"><i class="ti-more"></i>វត្តមាន-បុគ្គលិក</a></li><!-- Attendance Report -->
            </li>

        </ul>
        </section>
    </aside>
