<nav class="navbar">
        <a class="logo" href="dashboard">LAAV</a>
        <ul class="nav-list">
            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Início</a></li>
            <span id="line"></span>
            @can('admin')
            <li class="nav-item dropdown">
                <a class="nav-link" href="#">Relatórios</a>
                <div class="dropdown-content">
                    <a href="{{ route('relatorios.pagina1') }}">Relatórios</a>
                    <a href="{{ route('relatorios.pagina2') }}">Relatórios</a>
                    <a href="{{ route('relatorios.pagina3') }}">Relatórios</a>
                    <a href="{{ route('relatorios.pagina4') }}">Relatórios</a>
                </div>
            </li>
            <span id="line"></span>
            @endcan
            <li class="nav-item"><a class="nav-link" href="{{ route('agendamentos') }}">Agendamentos</a></li>
            <span id="line"></span>
            <li class="nav-item"><a class="nav-link" href="{{ route('aparelhos.index') }}">Aparelhos</a></li>
            <span id="line"></span>
            <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">
                <div>{{ Auth::user()->name }}</div>
            </a></li>
        </ul>
    </nav>