<?php
include_once"../dominio/usuario.php";
include_once"../dominio/UsuarioMysql.php";


$usua=new usuario();
$usua2=new UsuarioMysql();

if($usua->lista_usuario())
{
	echo"existe usuario en Oracle";
	
}

 if($usua2->listaUsuarioMsql())
{
	echo "existe usuario en Msql";
}




	


?>


<html>
 <head>
 <title>XYZ Pvt. Ltd.</title>
 <style>
 html { height: 100%; width: 100%; }
 body { width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px;
 font-family: Verdana, Arial, Helvetica, sans-serif; background: #D4E6F4;
 font-size: 13px; line-height: 15px; }
 body {background-image:url('images/paper.gif');}
 ul
 {
 list-style-type:none;
 margin:0;
 padding:0;
 overflow:hidden;
 }
 li
 {
 float:left;
 }
 a:link,a:visited
 {
 display:block;
 width: 150px;
 font-weight:bold;
 padding:8px;
 text-align:center;
 text-decoration:none;
 text-transform:uppercase;
 }
 li a:hover {
 color: #357; }
 li ul {
 display: none; }
 li:hover ul, li.hover ul {
 position: relative;
 display: block;
 left: 0;
 width: 150px;
 margin: 0;
 padding: 0; }
 li:hover li, li.hover li {
 float: none; }
 li:hover li a, li.hover li a {
 color: #357; }
 li li a:hover {
 color: #357; }
 #header { height: 65px; margin: 0px; padding: 0px; text-align: left; 
background: #1A446C; color: #D4E6F4; }
 #header h1 { padding: 1em; margin: 0px;}
 #footer { height: 2em; margin: 0px; padding: 1em; text-align: center; 
background: #1A446C; color: #D4E6F4; }

 .rightJustified {
 text-align: right;
 }
 
 .titulo{
	
 width: 150px;
 height:65px;
 font-weight:bold;
 padding:8px;
 text-align:center;
 text-decoration:none;
 text-transform:uppercase;
  background: #D4E6F4;
	 }
 
 </style>
 <script>
 // Javascript originally by Patrick Griffiths and Dan Webb.
 // http://htmldog.com/articles/suckerfish/dropdowns/
 sfHover = function() {
 var sfEls = document.getElementById("navbar").getElementsByTagName("li");
 for (var i=0; i<sfEls.length; i++) {
 sfEls[i].onmouseover=function() {
 this.className+=" hover";
 }
 sfEls[i].onmouseout=function() {
 this.className=this.className.replace(new RegExp(" hover\\b"), "");
 }
 }
 }
 if (window.attachEvent) window.attachEvent("onload", sfHover);
 </script>
 </head>
 <body>
 <div id="header">
 <IMG SRC="images/pss.jpg" WIDTH="200" HEIGHT="65" >
 </div>
 <ul id="navbar">
 <li><a href="aboutus.php">Home</a>
 <ul>
 <li><a href="whatpro.php">What ProLoT Means?</a></li>
 <li><a href="goals.php">Our Goals</a></li>
 </ul>
 </li>
 <li><a href="services.php">Services</a>
 <ul>
 <li><a href="swdev.php">Software Developement</a></li>
 <li><a href="webdev.php">Web Developing</a></li>
 <li><a href="shm.php">System & Hardware Maintenance</a></li>
 <li><a href="edu.php">Education</a></li>
 <li><a href="nwsys.php">Networking of Systems</a></li>
 <li><a href="bsnsmmt.php">Business Management</a></li>
 <li><a href="workshops.php">Workshops</a></li>
 </ul> 
</li>
 <li><a href="products.php">Products</a> 
</li>
 <li><a href="vacancy.php">Career</a>
 <ul>
 <li><a href="vacancy.php">View Vacancies</a></li>
 <li><a href="resume.php">Post your Resume</a></li>
 <li><a href="intern.php">Internships</a></li>
 </ul> 
</li>
 <li><a href="corptrain.php">Training</a>
 <ul>
 <li><a href="corptrain.php">Corporate Training</a></li>
 <li><a href="voctrain.php">Vocational Training</a></li>
 <li><a href="odtrain.php">On Demand Training</a></li>
 </ul> 
</li>
 <li><a href="contact.php">Contact Us</a> 
</li>
 </ul>
 </body>
 </html>