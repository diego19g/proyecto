<?php
include "menu.php";

$base="diegogarcia"; 

$tabla="compran"; 

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['comprar'])){
    $dni=$_REQUEST['dni'];
    $tipo=$_REQUEST['tipo'];
    $marca=$_REQUEST['marca'];
    if($tipo=="lavadora"){
        if($marca=="balay"){
            $codigo=1;
        }
        if($marca=="beko"){
            $codigo=2;
        }
        if($marca=="siemens"){
            $codigo=3;
        }
        if($marca=="aeg"){
            $codigo=4;
        }
        if($marca=="bosch"){
            $codigo=5;
        }
        if($marca=="fagor"){
            $codigo=6;
        }
    }
    if($tipo=="frigorifico"){
        if($marca=="balay"){
            $codigo=7;
        }
        if($marca=="beko"){
            $codigo=8;
        }
        if($marca=="siemens"){
            $codigo=9;
        }
        if($marca=="aeg"){
            $codigo=10;
        }
        if($marca=="bosch"){
            $codigo=11;
        }
        if($marca=="fagor"){
            $codigo=12;
        }
    }

    if($tipo=="lavavajillas"){
        if($marca=="balay"){
            $codigo=13;
        }
        if($marca=="beko"){
            $codigo=14;
        }
        if($marca=="siemens"){
            $codigo=15;
        }
        if($marca=="aeg"){
            $codigo=16;
        }
        if($marca=="bosch"){
            $codigo=17;
        }
        if($marca=="fagor"){
            $codigo=18;
        }
    }

    print'<br>Datos de la compra:<br>DNI:'.$dni.'<br>Tipo de electrodoméstico: '.$tipo.'Marca del electrodoméstico'.$marca.'<br>Código del electrodoméstico: '.$codigo.'<br>¡APUNTA EL CODIGO PARA PODER IDENTIFICAR TU ELECTRODOMÉSTICO EN CASO DE MODIFICACIÓN O CANCELACIÓN DE LA COMPRA!';
    mysqli_query($c,"INSERT $tabla (codigo_electrodomesticos,dni) VALUES ('$codigo','$dni')");

    if (mysqli_errno($c)==0){
        echo "<br><br><h2>Registro AÑADIDO</b></H2>";
    }else{
        if (mysqli_errno($c)==1062){
            echo "<h2>No ha podido añadirse el registro<br>Ya existe un campo con este DNI y este ELECTRODOMÉSTICO</h2>";
        }else{ 
            $numerror=mysqli_errno($c);
            $descrerror=mysqli_error($c);
            echo "Se ha producido un error nº $numerror que corresponde a: $descrerror  <br>";
        }
    }

    mysqli_close($c); 
}else{
    print '
<h2>RELLENA LOS SIGUIENTES CAMPOS PARA REALIZAR TU COMPRA</h2>
<form action="" method="POST">
<fieldset>
    <label>Introduce tu DNI:</label>
    <input name="dni"/><br>
    <label>Indique el tipo de electrodoméstico que desea comprar:</label>
    <select name="tipo">
        <option value="lavadora">Lavadora</option>
        <option value="frigorifico">Frigorífico</option>
        <option value="lavavajillas">Lavavajillas</option>
    </select><br>
    <label>Indique la marca del electrodoméstico:</label>
    <select name="marca">
        <option value="balay">Balay</option>
        <option value="beko">Beko</option>
        <option value="siemens">Siemens</option>
        <option value="aeg">AEG</option>
        <option value="bosch">Bosch</option>
        <option value="fagor">Fagor</option>
    </select><br>
    <input name="comprar" type="submit" id="comprar" value="Realizar compra"/>
</fieldset>
</form>
';
}

