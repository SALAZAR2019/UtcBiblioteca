@extends('layout.master')
@section('titulo','Prestamos')
@section('contenido')
<div class="container" id="prestamo">
    <div class="row">
        <div class="col-12">
            <h1>PRESTAMO DE LIBROS</h1>
        </div>
    </div>
    <div class="row g-2">
        <div class="input-group">
			<div class=" col-4 position-relative">
				<input id="id_usuario" type="text" name="id_usuario" v-model="id_usuario" class="form-control" placeholder="ingrese matricula-cedula" onkeyup="verificar(this.value);">
			</div>
			<div class="col-4 position-relative">
               	<input id="libro" type="text" name="libro" class="form-control" v-model="codigo" ref="buscar" placeholder="ingrese id libro" onkeyup="verificar2(this.value);" v-on:keyup.enter="getLibros()">
			</div>
			<div class="col-3 position-relative">
				<span class="input-group-btn">
					<button id="btnEnviar" class="btn btn-success" type="submit" disabled class="btn btn-success" @click="getLibros()" disabled>Agregar</button>
				</span>
			</div>
        </div>
    </div>
    <hr>
    <div class="row">
			<div class="col-8">
				<table id="table" class="table table-bordered">
					<thead style="background: #ffffcc">
						<th>ID</th>
						<th>ISBN</th>
						<th width="15%">TITULO</th>
						<th width="15%">ESTADO</th>
						<th width="15%">OPCIONES</th>
					</thead>
					<tbody>
						<tr v-for="(v,index) in prestamos">
							<td>@{{v.id_ejemplar}}</td>
							<td>@{{v.id_libro}}</td>
							<td>@{{v.codigo}}</td>
							<td>@{{v.titulo}}</td>
							<td><span class="btn btn-bg" @click="eliminarLibro(index)">eliminar</span></td>
						</tr>
					</tbody>
				</table>
			</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-4">
			<span class="input-group-btn">
				<button class="btn btn-success" @click="prestamo" >Realizar prestamo</button>
			</span>
		</div>
	</div>
</div>
@endsection
@push('scripts')
	<script src="js/prestamo/prestamo.js"></script>
	<script src="js/moment-with-locales.min.js"></script>
	<script src="js/validar.js"></script>
@endpush
<input type="hidden" name="route" value="{{url('/')}}">