	var route = document.querySelector("[name=route]").value;
	var UrlPre=route + '/apidevolucion';
	var Urldev=route + '/apidevolucion';
	var UrlSend=route+'/envios';
	function init()
	{
	new Vue({
		http:{
			headers:{
				'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
			}
		},

		el:'#prestamos',

		data:{
			pagination:{
                'total':0,
                'current_page':0,
                'per_page':0,
                'last_page':0,
                'from':0,
                'to':0,
			},
			prestamos:[],
			devoluciones:[],
			buscar:'',
			nom:'hola',
			folio:'',
			id_ejemplar:'',
			id_prestamo:'',
    		id_usuario:'',
			titulo:'',
			id_libro:'',
			fecha_prestamo:'',
			fecha_actual:moment().format('YYYY-MM-DD') //almacena fecha.
			
		},
		created:function(){
			this.getPre();
			this.getDev();
			this.envios();
			//this.pintar();
			
		},

		methods:{
			getPre:function(page){
				var UrlPre=route + '/apidevolucion?page='+page;
				this.$http.get(UrlPre)
				.then(function(json){
					this.prestamos=json.data.prestamos.data;
					this.pagination= json.data.pagination
                    
				});
			},
			getDev:function(){
				this.$http.get(Urldev)
				.then(function(json){
					this.devoluciones=json.data;
                   
				});
			},
			
			
			showModal:function(){
				$('#add_devolucion').modal('show');
			},

			Salir:function(){


				this.id_ejemplar='';
				this.id_libro='';
				this.id_prestamo='';
				this.fecha_prestamo='';
				

				$('#add_devolucion').modal('hide');
				
			},

			dev:function(id){
				this.$http.get(UrlPre +'/'+ id)
				.then(function(json){

				this.folio=json.data.folio;
				this.id_ejemplar=json.data.id_ejemplar;
				this.id_prestamo=json.data.id_prestamo;
				this.id_usuario=json.data.id_usuario;
				this.id_libro=json.data.id_libro;
				this.titulo=json.data.titulo;
				this.fecha_prestamo=json.data.fecha_prestamo;
				this.fecha_actual=this.fecha_actual;
				
					$('#add_devolucion').modal('show');
				});
			}
			,
			envio:function(){
				this.$http.post(UrlSend)
				.then(function(){
					swal({
						text: "Se ha enviado aviso ",
						icon: "success",

					  })
					this.getPre();
				});
			},
			envios(){
			   setInterval(()=>{
				this.envio();
			   },3000000);
			   //43200000
		   },
		   pintar:function(){

			var fecha=[];
			for (var i = 0; i < this.prestamos.length; i++) {
				fecha.push({
					//id_libro:this.prestamos[i].id_libro,
					id:this.prestamos[i].fecha_devolucion,
					//foto:this.prestamos[i].foto,
					//describe_estado:this.prestamos[i].describe_estado,
					//codigo:this.prestamos[i].codigo,
					//ISBN:this.prestamos[i].ISBN,
					
				})
			
			}
			console.log(fecha);
			if(fecha<=this.fecha_actual){
				document.getElementById("celda").style.color = "#FFFFFF";
			}else{
				document.getElementById("celda").style.color = "#676575"
			}
		   },
			devolver:function(){
				var dev={

					id_ejemplar:this.id_ejemplar,
					folio:this.folio,
					id_prestamo:this.id_prestamo,
					fecha_prestamo:this.fecha_prestamo,
					fecha_actual:this.fecha_actual
					
				};
				this.$http.post(Urldev, dev)
				.then(function(json){
					swal({
						text: "Se ha registrado la devolucion del libro",
						icon: "success",
					  })
					this.getPre();
				});
				this.Salir();
			},
			changePage:function(page){
				this.pagination.current_page=page;
				this.getPre(page);
			},
			
	},
	computed:{

		isActived:function(){
			return this.pagination.current_page;
		},

		pageNumber:function(){
			if(!this.pagination.to){
				return [];
			}
			var from = this.pagination.current_page - 2;//
			if(from<1){
				from=1;
			}
			var to = from +(2*2);//
			if(to>=this.pagination.last_page){
				to=this.pagination.last_page;
			}
			var pagesArray=[];

			while(from<=to){
				pagesArray.push(from);
				from++;
			}
			return pagesArray;
		},


		filtroPrestamos:function(){
			return this.prestamos.filter((pre)=>{
				return pre.folio.match(this.buscar.trim())||
				pre.titulo.toLowerCase().match(this.buscar.trim().toLowerCase());
			});
		}
	}
});
}
window.onload=init;
