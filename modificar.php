<?php
include "menu.php";

$base="diegogarcia"; 

$tabla="compran"; 

$c=mysqli_connect("localhost","diegogarcia","diegogarcia"); 

mysqli_select_db($c,$base); 

if(isset($_REQUEST['modificar'])){
    $dni=$_REQUEST['dni'];
    $tipo=$_REQUEST['tipo'];
    $marca=$_REQUEST['marca'];
    $codigo=$_REQUEST['codigo'];

    if($tipo=="lavadora"){
        if($marca=="balay"){
            $codigo2=1;
        }
        if($marca=="beko"){
            $codigo2=2;
        }
        if($marca=="siemens"){
            $codigo2=3;
        }
        if($marca=="aeg"){
            $codigo2=4;
        }
        if($marca=="bosch"){
            $codigo2=5;
        }
        if($marca=="fagor"){
            $codigo2=6;
        }
    }
    if($tipo=="frigorifico"){
        if($marca=="balay"){
            $codigo2=7;
        }
        if($marca=="beko"){
            $codigo2=8;
        }
        if($marca=="siemens"){
            $codigo2=9;
        }
        if($marca=="aeg"){
            $codigo2=10;
        }
        if($marca=="bosch"){
            $codigo2=11;
        }
        if($marca=="fagor"){
            $codigo2=12;
        }
    }

    if($tipo=="lavavajillas"){
        if($marca=="balay"){
            $codigo2=13;
        }
        if($marca=="beko"){
            $codigo2=14;
        }
        if($marca=="siemens"){
            $codigo2=15;
        }
        if($marca=="aeg"){
            $codigo2=16;
        }
        if($marca=="bosch"){
            $codigo2=17;
        }
        if($marca=="fagor"){
            $codigo2=18;
        }
    }
    print'<br>Datos nuevos de la compra:<br>DNI:'.$dni.'<br>Tipo: '.$tipo.'<br>Marca: '.$marca.'<br>Código del electrodoméstico: '.$codigo2.'<br>¡APUNTA EL CODIGO PARA PODER IDENTIFICAR TU ELECTRODOMÉSTICO EN CASO DE MODIFICACIÓN O CANCELACIÓN DE LA COMPRA!';
    mysqli_query($c,"UPDATE $tabla SET codigo_electrodomesticos=$codigo2 WHERE dni='$dni' AND codigo_electrodomesticos=$codigo");
    if (mysqli_errno($c)==0){
        echo "<br><br>Registro actualizado"; 
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
<h2>RELLENA LOS SIGUIENTES CAMPOS PARA MODIFICAR TU COMPRA</h2>
<form action="" method="POST">
<fieldset>
    <label>Introduce tu DNI:</label>
    <input name="dni"/><br>
    <label>Introduce el código del electrodoméstico que compraste</label>
    <input name="codigo"/><br>
    <label>Indique el tipo de electrodoméstico que desea comprar:</label>
    <select name="tipo">
        <option value="lavadora">Lavadora</option>
        <option value="frigorifico">Frigorífico</option>
        <option value="lavavajillas">Lavavajillas</option>
    </select><br>
    <label>Indique la marca del electrodoméstico que desea comprar:</label>
    <select name="marca">
        <option value="balay">Balay</option>
        <option value="beko">Beko</option>
        <option value="siemens">Siemens</option>
        <option value="aeg">AEG</option>
        <option value="bosch">Bosch</option>
        <option value="fagor">Fagor</option>
    </select><br>
    <input name="modificar" type="submit" id="modificar" value="Modificar compra"/>
</fieldset>
</form>
';
}