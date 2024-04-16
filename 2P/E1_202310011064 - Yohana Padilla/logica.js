function soloNumeros(e) {
    let key = e.keyCode || e.which;
    let tecla = String.fromCharCode(key).toLocaleLowerCase();
    let numeros = "0123456789";

    if (numeros.indexOf(tecla) == -1)
        return false;
}

function soloLetras(e) {
    let key = e.keyCode || e.which;
    let tecla = String.fromCharCode(key).toLocaleLowerCase();
    let letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";

    if (letras.indexOf(tecla) == -1)
        return false;
}

var personas = new Array();
var cp = 0;
var nombre;
var edad;
var sexo;
var peso;
var depto;

function agregar() {
    let nombre = document.getElementById("nombre").value;
    let edad = document.getElementById("edad").value;
    let sexo = document.getElementById("sexo").value;
    let peso = document.getElementById("peso").value;

    personas[cp + .0] = nombre;
    personas[cp + .1] = edad;
    personas[cp + .2] = sexo;
    personas[cp + .3] = peso;
    personas[cp + .4] = depto;

    alert((cp + 1) + " - " + personas[cp + .0] + ", de sexo " + personas[cp + 0.2] + " ha sido registrado correctamente en el departamento de " + personas[cp + 0.4]);

    cp++;

    document.getElementById("nombre").value = "";
    document.getElementById("edad").value = "";
    document.getElementById("sexo").value = "";
    document.getElementById("peso").value = "";
    document.getElementById("nombre").focus();

}


function cancelar() {
    document.getElementById("nombre").value = "";
    document.getElementById("edad").value = "";
    document.getElementById("sexo").value = "";
    document.getElementById("peso").value = "";
    document.getElementById("nombre").focus();
}


function mostrarForm(indice) {
    document.getElementById("datos").style.display = "block";
    depto = indice;
}

function mostrarEstad(indice) {

    promPesoFM = 0;
    contFM = 0;
    promPesoCH = 0;
    contCH = 0;
    promPesoCO = 0;
    contCO = 0
    for (let i = 0; i < cp; i++) {
        //FRANCISCO MORAZAN
        if (personas[i + .4] == 1) {
            promPesoFM = promPesoFM + parseInt(personas[i + .3]);
            contFM++;
        }
            //CHOLUTECA
        if (personas[i + .4] == 2) {
            promPesoCH = promPesoCH + parseInt(personas[i + .3])
            contCH++;
        }
        //CORTES
        if (personas[i + .4] == 3) {
            promPesoCO = promPesoCO + parseInt(personas[i + .3]);
            contCO++;
        }
    }

    promCO=promPesoCO/contCO;
    promCH=promPesoCH/contCH;
    promFM=promPesoFM/contFM;
    generarGrafico();
}

function generarGrafico() {
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(grafico);


    function grafico() {


        let data = google.visualization.arrayToDataTable([
            ['Departamento', 'PesoPromedio', { role: 'style' }],
            ['Cortes', promCO, 'blue'],
            ['Choluteca', promCH, 'green'],
            ['Francisco Morazan', promFM, 'red']
        ]);

        let tituloGrafico;

        if (promPesoCH == 0 && promPesoCO == 0 && promPesoFM == 0)
            tituloGrafico = "Sin registro de personas";
        else
            tituloGrafico = "Prom Peso por Depto";

        let options = {
            title: tituloGrafico
        };

        let chart = new google.visualization.ColumnChart(document.getElementById("ColumnChart"));
        chart.draw(data, options);
    }
}