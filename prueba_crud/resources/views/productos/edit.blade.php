@extends('layouts.layout')
@section('title', 'Editar Producto')
@section('css')
@stop
@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h1 class="text-center text-uppercase">Editar Productos</h1>
    </div>
</div>

<div class="row m-b-30 m-t-30 padding-border" style="padding-left:5rem;padding-right:5rem;">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <a class="btn btn-warning"
            href="{{route('productos.index')}}">
            Atrás
        </a>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-12" style="padding-left:5rem;padding-right:5rem;">
        {!! Form::model($producto, ['method' => 'PUT',
            'route' => ['productos.update', $producto[0]['id']],
            'class' => 'login100-form validate-form padding-border select2',
            'id' => 'form_edit_product',
            'autocomplete' => 'off']) !!}
        {{ csrf_field() }}

            @include('productos.fields')

        <div class="row">
            <div class="col-md-4 col-md-offset-6">
                <input type="submit" value="Actualizar" class="btn btn-success btn-sm">
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@stop

@section('scripts')
    {{-- <script src="{{asset('validate/jquery.min.js')}}"></script> --}}
    {{-- <script src="{{asset('validate/validate.min.js')}}"></script> --}}

    <script>
        $(document).ready(function()
        {
            $("#codigo").trigger('focus');
            $("#nombre").trigger('focus');
            $("#categoria").trigger('focus');
            $("#precio").trigger('focus');
        });
    </script>
@endsection
