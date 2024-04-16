<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="modal fade" id="llamar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
                <div class="contenido-modal">
                    <input type="hidden" id="codigoTK" value="">
                    <div class="sup">
                            <h1>TURNO</h1>
                            <h2 id="idTicket"></h2>
                        </div>
                    <div class="inf">
                            <h2 id="mesa"></h2>
                    </div>

                    <script>
                        $(document).ready(function(){
                            var k=0;
                        var idTicket = localStorage.getItem('idTicket');
                        var mesa = localStorage.getItem('mesa');
                        $('#idTicket').text(idTicket);
                        $('#mesa').text(mesa);
                        });
                    </script>
    </div>
</div>

</body>
</html>
