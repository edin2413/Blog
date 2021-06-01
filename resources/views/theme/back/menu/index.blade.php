@extends('theme.back.app')
@section('titulo')
    Menu
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/back/extra-libs/nestable/jquery.nestable.css')}}">
@endsection

@section('scriptPlugins')
<script src="{{asset('assets/back/extra-libs/nestable/jquery.nestable.js')}}" type="text/javascrript"></script>
@endsection

@section('scripts')
    <script src="{{asset('assets/back/js/pages/scripts/menu/index.js')}}" type="text/javascript"></script>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-md-12">
            @if ($mensaje = session("mensaje"))
                <x-alert tipo="success" :mensaje="$mensaje" />
            @endif
            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="text-white float-left">Menús</h5>
                    <a href="{{route('menu.crear')}}" class="btn btn-outline-light btn-sm float-right">Crear</a>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="dd" id="nestable">
                        <ol class="dd-list">
                            @foreach ($menu as $key => $item)
                                @if ($item["menu_id"] != 0)
                                    @break
                                @endif
                                @include('theme.back.menu.menu-item', ['item' => $item])
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="confirmar-eliminar">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirme est acción</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>¿Seguro desea eliminar este Menu? Recuerde que si es un menu padre también se eliminarán los hijo</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger">Si</button>
            </div>
          </div>
        </div>
      </div>

@endsection
<script>
    $('#confirmar-eliminar').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
      })
</script>
