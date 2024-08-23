<nav class="navbar">
    <a class="logo" href="dashboard">LAAV</a>
    <ul class="nav-list">
        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Início</a></li>
        <span id="line"></span>
        <li class="nav-item"><a class="nav-link" href="{{ route('agendamentos') }}">Agendamentos</a></li>
        <span id="line"></span>
        <li class="nav-item"><a class="nav-link" href="{{ route('aparelhos.index') }}">Aparelhos</a></li>
        <span id="line"></span>
        <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}"><div>{{ Auth::user()->name }}</div></a></li>
        <span id="line"></span>
    </ul>
    <div class="hamburguer">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
</nav>
