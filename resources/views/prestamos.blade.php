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
			<div class=" col-3 position-relative">
				<input id="id_usuario" type="text" name="id_usuario" v-model="id_usuario" class="form-control" placeholder="ingrese matricula-cedula"  onkeyup="verificar(this.value);" >
			</div>
			<div class="col-3 position-relative">
				<span class="input-group-btn">
					<button id="btnUser" class="btn btn-success" type="submit" onsubmit="return checkSubmit();"
  class="btn btn-success" @click="getUser()">Verificar</button>
				</span>
			</div>
			<div class="col-3 position-relative">
               	<input id="libro" type="text" name="libro" class="form-control" v-model="codigo" ref="buscar" placeholder="ingrese id libro" disabled onkeyup="verificar2(this.value);" v-on:keyup.enter="getLibros()">
			</div>
			<div class="col-2 position-relative">
				<span class="input-group-btn">
					<button id="btnEnviar" class="btn btn-success" type="submit" disabled class="btn btn-success" @click="getLibros()">Agregar libro</button>
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
						<th width="15%">CÓDIGO</th>
						<th width="15%">TITULO</th>
						
						<th width="15%">OPCIONES</th>
					</thead>
					<tbody>
						<tr v-for="(v,index) in prestamos">
							<td>@{{v.id_ejemplar}}</td>
							<td>@{{v.ISBN}}</td>
							<td>@{{v.codigo}}</td>
							<td>@{{v.titulo}}</td>
							<td><span class="btn btn-bg" @click="eliminarLibro(index)">eliminar</span></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="navbar-custom-menu">
			
			<ul v-for="usu in users" class="nav navbar-nav">
				<li>@{{usu.nombres}}</li>
				<li>@{{usu.correo}}</li>
				<li><span class="btn btn-bg btn-warning" @click="eliminarUser(users.id_usuario)">Cambiar</span></li>
			</ul>
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