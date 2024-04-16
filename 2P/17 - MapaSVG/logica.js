function soloNumeros(e){
    let key = e.keyCode || e.which;
    let tecla = String.fromCharCode(key).toLocaleLowerCase();
    let numeros = "0123456789";

    if(numeros.indexOf(tecla) == -1)
        return false;
}

function soloLetras(e){
    let key = e.keyCode || e.which;
    let tecla = String.fromCharCode(key).toLocaleLowerCase();
    let letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";

    if(letras.indexOf(tecla) == -1)
        return false;
}


var personas = new Array();
var cp = 0;
var contMayores = 0;
var contMenores = 0;
var contMayoresGlobal = 0;
var contMenoresGlobal = 0;


function agregar(){
    let id = document.getElementById("id").value;
    let nombre = document.getElementById("nombre").value;
    let edad = document.getElementById("edad").value;
    let depto = document.getElementById("departamento").value;
  
    personas[cp+.0] = id;
    personas[cp+.1] = nombre;
    personas[cp+.2] = edad;
    personas[cp+.3] = depto;

    
    if(edad >= 18)
        contMayoresGlobal++;
    else
        contMenoresGlobal++;

    alert((cp + 1) + " - " + personas[cp+0.1] + "(" + personas[cp+.0] + "), con " + personas[cp+0.2] + " años, ha sido registrado correctamente en el departamento de " + personas[cp+.3]);

    cp++;

  
}


function cancelar(){
    document.getElementById("id").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("edad").value = "";
    document.getElementById("departamento").value = "";
    document.getElementById("id").focus();
}


function mostrarDatos(indice){

    //FRANCISCO MORAZAN
   
    document.getElementById("datos").style.display = "block";

    contMayores = 0;
    contMenores = 0;

    if(indice == 1)
    {
        for(let i = 0; i < cp; i++)
        {
            if(personas[i+.2] >= 18 && personas[i+.3] == "Francisco Morazan")
                contMayores++;

            if(personas[i+.2] < 18 && personas[i+.3] == "Francisco Morazan")
                contMenores++;
        
        }

        document.getElementById("depto").value = "Francisco Morazan";
        document.getElementById("reg").value = contMayores + contMenores;
        document.getElementById("mayores").value = contMayores;
        document.getElementById("menores").value = contMenores;
    }

    //CHOLUTECA

    if(indice == 2)
    {
        for(let i = 0; i < cp; i++)
        {
            if(personas[i+.2] >= 18 && personas[i+.3] == "Choluteca")
                contMayores++;

            if(personas[i+.2] < 18 && personas[i+.3] == "Choluteca")
                contMenores++;
        
        }

        document.getElementById("depto").value = "Choluteca";
        document.getElementById("reg").value = contMayores + contMenores;
        document.getElementById("mayores").value = contMayores;
        document.getElementById("menores").value = contMenores;
    }


    //CORTES

    if(indice == 3)
    {
        for(let i = 0; i < cp; i++)
        {
            if(personas[i+.2] >= 18 && personas[i+.3] == "Cortes")
                contMayores++;

            if(personas[i+.2] < 18 && personas[i+.3] == "Cortes")
                contMenores++;
        
        }

        document.getElementById("depto").value = "Cortes";
        document.getElementById("reg").value = contMayores + contMenores;
        document.getElementById("mayores").value = contMayores;
        document.getElementById("menores").value = contMenores;
    }

    generarGrafico();
    generarGraficoGlobal();
}



function generarGrafico(){
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(grafico);


    function grafico(){

        
        let data = google.visualization.arrayToDataTable([
            ['Personas', 'Registro de personas'],
            ['Mayores de Edad', contMayores],
            ['Menores de Edad', contMenores]
        ]);

        let tituloGrafico;

        if(contMayores == 0 && contMenores == 0)
            tituloGrafico = "Sin registro de personas";
        else
            tituloGrafico = "Registro de personas en " + document.getElementById("depto").value;

        let options = {
            title: tituloGrafico,
            pieHole: 0.4,
            slices:
            {
                0: {color: "red"},
                1: {color: "blue"}
            },
            backgroundColor:
            {
                fill: "none"
            }
        };

        let chart = new google.visualization.PieChart(document.getElementById("pieChart"));
        chart.draw(data, options);
    }
}


function generarGraficoGlobal(){
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(grafico);


    function grafico(){
        let data = google.visualization.arrayToDataTable([
            ['Personas', 'Registro de personas'],
            ['Mayores de Edad (Global)', contMayoresGlobal],
            ['Menores de Edad (Global)', contMenoresGlobal]
        ]);

        let tituloGrafico;

        if(contMayores == 0 && contMenores == 0)
            tituloGrafico = "Sin registro de personas";
        else
            tituloGrafico = "Registro de personas en Honduras";

        let options = {
            title: tituloGrafico,
            pieHole: 0.4,
            slices:
            {
                0: {color: "green"},
                1: {color: "orange"}
            },
            backgroundColor:
            {
                fill: "none"
            }
        };

        let chart = new google.visualization.PieChart(document.getElementById("pieChart2"));
        chart.draw(data, options);
    }
}