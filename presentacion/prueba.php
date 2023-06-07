<html>
<head>
<script type="text/javascript">

function validarForm()
{
	var entradas = document.getElementsByTagName("input");
	var i = 0;

	for(i=0; i<entradas.length; i++)
	{
		if(entradas[i].type == "checkbox" && !entradas[i].checked)
		{
			alert("Tienes que marcar la casilla!");
		}
		if(entradas[i].type == "text" && entradas[i].value=="")
		{
			alert("La entrada " +entradas[i].id + "está vacía!");
		}
	}
}

</script>
</head>
<body>

<form id="form1" name="form1" method="post" action="" OnSubmit="return validarForm()">
  <table width="200" border="1" align="center">
    <tr>
      <td width="72">Disponible</td>
      <td width="72">Nombre</td>
      <td width="13">Apellido</td>
      <td width="15">Sexo</td>
    </tr>
    <tr>
      <td><input name="chk1" type="checkbox" id="input2" checked="checked" />
      </td>
      <td>
      <input type="text" name="text1" id="input2" /></td>
      <td>
      <input type="text" name="text2" id="input3" /></td>
      <td>
        <select name="slt1" id="select1">
          <option value="0">--Seleccione--</option>
          <option value="M">M</option>
          <option value="F">F</option>
      </select></td>
    </tr>
  </table><br />
<div align="center">
  <input type="submit" name="btn_validar" id="btn_validar" value="Validar" />
</div>
</form>  


</body>
</html>