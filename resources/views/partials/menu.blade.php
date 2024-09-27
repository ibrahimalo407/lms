<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>

            
            <!-- Request -->
            @can('course_access')
            <li class="nav-item">
                <a href="{{ route('admin.course-requests') }}" class="nav-link {{ request()->is('admin/course-requests') || request()->is('admin/course-requests/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gift"></i>
                    Request
                </a>
            </li>
            @endcan

            <!-- Groups -->
            @can('course_access')
            <li class="nav-item">
                <a href="{{ route('admin.groups.index') }}" class="nav-link {{ request()->is('admin/groups') || request()->is('admin/groups/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gift"></i>
                    Groups
                </a>
            </li>
            @endcan

            <!-- Pedagogical Paths -->
            @can('group_access')
            <li class="nav-item {{ request()->is('admin/pedagogical-paths*') ? 'active' : '' }}">
                <a href="{{ route('admin.pedagogical-paths.index') }}" class="nav-link">
                    <i class="fa fa-book"></i>
                    Pedagogical Paths
                </a>
            </li>
            @endcan

            <!-- Create Meeting -->
            @can('group_access')
            <li class="nav-item">
                <a href="{{ route('admin.meetings.index') }}" class="nav-link {{ request()->is('admin/meetings/create') || request()->is('admin/meetings/create/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-video"></i>
                    Create Meeting
                </a>
            </li>
            @endcan

            <!-- Courses -->
            @can('course_access')
            <li class="nav-item">
                <a href="{{ route('admin.courses.index') }}" class="nav-link {{ request()->is('admin/courses') || request()->is('admin/courses/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gift"></i>
                    Courses
                </a>
            </li>
            @endcan

            <!-- Assignments -->
            @can('course_access')
            <li class="nav-item">
                <a href="{{ route('assignments.index') }}" class="nav-link {{ request()->is('assignments') || request()->is('assignments/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gift"></i>
                    Devoirs / Evaluations
                </a>
            </li>
            @endcan


            <!-- Lessons -->
            @can('lesson_access')
            <li class="nav-item">
                <a href="{{ route('admin.lessons.index') }}" class="nav-link {{ request()->is('admin/lessons') || request()->is('admin/lessons/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    Lessons
                </a>
            </li>
            @endcan

            <!-- Tests -->
            @can('test_access')
            <li class="nav-item">
                <a href="{{ route('admin.tests.index') }}" class="nav-link {{ request()->is('admin/tests') || request()->is('admin/tests/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-pencil-alt"></i>
                    Tests
                </a>
            </li>
            @endcan

            <!-- Questions -->
            @can('question_access')
            <li class="nav-item">
                <a href="{{ route('admin.questions.index') }}" class="nav-link {{ request()->is('admin/questions') || request()->is('admin/questions/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-question-circle"></i>
                    Questions
                </a>
            </li>
            @endcan

            <!-- Question Options -->
            @can('questions_option_access')
            <li class="nav-item">
                <a href="{{ route('admin.question_options.index') }}" class="nav-link {{ request()->is('admin/question_options') || request()->is('admin/question_options/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cogs"></i>
                    Question Options
                </a>
            </li>
            @endcan

            <!-- Users -->
            @can('user_access')
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    Users
                </a>
            </li>
            @endcan

            <!-- Logout -->
            <li class="nav-item">
                <a href="#" onclick="document.getElementById('logout-form').submit()" class="nav-link">
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
