@extends('layouts.layout')
@section('title', 'Creación de Categorías')
@section('css')
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="text-center text-uppercase">Crear Nueva Categoría</h1>
        </div>
    </div>

    <div class="row m-b-30 m-t-30" style="padding-left:5rem;padding-right:5rem;">
        <div class="col-12">
            <a class="btn btn-warning"
                href="{{route('productos.index')}}">
                Atrás
            </a>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <form action="{{route('categorias.store')}}"
                  method="POST"
                  class="login100-form validate-form"
                  autocomplete="off"
                  id="form_product"
                  accept-charset="UTF-8"
                  style="padding-left:5rem;padding-right:5rem;"
            >
            {{ csrf_field() }}
                @include('categorias.fields')
                
                <div class="row">
                    <div class="col-md-4 col-md-offset-6">
                        <input type="submit" name="Guardar" class="btn btn-success btn-sm">
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2 m-t-10" id="alert">
        @if (\Session::has('success'))
            <div class="alert alert-info">
                <ul>
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;{!! \Session::get('success') !!}
                </ul>
            </div>
        @endif
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function()
        {
            setTimeout(() => {
                $('#alert').hide();
                $('#alert').addClass('ocultar');
            }, 3000);
        });

    </script>
@endsection
