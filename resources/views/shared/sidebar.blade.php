<a class="nav-link" href="{{ route('home.mainPage') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
    Panel
</a>

<div class="sb-sidenav-menu-heading">Konto</div>

<nav ckass="sb-sidenav-menu-nested">
    <a class="nav-link" href="{{ route('me.profile') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
        Profil
    </a>

    <a class="nav-link" href="{{ route('me.games.list') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-gamepad"></i></div>
        Moje Gry
    </a>
</nav>
@can('admin-level')
<div class="sb-sidenav-menu-heading">Użytkownicy</div>
<a class="nav-link" href="{{ route('get.users') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
    Użytkownicy
</a>
@endcan

<div class="sb-sidenav-menu-heading">Gry</div>
<a class="nav-link" href="{{ route('games.dashboard') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-gamepad"></i></div>
    Dashboard
</a>
<a class="nav-link" href="{{ route('games.list') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-gamepad"></i></div>
    Lista
</a>
