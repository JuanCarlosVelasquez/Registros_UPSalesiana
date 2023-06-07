function Buscador(){
var xmlhttp=false;
try {
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
try {
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
} catch (E) {
xmlhttp = false;
}
}
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
xmlhttp = new XMLHttpRequest();
}
return xmlhttp;
}

function Buscar() {
var Texto = document.getElementById('texto').value;
var Resultados = document.getElementById('resultados');
ajax = Buscador();
ajax.open("GET","procesar.php?q="+Texto);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)
}

function BuscarSrv() {
var Texto = document.getElementById('texto').value;
var Resultados = document.getElementById('resultados');
ajax = Buscador();
ajax.open("GET","servicios.php?q="+Texto);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)
}

function BuscarEsp() {
var Texto = document.getElementById('texto').value;
var Resultados = document.getElementById('resultados');
ajax = Buscador();
ajax.open("GET","especialidades.php?q="+Texto);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)
}

function BuscarIns() {
var Texto = document.getElementById('texto').value;
var Resultados = document.getElementById('resultados');
ajax = Buscador();
ajax.open("GET","instituciones.php?q="+Texto);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)
}

function Editar(id) {
var Resultados = document.getElementById('resultados');
ajax = Buscador();
ajax.open("GET","Editar.php?q="+id);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)

}

function Mod_Pass(id) {
var Resultados = document.getElementById('resultados');
ajax = Buscador();
ajax.open("GET","ModPass.php?q="+id);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)

}

function New_Pass(id) {
var Resultados = document.getElementById('resultados');
ajax = Buscador();
ajax.open("GET","NewPass.php?q="+id);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)

}

function EditarSrv(id) {
var Resultados = document.getElementById('resultados');
ajax = Buscador();
ajax.open("GET","EditarSrv.php?q="+id);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)

}

function EditarEsp(id) {
var Resultados = document.getElementById('resultados');
ajax = Buscador();
ajax.open("GET","EditarEsp.php?q="+id);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)

}

function EditarIns(id) {
var Resultados = document.getElementById('resultados');
ajax = Buscador();
ajax.open("GET","EditarIns.php?q="+id);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)

}


function guardarEdicion(id) {
var Resultados = document.getElementById('resultados');
var n = document.getElementById('nombre').value;
var a = document.getElementById('apellido').value;
var t = document.getElementById('telefono').value;
var cel = document.getElementById('celular').value;
var d = document.getElementById('direccion').value;
var email = document.getElementById('email').value;
var ced = document.getElementById('cedula').value;
var nick = document.getElementById('nick').value;
var rol = document.getElementById('rol').value;
var ins = document.getElementById('institucion').value;
var esp = document.getElementById('especialidad').value;
var cat = document.getElementById('categoria').value;
ajax = Buscador();
ajax.open("GET","guardar.php?q="+id+"&n="+n+"&a="+a+"&t="+t+"&cel="+cel+"&d="+d+"&ced="+ced+"&nick="+nick+"&rol="+rol+"&email="+email+"&ins="+ins+"&esp="+esp+"&cat="+cat);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)

}

function guardarEdicionSrv(id) {
var Resultados = document.getElementById('resultados');
var n = document.getElementById('nombre').value;
ajax = Buscador();
ajax.open("GET","guardarsrv.php?q="+id+"&n="+n);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)
}

function guardarEdicionEsp(id) {
var Resultados = document.getElementById('resultados');
var n = document.getElementById('nombre').value;
ajax = Buscador();
ajax.open("GET","guardaresp.php?q="+id+"&n="+n);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)
}

function guardarEdicionIns(id) {
var Resultados = document.getElementById('resultados');
var n = document.getElementById('nombre').value;
var d = document.getElementById('direccion').value;
ajax = Buscador();
ajax.open("GET","guardarins.php?q="+id+"&n="+n+"&d="+d);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)
}

function Eliminar(id) {
var Resultados = document.getElementById('resultados');
ajax = Buscador();
ajax.open("GET","eliminar.php?q="+id);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)

}

function EliminarSrv(id) {
var Resultados = document.getElementById('resultados');
ajax = Buscador();
ajax.open("GET","eliminarsrv.php?q="+id);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)

}

function EliminarEsp(id) {
var Resultados = document.getElementById('resultados');
ajax = Buscador();
ajax.open("GET","eliminaresp.php?q="+id);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)

}

function EliminarIns(id) {
var Resultados = document.getElementById('resultados');
ajax = Buscador();
ajax.open("GET","eliminarins.php?q="+id);
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)

}

function Validarpass(id){
	var Resultados = document.getElementById('resultados');
	var p0 = document.getElementById('pass0').value;
	var p1 = document.getElementById('pass1').value;
	var p2 = document.getElementById('pass2').value;
	var p3 = document.getElementById('pass3').value;
	ajax = Buscador();
	if(p0 != "") {
		if(p1 != "") {
			if(p2 != "") {
				if(p3 != "") {
					if(p0 == p1) {
						if(p2 == p3) {
							if(p1 != p2) {			
								c=confirm('Validacion Correcta, Desea Actualizar??');	
								if(c){
									ajax.open("GET","guardarpass.php?q="+id+"&p0="+p0+"&p1="+p1+"&p2="+p2+"&p3="+p3);
									ajax.onreadystatechange = function() {
									if (ajax.readyState == 4) {
									Resultados.innerHTML = ajax.responseText;
									}
									}
								}
								else{
								return false;
								}								
							}
							else{alert("Password Actual y Password Nuevo NO Pueden ser Iguales");}
						}
						else{alert("Password Nuevo NO fue CONFIRMADO Correctamente!!");}
					}
					else{alert("Password Actual NO es Correcta!!");}
				}
				else{alert("No se ha ingresado Confirmacion de Password!!");}
			}
			else{alert("No se ha ingresado Password Nuevo!!");}
		}
		else{alert("No se ha ingresado Password Actual!!");}
	}
	else{alert("Imposible recuperar Password Anterior!!");}
ajax.send(null)
}


function Validarpassnew(id){
	var Resultados = document.getElementById('resultados');
	var p0 = document.getElementById('pass0').value;
	var p2 = document.getElementById('pass2').value;
	var p3 = document.getElementById('pass3').value;
	ajax = Buscador();
			if(p2 != "") {
				if(p3 != "") {
						if(p2 == p3) {
								c=confirm('Validacion Correcta, Desea Actualizar??');	
								if(c){
									ajax.open("GET","guardarpassnew.php?q="+id+"&p2="+p2+"&p3="+p3);
									ajax.onreadystatechange = function() {
									if (ajax.readyState == 4) {
									Resultados.innerHTML = ajax.responseText;
									}
									}
								}
								else{
								return false;
								}								
						}
						else{alert("Password Nuevo NO fue CONFIRMADO Correctamente!!");}
				}
				else{alert("No se ha ingresado Confirmacion de Password!!");}
			}
			else{alert("No se ha ingresado Password Nuevo!!");}
ajax.send(null)
}

function Confirmar(id){
	c=confirm('Esta seguro que desea eliminar');	
	if(c){
		Eliminar(id);
		}
		else{
			return false;
			}
	
	}

function ConfirmarSrv(id){
	c=confirm('Esta seguro que desea eliminar');	
	if(c){
		EliminarSrv(id);
		}
		else{
			return false;
			}
	
	}

function ConfirmarEsp(id){
	c=confirm('Esta seguro que desea eliminar');	
	if(c){
		EliminarEsp(id);
		}
		else{
			return false;
			}
	
	}
	
function ConfirmarIns(id){
	c=confirm('Esta seguro que desea eliminar');	
	if(c){
		EliminarIns(id);
		}
		else{
			return false;
			}
	
	}
	
	
	
	
	
	
