<?php
    
    include("encabezado.php");

    $_SESSION['pagina'] = basename(__FILE__);
?>

<?php
    /*$conect = new conexion();
    $query = "INSERT INTO `cargo` (`idcargo`, `cargo`) VALUES (NULL, 'Gerente Financiero');";
    $conect->probar($query);*/
?>

<div class="wrapper">
    <div class="container-fluid">
            <div class="row">
                
                <div class="col-md-6">
                    <img id="logo" src="icons/logo.png" alt="" style="width: 350px; height: 350px; position: absolute; left:270px;">                       
                </div>
                
                <div class="col-md-6">
                    <h1 class="display-3" style="color: black;">Bienvenido</h1>            
                    <p class="lead" style="color: black;">MegaMarket te da la bienvenida a nuestro sitio oficial
                    en el que encontraras todo lo relacionado con las operaciones de compra y venta de nuestros productos.</p>
                    <hr class="my-2">
                    <button class="btn btn-success" type="button">Mas Informacion</button>                
                </div>
             </div>
        
    </div>
    
</div>
        
        