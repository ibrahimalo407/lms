<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin.dashbord') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>
            @can('course_access')
            <li class="nav-item">
                <a href="{{ route('admin.course-requests') }}" class="nav-link {{ request()->is('admin/courses') || request()->is('admin/courses/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gift"></i>
                    Request
                </a>
            </li>
            @endcan
            @can('course_access')
            <li class="nav-item">
                <a href="{{ route('admin.groups.index') }}" class="nav-link {{ request()->is('admin/courses') || request()->is('admin/courses/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gift"></i>
                    Groups
                </a>
            </li>
            @endcan
            @can('group_access')
            <li class="nav-item" class="{{ request()->is('admin/pedagogical-paths*') ? 'active' : '' }}">
                <a href="{{ route('admin.pedagogical-paths.index') }}" class="nav-link">
                    <i class="fa fa-book"></i>
                    Pedagogical Paths
                </a>
            </li>            
            @endcan
            @can('group_access')
            <li class="nav-item">
                <a href="{{ route('admin.meetings.store') }}" class="nav-link {{ request()->is('meetings/create') || request()->is('meetings/create/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-video"></i>
                    Create Meeting
                </a>
            </li>            
            @endcan

            {{-- @can('group_access')
                <li><a href="{{ route('admin.groups.index') }}">Groups</a></li>
                <li><a href="{{ route('admin.pedagogical-paths.index') }}">Pedagogical Paths</a></li>
            @endcan --}}
            @can('course_access')
            <li class="nav-item">
                <a href="{{ route('admin.courses.index') }}" class="nav-link {{ request()->is('admin/courses') || request()->is('admin/courses/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gift"></i>
                    Courses
                </a>
            </li>
            @endcan
            @can('course_access')
            <li class="nav-item">
                <a href="{{ route('assignments.index') }}" class="nav-link {{ request()->is('assignments') || request()->is('assignments/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gift"></i>
                    Devoirs / Evalueations
                </a>
            </li>
            @endcan
            @can('course_access')
            <li class="nav-item">
                <a href="{{ route('admin.virtual_classes.index') }}" class="nav-link {{ request()->is('admin/virtual_classes') || request()->is('admin/virtual_classes/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-video"></i>
                    Virtual Classes
                </a>
            </li>            
            @endcan
            {{-- @can('course_access')
            <li class="nav-item">
                <a href="{{ route('classrooms.create') }}" class="nav-link {{ request()->is('admin/virtual_classes') || request()->is('admin/virtual_classes/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-video"></i>
                    Create Classes
                </a>
            </li>            
            @endcan --}}
            @can('lesson_access')
            <li class="nav-item">
                <a href="{{ route('admin.lessons.index') }}" class="nav-link {{ request()->is('admin/lessons') || request()->is('admin/lessons/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    Lessons
                </a>
            </li>
            @endcan
            @can('test_access')
            <li class="nav-item">
                <a href="{{ route('admin.tests.index') }}" class="nav-link {{ request()->is('admin/tests') || request()->is('admin/tests/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-pencil-alt"></i>
                    Tests
                </a>
            </li>
            @endcan
            @can('question_access')
            <li class="nav-item">
                <a href="{{ route('admin.questions.index') }}" class="nav-link {{ request()->is('admin/questions') || request()->is('admin/questions/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-question-circle"></i>
                    Questions
                </a>
            </li>
            @endcan
            @can('questions_option_access')
            <li class="nav-item">
                <a href="{{ route('admin.question_options.index') }}" class="nav-link {{ request()->is('admin/question_options') || request()->is('admin/question_options/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cogs"></i>
                    Question Options
                </a>
            </li>
            @endcan
            @can('user_access')
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    Users
                </a>
            </li>
            @endcan
            <li class="nav-item">
                <a href="#" onclick="getElementById('logout-form').submit()" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt"></i>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="post">
                    @csrf 
                </form>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
