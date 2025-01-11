@extends('layouts.layout')

@section('title', 'Bienvenido')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Bienvenido a mi tienda</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-md-offset-5">
            <a href="{{route('productos.index')}}" class="btn btn-primary m-t-8">Entrar</a>
        </div>
    </div>
</div>

@stop