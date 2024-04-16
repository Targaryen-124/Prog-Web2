
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo_tv.css">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div  id="general">
    <?php
        include "conexion.php";
        $con = new conexion();
        $sql = "SELECT * FROM publicidad WHERE estado='Activo' AND estado_TV='Mostrando'";
        $resultado = $con->consulta($sql);

        foreach ($resultado as $data) {
            if($data['formato']==="Video"){
                $Videos[] = $data['imagen'];
            }else{
                $imagenes[] = $data['imagen'];
            } 
        }
        ?>
        
        <div id="part1" name="part1" >
            <?php if (!empty($Videos)) {?>
                <video id="videoPlayer" muted autoplay style="width: 100%; height: 100%; object-fit: cover; border-radius: 45px;">
                    <source src="<?php echo $Videos[0]; ?>" type="video/mp4">
                </video>
                <script>
                    var videoPlayer = document.getElementById("videoPlayer");
                    var currentVideoIndex = 0;
                    var videos = <?php echo json_encode($Videos); ?>;

                    function playNextVideo() {
                        currentVideoIndex = (currentVideoIndex + 1) % videos.length;
                        videoPlayer.src = videos[currentVideoIndex];
                        videoPlayer.play();
                    }

                    videoPlayer.addEventListener('ended', function() {
                        playNextVideo();
                    });

                    // Reproduce el primer video
                    videoPlayer.play();
                </script>
            <?php } else if(!empty($imagenes)) { ?>
                    <div class="container-carousel">
                        <div class="carruseles" id="slider">
                            <?php foreach ($imagenes as $imagen) : ?>
                                <section class="slider-section"><img src="<?php echo $imagen; ?>" alt=""></section>
                            <?php endforeach; ?>
                        </div>
                        <div class="btn-left"></div>
                        <div class="btn-right"></div>
                    </div>
            <?php } ?>
        </div>

<script>
    var source = new EventSource("llamarPublicidad.php");
    var verf;
    var i = 1;
    var tam=0;
    var tipoAlm="";
    var j=1;
    source.onmessage = function(event) {
        if (event.data.trim() !== "") {
            var mensaje = JSON.parse(event.data);
            if(j==0){
                tam=mensaje.length;
                tipoAlm=mensaje[0].tipo;
            }
            j++;
            if (mensaje[0].tipo === 'Video') {
                console.log("Ingreso a Video");
                if(tipoAlm!=mensaje[0].tipo){
                    location.reload();
                }
                if(tam!=mensaje.length){
                    location.reload();
                    var videoPlayer = document.getElementById("videoPlayer");
                    videoPlayer.src = mensaje[0].contenido;
                    var currentVideoIndex = 0;
                        var videos =  json_encode(mensaje[0].tipo);

                        function playNextVideo() {
                            currentVideoIndex = (currentVideoIndex + 1) % videos.length;
                            videoPlayer.src = videos[currentVideoIndex];
                            videoPlayer.play();
                        }

                        videoPlayer.addEventListener('ended', function() {
                            playNextVideo();
                        });
                        videoPlayer.play();
                }

            } else if (mensaje[0].tipo === 'Imagen') {
                    var imagenes = mensaje;
                    if(tipoAlm!=mensaje[0].tipo){
                        location.reload();
                    }
                    console.log("Img"+imagenes.length);
                    var slider = document.getElementById("slider");
                    slider.innerHTML = "";
                    if (imagenes.length > 0) {

                        if(i==1){
                            verf=imagenes.length;
                            i++;
                        }
                        if(verf!=imagenes.length){
                            location.reload();
                        }
                        imagenes.forEach(function(imageObject, index) {
                        var imgElement = document.createElement("img");
                        imgElement.src = imageObject.contenido;
                        var sectionElement = document.createElement("section");
                        sectionElement.className = "slider-section";
                        sectionElement.appendChild(imgElement);
                        slider.appendChild(sectionElement);
                    if(imagenes.length==1){
                        slider.style.width = (300) + "%";
                    }else if(imagenes.length==2){
                        slider.style.width = (imagenes.length*150) + "%";
                    }else{
                    slider.style.width = (imagenes.length*100) + "%";
                    }
                    });
                    }else{
                        slider.innerHTML = "<p>No hay imágenes disponibles.</p>";
                        
                    }
            }
        }
    };
</script>
<script src="logica.js"></script>

        <div id="part2" name="part2">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>Turno</th>
                            <th>ESCRITORIO</th>
                        </tr>
                    </thead>
                    <tbody id="data-container">

                    </tbody>
                </table>
            </div>
            <script>
                var source = new EventSource("fetch.php");
                source.onmessage = function (event) {
                    var arrayData = JSON.parse(event.data);
                    var dataContainer = document.querySelector('tbody')
                    dataContainer.innerHTML = ''
                    arrayData.forEach(e => {
                        dataContainer.innerHTML += `
                            <tr>
                                <td>${e.codigo}</td>
                                <td>${e.descripcion}</td>
                            </tr>
                        `;
                    });
                }
            </script>
        </div>

        <div id="part3" name="part3">
            <marquee class="marq" scrollamount="20" behavior="" direction="">EL PRESTIGIO QUE RESPALDA TU CALIDAD
                ACADÉMICA</marquee>
        </div>
        <script>
    var source = new EventSource("llamarTexto.php");
    source.onmessage = function (event) {
        var arrayData = JSON.parse(event.data);
        var concatenatedText = '';
        arrayData.forEach(e => {
            concatenatedText += e.descripcion + '  '+' ------- '; 
        });


        var marquee = document.querySelector('.marq');
        marquee.textContent = concatenatedText;
    }
</script>
<script>
    var source = new EventSource("llamarModal.php");
    var j=0;
    source.onmessage = function (event) {
        if (event.data.trim() !== "") {
            var data = event.data.split(",");
            var codigo = data[0];
            var descripcion = data[1];
  
            var matches = codigo.match(/\d+/); 
            var numero = "Ticket " + matches[0] + "Pasar a "+descripcion; 
        
            var synthesis = window.speechSynthesis;
            var utterance = new SpeechSynthesisUtterance(numero);
            var voices = synthesis.getVoices();

            utterance.voice = voices[3];

            utterance.rate = 1;

            localStorage.setItem('idTicket', codigo);
            localStorage.setItem('mesa', descripcion);
            $('#idTicket').text(codigo);
            $('#mesa').text(descripcion);
            $('#llamar').modal('show');
            synthesis.speak(utterance);
            $.ajax({
                    url: 'actualizarTick.php', 
                    type: 'POST',
                    data: { codigo: codigo }, 
                    success: function (response) {
                        
                    },
                    error: function (xhr, status, error) {

                    }
            });
            setTimeout(function() {
            $('#llamar').modal('hide');
            }, 5000);
        }    
    };
</script>
<?php include "LlamarTK.php"; ?>
</div>

</body>

</html>