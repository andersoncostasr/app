<ul class="menu">
    <li class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }} ">
        <a href="{{ route('dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->is('posts*') ? 'active' : '' }}">
        <a href="{{ route('posts.index') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Posts</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="{{ route('logout') }}" class='sidebar-link'
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-arrow-left-square-fill"></i>
            <span>Sair</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>
