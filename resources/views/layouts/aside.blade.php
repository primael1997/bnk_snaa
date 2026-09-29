<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ setActive(['admin.dashboard']) }} ">
            <a href="{{route('admin.dashboard')}}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Tableau de board</span>
            </a>
        </li>

        <li class="sidebar-item {{ setActive(['admin.document.*']) }}">
            <a href="{{route('admin.document.index')}}" class='sidebar-link'>
                <i class="bi bi-file-text"></i>
                <span>Document</span>
            </a>
        </li>

        @if(auth()->user()->role == 'admin')
            <li class="sidebar-item {{ setActive(['admin.user.*']) }}">
                <a href="{{route('admin.user.index')}}" class='sidebar-link'>
                    <i class="bi bi-people"></i>
                    <span>Utilisateurs</span>
                </a>
            </li>
        @endif

        @if(auth()->user()->role == 'admin')
            <li class="sidebar-item {{ setActive(['admin.trash.*']) }}">
                <a href="{{route('admin.trash.index')}}" class='sidebar-link'>
                    <i class="bi bi-trash"></i>
                    <span>Corbeille</span>
                </a>
            </li>
        @endif

        <li class="sidebar-item {{ setActive(['admin.profile.*']) }}">
            <a href="{{route('admin.profile.edit')}}" class='sidebar-link'>
                <i class="bi bi-person-badge-fill"></i>
                <span>Profil</span>
            </a>
        </li>


        <li class="sidebar-item  ">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{route('logout')}}" onclick="event.preventDefault();
                this.closest('form').submit();" class='sidebar-link'>
                <i class="bi bi-box-arrow-right"></i>
                <span>Déconnexion</span>
            </a>
        </form>
        </li>
    </ul>
</div>
