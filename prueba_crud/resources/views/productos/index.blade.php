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

                                <a href="#" class="btn btn-sm btn-danger">Eliminar Producto</a>
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

       function cambiarEstado(user_id)
       {
            Swal.fire({
                title: 'You really want',
                html: 'to change the status of this user?',
                icon: 'info',
                type: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.value)
                {
                    $.ajax({
                        async: true,
                        url: "",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            'id_user': user_id
                        },
                        beforeSend: function()
                        {
                            $("#loaderGif").show();
                            $("#loaderGif").removeClass('ocultar');
                        },
                        success: function(response)
                        {
                            if(response == "-1")
                            {
                                $("#loaderGif").hide();
                                $("#loaderGif").addClass('ocultar');
                                Swal.fire({
                                    position: 'center',
                                    title: 'Error!',
                                    html:  'An error occurred, try again, if the problem persists contact support.',
                                    icon: 'info',
                                    type: 'info',
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey:false,
                                    timer: 6000
                                });
                                return;
                            }

                            if(response == 0 || response == "0")
                            {
                                $("#loaderGif").hide();
                                $("#loaderGif").addClass('ocultar');
                                Swal.fire({
                                    position: 'center',
                                    title: 'Error!',
                                    html:  'An error occurred, try again, if the problem persists contact support.',
                                    icon: 'info',
                                    type: 'info',
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey:false,
                                    timer: 5000
                                });
                                return;
                            }

                            if(response == "success")
                            {
                                $("#loaderGif").hide();
                                $("#loaderGif").addClass('ocultar');
                                Swal.fire({
                                    position: 'center',
                                    title: 'Success!',
                                    html:  "The user's status has been successfully updated",
                                    icon: 'success',
                                    type: 'success',
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey:false,
                                    timer: 2000
                                });

                                setTimeout(function(){
                                    window.location.reload();
                                }, 3000);
                                return;
                            }
                        }
                    });
                }
            });
        }

        function updatePassword(id_user)
        {
            Swal.fire({
                title: 'Update Password',
                html: '<input class="form-control"' +
                       'placeholder="Entered the new password" type="password" name="change_clave" id="change_clave">',
                icon: 'info',
                type: 'info',
                showCancelButton: true,
                confirmButtonText: 'Update',
                cancelButtonText: 'Cancel',
                cancelButtonClassName: 'color-cancel-button'
            }).then((result) =>
            {
                let new_clave = $("#change_clave").val();

                if (result.value)
                {
                    $.ajax({
                        async: true,
                        url: "",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            'id_user': id_user,
                            'clave': new_clave
                        },
                        beforeSend: function()
                        {
                            $("#loaderGif").show();
                            $("#loaderGif").removeClass('ocultar');
                        },
                        success: function(response)
                        {
                            if(response == "-1")
                            {
                                $("#loaderGif").hide();
                                $("#loaderGif").addClass('ocultar');
                                Swal.fire({
                                    position: 'center',
                                    title: 'Error!',
                                    html:  'The password is required',
                                    icon: 'error',
                                    type: 'error',
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey:false,
                                    timer: 3000
                                });
                                return;
                            }

                            if(response == 0 || response == "0")
                            {
                                $("#loaderGif").hide();
                                $("#loaderGif").addClass('ocultar');
                                Swal.fire({
                                    position: 'center',
                                    title: 'Error!',
                                    html:  'An error occurred, try again, if the problem persists contact support.',
                                    icon: 'info',
                                    type: 'info',
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey:false,
                                    timer: 5000
                                });
                                return;
                            }

                            if(response == "success")
                            {
                                $("#loaderGif").hide();
                                $("#loaderGif").addClass('ocultar');
                                Swal.fire({
                                    position: 'center',
                                    title: 'Success!',
                                    html:  "The user's password has been successfully updated",
                                    icon: 'success',
                                    type: 'success',
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    allowEscapeKey:false,
                                    timer: 2000
                                });

                                setTimeout(function(){
                                    window.location.reload();
                                }, 3000);

                                return;
                            }
                        }
                    });
                }
            });
        }
    </script>
@endsection
