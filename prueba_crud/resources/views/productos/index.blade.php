@extends('layouts.layout')
@section('title', 'Listado Productos')
@section('css')
    <link href="{{asset('DataTable/datatables.min.css')}}" rel="stylesheet">
@stop
@section('content')

<div class="row">
    <div class="col-12">
        <h1 class="text-center text-uppercase">Listado de Productos</h1>
    </div>
</div>

<div class="row p-b-20 float-right" style="padding-left:5rem;padding-right:5rem;">
    <div class="col-12">
        <a href="{{route('productos.create')}}" class="btn btn-primary">Crear Nuevo Producto</a>
    </div>
</div>

<div class="row p-b-20 float-left" style="padding-left:5rem;padding-right:5rem;">
    <div class="col-12">
        <a href="{{route('categorias.create')}}" class="btn btn-primary">Crear Nueva Categoría</a>
    </div>
</div>

<div class="row p-t-30" style="padding-left:5rem;padding-right:5rem;">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dt-button"
                    id="tbl_productos" aria-describedby="tabla productos">
                <thead>
                    <tr class="header-table">
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($productos as $producto)
                        <tr>
                            <td>{{$producto['codigo']}}</td>
                            <td>{{$producto['nombre']}}</td>
                            <td>{{$producto['categoria']}}</td>
                            <td>{{$producto['precio']}}</td>
                            <td>
                                @if($producto['estado'] == 1)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-danger">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('productos.edit', $producto['id'])}}" class="btn btn-sm btn-success">Actualizar Producto</a>

                                <a href="#" class="btn btn-danger btn-sm" title="Eliminar Producto"
                                        id="eliminar"
                                        onclick="eliminarProducto({{$producto['id']}})">
                                        Eliminar Producto
                                    </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-md-offset-2 m-t-10">
    @if (\Session::has('success'))
        <div class="alert alert-info" id="alert">
            <ul>
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;{!! \Session::get('success') !!}
            </ul>
        </div>
    @endif
    </div>

    <div class="col-md-8 col-md-offset-2 m-t-10">
    @if (\Session::has('info'))
        <div class="alert alert-danger" id="alert">
            <ul>
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;{!! \Session::get('info') !!}
            </ul>
        </div>
    @endif
    </div>
</div>

@stop
@section('scripts')
    <script src="{{asset('DataTable/pdfmake.min.js')}}"></script>
    <script src="{{asset('DataTable/vfs_fonts.js')}}"></script>
    <script src="{{asset('DataTable/datatables.min.js')}}"></script>

    <script>
        $( document ).ready(function()
        {
            setTimeout(() => {
                $('#alert').hide();
                $('#alert').addClass('ocultar');
            }, 3000);
            $('#tbl_productos').DataTable({
                'ordering': false,
                "lengthMenu": [[10,25,50,100, -1], [10,25,50,100, 'ALL']],
                dom: 'Blfrtip',
                "info": "Showing page _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros",
                "buttons": [
                    {
                        extend: 'copyHtml5',
                        text: 'Copiar',
                        className: 'waves-effect waves-light btn-rounded btn-sm btn-primary',
                        init: function(api, node, config) {
                            $(node).removeClass('dt-button')
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        className: 'waves-effect waves-light btn-rounded btn-sm btn-primary',
                        init: function(api, node, config) {
                            $(node).removeClass('dt-button')
                        }
                    },
                ]
            });
        });

       function eliminarProducto(id)
       {
            let confirmacion = confirm("¿Realmente quieres eliminar este producto?");

            if(confirmacion)
            {
                $.ajax({
                    async: true,
                    url: "{{route('eliminarProducto')}}",
                    type: "DELETE",
                    dataType: "JSON",
                    data: {
                        'id_producto': id
                    },
                    success: function(response)
                    {
                        alert(response.Data.message);

                        setTimeout(() => {
                            
                            window.location.reload();
                        }, 2000);
                    }
                });
            }
        }
    </script>
@endsection
