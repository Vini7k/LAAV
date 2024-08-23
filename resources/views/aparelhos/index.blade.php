<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAAV</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/nav-bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aparelhos/aparelhos.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <x-nav-bar/>
    </header>
    <main>
        @can('admin')
            <div id="link-add-aparelho">
                <a href="{{ route('aparelhos.create') }}" id="add-aparelho">Novo Aparelho</a>
            </div>
        @endcan
        
        <form action="{{ route('aparelhos.index') }}" method="POST">
            @csrf
            <div id="cat-bar">
                <!-- Cat. Áudio -->
                <div class="cat">
                    <button id="cat-audio" class="btn-cat" name="btnCategoria" value="audio">
                        <img src="{{ asset('imagens/icons/equip-cat/microfone.png') }}" class="icon-cat">
                    </button>
                    <span class="cat-span">Áudio</span>
                </div>

                <!-- Cat. Vídeo -->
                <div class="cat">
                    <button id="cat-video" class="btn-cat" name="btnCategoria" value="video">
                        <img src="{{ asset('imagens/icons/equip-cat/projetor.png') }}" class="icon-cat">
                    </button>
                    <span class="cat-span">Vídeo</span>
                </div>

                <!-- Cat. Computadores -->
                <div class="cat">
                    <button id="cat-comp" class="btn-cat" name="btnCategoria" value="computador">
                        <img src="{{ asset('imagens/icons/equip-cat/computador.png') }}" class="icon-cat">
                    </button>
                    <span class="cat-span">Computador</span>
                </div>
                
                <!-- Cat. Todas -->
                <div class="cat">
                    <button id="cat-all" class="btn-cat">
                        <img src="{{ asset('imagens/icons/equip-cat/todas-categorias.png') }}" class="icon-cat">
                    </button>
                    <span class="cat-span">Todas as categorias</span>
                </div>
                
            </div>
        </form>

        <div id="lista-aparelhos">
            @foreach($aparelhos as $aparelho)
                <div class="card-aparelho" id="{{ $aparelho->id }}">
                    <div>
                        @if($aparelho->image == null)
                            <div class="img-placeholder">
                                <i class="fa-solid fa-image"></i>
                            </div>
                        @else
                            <div>
                                <img src="{{ url("storage/{$aparelho->image}") }}" class="imagem">
                            </div>
                        @endif
                    </div>
                    <div class="info">
                        <div class="main-card">
                            <div class="text-info">
                                <p style="font-weight: 700">{{ $aparelho->modelo }}</p>
                                <p>{{ $aparelho->marca }}</p>
                            </div>
                        </div>
                        <div class="status">
                            <span>{{ $aparelho->categoria }}</span>
                        </div>
                    </div>
                </div>
                @if($aparelho != null)
                    <script>
                        var e = document.getElementById({{ $aparelho->id }});
                        e.addEventListener('click', () => {
                            window.location.href = "{{ route('aparelhos.show', $aparelho->id) }}"
                        })
                    </script>
                @endif
            @endforeach
        </div>
    </main>
    <script src="{{ asset('js/aparelhos/card-menu.js') }}"></script>
</body>
</html>