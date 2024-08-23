<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LAAV</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/nav-bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aparelhos/aparelhos-show.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <x-nav-bar/>
    </header>
    <main>
        <div class="card">
            @if($aparelho->image == null)
                <div class="img-placeholder">
                    <i class="fa-solid fa-image"></i>
                </div>
            @else
                <div>
                <img src="{{ asset('/app' . $aparelho->image) }}" />
                </div>
            @endif
            <div class="info">
                <h2>{{ $aparelho->marca . " " . $aparelho->modelo }}</h2>

                <p style="margin-top: 6px">Categoria:</p>
                <span class="span-categoria">{{ $aparelho->categoria }}</span>

                @if($aparelho->desc != null)
                    <div class="desc">
                        <span class="span-desc">Descrição</span>
                        <p>{{ $aparelho->desc }}</p>
                    </div>
                @endif

                @if($aparelho->obs != null)
                    <div class="desc">
                        <span class="span-desc">Observações</span>
                        <p>{{ $aparelho->obs }}</p>
                    </div>
                @endif

                @can('admin')
                    <div style="display: flex; alia">
                        <button class="btn-modal-deletar">Deletar</button>
                    </div>
                @endcan
                
            </div>
        </div>

        @if($aparelho != null)
            <div>
                <dialog id="modal-delete-{{ $aparelho->id }}" class="modal-delete">
                    <h3>Excluir aparelho</h3>
                    <p>Tem certeza que deseja excluir o aparelho registrado do sistema?</p>
                    <div style="display: flex; gap: 8px">
                        <form action="{{ route('aparelhos.destroy', $aparelho->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn-modal-deletar" type="submit">Deletar</button>
                        </form>
                        <button class="btn-cancel-delete">Cancelar</button>
                    </div>
                </dialog>
            </div>
        @endif
        

        <script src="{{ asset('js/aparelhos/modal-delete.js') }}"></script>
        
    </main>
    
</body>
</html>