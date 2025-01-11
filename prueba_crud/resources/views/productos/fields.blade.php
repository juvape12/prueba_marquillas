
<div class="row m-t-30">
    <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="wrap-input100 validate-input" data-validate="Este campo es obligatorio">
                <input type="text" name="codigo" id="codigo" class="input100" 
                value="{{isset($producto) ? $producto[0]['codigo'] : null}}">
            <span class="focus-input100" data-placeholder="Código del Producto"></span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="wrap-input100 validate-input" data-validate="Este campo es obligatorio">
                <input type="text" name="nombre" id="nombre" class="input100"
                value="{{isset($producto) ? $producto[0]['nombre'] : null}}">
            <span class="focus-input100" data-placeholder="Nombre del Producto"></span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="wrap-input100 validate-input" data-validate="Este campo es obligatorio">
                {!! Form::select('categoria', $categorias, 
                    isset($producto) ? $producto[0]['categoria_id'] : null,
                    ['class' => 'input100', 'id' => 'categoria']) !!}
            <span class="focus-input100" data-placeholder="Categoría del Producto"></span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="wrap-input100 validate-input" data-validate="Este campo es obligatorio">
                <input type="number" min="0" name="precio" id="precio" class="input100"
                value="{{isset($producto) ? $producto[0]['precio'] : null}}">
            <span class="focus-input100" data-placeholder="Precio del Producto"></span>

            <input type="hidden" name="id_producto" id="id_producto" value="{{isset($producto) ? $producto[0]['id'] : null}}">
        </div>
    </div>
</div>
    