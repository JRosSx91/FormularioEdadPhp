<!DOCTYPE html>
<html lang="es-ES"> 
    <head>
        <meta charset="UTF-8"/>
        <title>Login MySQL</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" type="text/css" href="css/css-formulario/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/css-formulario/style.css" />
		<link rel="stylesheet" type="text/css" href="css/css-formulario/animate-custom.css" />
        <link rel="stylesheet" type="text/css" href="css/css-formulario/prueba.css">
    </head>
    <body>
        <header>
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">MangaLibre</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catálogo<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <div class="triangle"></div>
                            <li><a href="#">Catálogo completo</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Shônen Manga</a></li>
                            <li><a href="#">Shôjo Manga</a></li>
                            <li><a href="#">Kodomo Manga</a></li>
                            <li><a href="#">Seinen Manga</a>
                            </li>
                            <li><a href="#">Josei Manga</a>
                            </li>
                        </ul>
                    </li>
                <li><a href="#">Noticias</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="#">Foro</a></li>
              </ul>
              <form class="navbar-form navbar-right">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
              </form>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Acceso</a></li>
                <li><a id="header-join" href="#">Únete a <strong>MangaLibre</strong></a> </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        <div class="logo-fondo">
            <div>
                <img src="imatges/logofondo.png" class="img-responsive">
            </div>
        </div>
    </header>
        <p id="resultadototal">
        <?php
            $nom = $_POST['nom'];
            $cognom = $_POST['cognom'];
            $mail = $_POST['mail'];
            $data = $_POST['data'];
            $username = $_POST['username'];
            $username2 = $_POST['username2'];
            $pass = $_POST['pass'];
            $pass2 = $_POST['pass2'];
            $pass3 = $_POST['pass3'];
            $boto1 = $_POST['boto1'];
            $boto2 = $_POST['boto2'];
            $recuerda = $_POST['loginkeep'];

            if(isset($boto1)){
                //Cálculo de la edad en función de la fecha de nacimiento
                list($any, $mes, $dia) = explode ("-", $data);
                if (date("d")<$dia && date("m")>$mes){
                    $edad = (date("Y")-$any)*365.2425 + (date("m")-$mes-1)*30.44 + (30.44-$dia);
                    $edadfinal = $edad/365.2425;
                }
                else if (date("m")<$mes && date("d")>$dia){
                    $edad = (date("Y")-$any-1)*365.2425 + (12-$mes)*30.44 + $dia;
                    $edadfinal = $edad/365.2425;
                }
                else if(date("d")<$dia && date("m")<$mes){
                    $edad = (date("Y")-$any-1)*365.2425 + (12-$mes)*30.44 + (30.44-$dia);
                    $edadfinal = $edad/365.2425;
                }
                else{
                    $edad = (date("Y")-$any)*365.2425 + (date("m")-$mes)*30.44 + $dia;
                    $edadfinal = $edad/365.2425;
                }

                //Comprobación edad
                if($edadfinal < 18){
                    echo "<span>¡Lo sentimos! Es necesario tener 18 años para registrarse.</span>";
                    exit();
                }
                else{
                    //Si todo OK realizamos la conexión a las BBDD
                    $conexion = mysqli_connect("localhost", "root", "root") or die("No s'ha pogut establir la conexió amb el servidor.");
                    mysqli_set_charset($conexion, "utf8");
                    mysqli_select_db($conexion, "Web Manga") or die("No s'ha pogut conectar amb la base de dades.");
                    $new_username = mysqli_num_rows($conexion->query("SELECT User FROM User WHERE User = '$username'"));
                                    
                    if($new_username > 0){
                        echo "1";
                    }
                    else{
                        $instruccion = "INSERT INTO User (User, Nombre, Apellido, Email, Fecha_nacimiento, Password) VALUES ('$nom', '$cognom', '$mail', '$data', '$username', '$pass')";
                        $consulta = $conexion->query($instruccion) or die ("No es pot realitzar la consulta.");
                        $numuser = mysqli_num_rows($conexion->query("SELECT User FROM User"));
                        echo "<strong>¡Bienvenido/a! ¡Ya somos ".$numuser." usuarios!</strong>";
                        mysqli_close($conexion);
                    }
                }
            }
        ?>
        </p>
        <section>				
            <div id="container_demo" >
                <a class="hiddenanchor" id="toregister"></a>
                <a class="hiddenanchor" id="tologin"></a>
                <div id="wrapper">
                    <div id="login" class="animate form">
                        <form action="#reconsulta2" method="post" autocomplete="on"> 
                            <h1>INICIAR SESION</h1>
                            <p id="reconsulta2">
                                <?php
                                    if(isset($boto2)){
                                        $conexion2 = mysqli_connect("localhost", "root", "root") or die("No s'ha pogut establir la conexió amb el servidor.");
                                        mysqli_set_charset($conexion2, "utf8");
                                        mysqli_select_db($conexion2, "Web Manga") or die("No s'ha pogut conectar amb la base de dades.");
                                        $instruccion2 = "SELECT User FROM User WHERE User = '$username2' && Password = '$pass3'";
                                        $instruccion3 = "SELECT User FROM User WHERE User = '$username2'";
                                        $consulta2 = mysqli_num_rows($conexion2->query($instruccion2));

                                        if ($consulta2 > 0 && $recuerda != 1){
                                            echo "¡Bienvenido/a, ".$username2."!";
                                        }
                                        else if($consulta2 > 0 && $recuerda == 1){
                                            echo "¡Bienvenido/a, ".$username2."!";
                                            setcookie('cookieuser', $username2, time()+300);
                                            setcookie('cookiepass', $pass3, time()+300);
                                        }
                                        else{
                                            $consulta3 = mysqli_num_rows($conexion2->query($instruccion3));
                                            if ($consulta3 > 0){
                                                echo "La contraseña es incorrecta.";
                                            }
                                            else{
                                                echo "No estás registrado/a.";
                                            } 
                                        }
                                    }
                                ?>
                            </p> 
                            <p> 
                                <label for="username" class="uname icon-u" data-icon="icon-u" > Nombre de usuario </label>
                                <input id="username" name="username2" required="required" type="text" placeholder="MiNombreDeUsuario"/>
                            </p>
                            <p> 
                                <label for="password" class="youpasswd icon-l" data-icon="icon-l"> Contraseña </label>
                                <input id="password" name="pass3" required="required" type="password" placeholder="ej. X8df!90EO" /> 
                            </p>
                            <p class="keeplogin"> 
								<input type="checkbox" name="loginkeep" id="loginkeeping" value="1" /> 
								<label for="loginkeeping">Recúerdame</label>
							</p>
                            <p class="login button"> 
                                <input type="submit" name="boto2" value="Ingresa" /> 
							</p>
                            <p class="change_link">
								¿Aún no eres miembro?
								<a href="#toregister" class="to_register">Únete</a>
							</p>
                        </form>
                    </div>
                    <div id="register" class="animate form">
                        <form method="post" autocomplete="on" onchange="validaTodo(this)" id="formulario"> 
                            <h1> Registro </h1>
                            <p id="reconsulta"></p> 
                            <p> 
                                <label for="usernamesignup" class="uname icon-u" data-icon="icon-u">Nombre de usuario</label>
                                <input id="usernamesignup" name="username" required="required" type="text" placeholder="MiNombreDeUsuario" />
                                <p id="nomuser" style="display:none">
                                <script type="text/javascript">
                                    var nomuser = document.getElementById("resultadototal").innerHTML;
                                    
                                    if (nomuser == 1){
                                        document.write("<span>El nombre de usuario ya está en uso.</span>");
                                        document.getElementById("nomuser").style = "display: block";
                                    }
                                    else{
                                        document.getElementById("reconsulta").innerHTML = nomuser;
                                    }
                                    
                                </script>
                                </p>
                            </p>
                            <p> 
                                <label for="emailsignup" class="youmail icon-u" data-icon="icon-u" > Nombre</label>
                                <input id="emailsignup" name="nom" required="required" type="text" placeholder="Pepe"/> 
                            </p>
                            <p> 
                                <label for="emailsignup" class="youmail icon-u" data-icon="icon-u" > Apellido</label>
                                <input id="emailsignup" name="cognom" required="required" type="text" placeholder="López"/> 
                            </p>
                            <p> 
                                <label for="emailsignup" class="youmail icon-m" data-icon="icon-m" > Email</label>
                                <input id="emailsignup" name="mail" required="required" type="email" placeholder="Pepe@mail.com"/> 
                            </p>
                            <p> 
                                <label for="emailsignup" class="youmail icon-c" data-icon="icon-c"> Fecha de nacimiento</label>
                                <input data-icon="" id="datasignup" name="data" required="required" type="date"/>
                                <p id="dataform" style="display: none"><span>Debes tener 18 años para registrarte.</span></p> 
                            </p>
                            <p> 
                                <label for="passwordsignup" class="youpasswd icon-l" data-icon="icon-l">Contraseña </label>
                                <input id="passwordsignup" name="pass" required="required" type="password" placeholder="ej. X8df!90EO"/>
                            </p>
                            <p> 
                                <label for="passwordsignup_confirm" class="youpasswd icon-l" data-icon="icon-l">Confirma la contraseña </label>
                                <input id="passwordsignup_confirm" name="pass2" required="required" type="password" placeholder="ej. X8df!90EO"/>
                                <p id="compPass" style="display: none"><span>Las contraseñas no coinciden.</span></p>
                            </p>
                            <p>
                            </p>
                            <p class="signin button"> 
								<input id="registro" type="submit" name="boto1" value="Regístrate" disabled/> 
							</p>
                            <p class="change_link">  
								¿Ya eres miembro?
								<a href="#tologin" class="to_register"> Acceder </a>
							</p>
                        </form>
                        <script type="text/javascript">   
                            function validaTodo(formulario){

                                if (document.getElementById("passwordsignup").value == document.getElementById("passwordsignup_confirm").value){

                                    document.getElementById("compPass").style = "display: none";

                                    var fecha = document.getElementById("datasignup").value;
                                    var partes = fecha.split("-");
                                    var anio = partes[0];
                                    var mes = partes[1];
                                    var dia = partes[2];
                                    var today = new Date();
                                    var date = today.getFullYear() + "-" + (today.getMonth()+1) + "-" + today.getDate();
                                    var dateActual = date.split("-");
                                    var anioActual = dateActual[0];
                                    var mesActual = dateActual[1];
                                    var diaActual = dateActual[2];


                                    if (diaActual < dia && mesActual > mes){
                                        var edad = (anioActual - anio)*365.2425 + (mesActual-mes)*30.44 + (30.44-dia);
                                        var edadfinal = edad / 365.2425;
                                    }
                                    else if (mesActual < mes && diaActual > dia){
                                        var edad = anioActual-anio-1*365.2425 + (12-mes)*30.44 + dia;
                                        var edadfinal = edad / 365.2425;
                                    }
                                    else if (diaActual < dia && (mesActual+1) < mes){
                                        var edad = (anioActual-anio-1)*365.2425 + (12-mes)*30.44 + (30.44-dia);
                                        var edadfinal = edad/365.2425;
                                    }
                                    else{
                                        var edad = (anioActual-anio)*365.2425 + (mesActual-mes)*30.44 + dia;
                                        var edadfinal = edad/365.2425;
                                    }

                                    if (edadfinal < 18){
                                        document.getElementById("dataform").style = "display: block";

                                    }
                                    else{
                                        document.getElementById("dataform").style = "display: none";

                                        if(edadfinal > 18 && document.getElementById("passwordsignup").value != "" && document.getElementById("passwordsignup").value == document.getElementById("passwordsignup_confirm").value){

                                            document.getElementById("registro").removeAttribute("disabled");
                                        }
                                        else{
                                            document.getElementById("registro").disabled = true;
                                        } 
                                    }
                                }
                                else{
                                    document.getElementById("compPass").style = "display: block";
                                    document.getElementById("registro").disabled = true;
                                }
                            }                     
                        </script>
                    </div>	
                </div>
            </div>  
        </section>
    </body>
</html>