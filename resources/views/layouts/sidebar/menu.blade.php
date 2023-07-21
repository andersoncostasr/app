<ul class="menu">
    <li class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }} ">
        <a href="{{ route('dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->is('categories*') ? 'active' : '' }}">
        <a href="{{ route('categories.index') }}" class='sidebar-link'>
            <i class="bi bi-bookmarks-fill"></i>
            <span>Categorias</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->is('courses*') ? 'active' : '' }}">
        <a href="{{ route('courses.index') }}" class='sidebar-link'>
            <i class="bi bi-person-video3"></i>
            <span>Cursos</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->is('users*') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}" class='sidebar-link'>
            <i class="bi bi-person"></i>
            <span>Usuários</span>
        </a>
    </li>
    <li class="sidebar-item {{ request()->is('webhooks*') ? 'active' : '' }}">
        <a href="{{ route('webhooks.index') }}" class='sidebar-link'>
            <i class="bi bi-gear-fill"></i>
            <span>Webhooks</span>
        </a>
    </li>
    {{-- <li class="sidebar-item {{ request()->is('posts*') ? 'active' : '' }}">
    <a href="{{ route('posts.index') }}" class='sidebar-link'>
        <i class="bi bi-grid-fill"></i>
        <span>Posts</span>
    </a>
    </li> --}}
    <li class="sidebar-item">
        <a href="{{ route('logout') }}" class='sidebar-link' onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-arrow-left-square-fill"></i>
            <span>Sair</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>
