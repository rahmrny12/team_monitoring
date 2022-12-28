<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-light sidebar sidebar-primary accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <img src="{{ asset('assets/images/logo_hubstaff.svg') }}" class="img-fluid p-4 pl-0" alt="logo_hubstaff">
    </a>

    <li class="nav-item my-3 @if ($title == 'Dashboard') active @endif">
        <a class="nav-link py-0" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item my-3 @if ($title == 'Project Management') active @endif">
        <a class="nav-link py-0 collapsed" href="#" data-toggle="collapse" data-target="#projectNav"
            aria-expanded="true" aria-controls="projectNav">
            <i class="fas fa-fw fa-square-check"></i>
            <span>Project Management</span>
        </a>
        <div id="projectNav" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-none collapse-inner rounded">
                <a class="collapse-item" href="{{ route('projects.index') }}">Projects</a>
                <a class="collapse-item" href="{{ route('members') }}">Members</a>
                <a class="collapse-item" href="{{ route('projects.index') }}">To-dos</a>
            </div>
        </div>
    </li>

    <li class="nav-item my-3 @if ($title == 'Report') active @endif">
        <a class="nav-link py-0 collapsed" href="#" data-toggle="collapse" data-target="#reportNav"
            aria-expanded="true" aria-controls="reportNav">
            <i class="fas fa-fw fa-file-lines"></i>
            <span>Report</span>
        </a>
        <div id="reportNav" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-none collapse-inner rounded">
                <a class="collapse-item" href="{{ route('projects.index') }}">All Report</a>
                <a class="collapse-item" href="{{ route('projects.index') }}">Time & activity</a>
            </div>
        </div>
    </li>

</ul>
<!-- End of Sidebar -->
