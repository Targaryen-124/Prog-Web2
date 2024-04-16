function soloNumeros(e) {
    let key = e.keyCode || e.which //devuelte el codigo la tecla presionada
    let tecla = String.fromCodePoint(key).toLocaleLowerCase();
    let numeros = "0123456789";

    if (numeros.indexOf(tecla) == -1)
        return false;
}

function soloLetras(e) {
    let key = e.keyCode || e.which //devuelte el codigo la tecla presionada
    let tecla = String.fromCodePoint(key).toLocaleLowerCase();
    let letras = "áéíou abcdefghijklmnopqrstuvwxyz";

    if (letras.indexOf(tecla) == -1)
        return false;
}

var contComp = 0;
var contInd = 0;
var contElec = 0;
var contNeg = 0;

function agregar() {
    let id = document.getElementById("id").value;
    let nombre = document.getElementById("nombre").value;
    let edad = document.getElementById("edad").value;
    let carrera = document.getElementById("carrera").value;
    let fecha = document.getElementById("fecha").value;

    let registro = "<tr><td>" + id + "</td>" + "<td>" + nombre + "</td>" + "<td>" + edad + "</td>" + "<td>" + carrera + "</td>" + "<td>" + fecha + "</td><td><button class='btnDel' onclick='eliminar(event);'>Eliminar</button></td></tr>";
    let fila = document.createElement("tr");
    fila.innerHTML = registro;

    document.getElementById("grilla").appendChild(fila);

    if (carrera == "computacion") {
        contComp++;
    } else if (carrera == "industrial") {
        contInd++;
    } else if (carrera == "electronica") {
        contElec++;
    } else {
        contNeg++;
    }
}

function eliminar(evento) {
    if (confirm("Esta Seguro que desea Eliminar este registro?")) {
        let fila = evento.target.parentNode.parentNode;
        let celdas = fila.getElementsByTagName("td");

        if (celdas[3].innerHTML == "computacion") {
            contComp--;
        } else if (celdas[3].innerHTML == "industrial") {
            contInd--;
        } else if (celdas[3].innerHTML == "electronica") {
            contInd--;
        } else {
            contNeg--;
        }

        fila.remove();
    }
}

function cancelar(){
    document.getElementById("id").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("edad").value = "";
    document.getElementById("carrera").value = "";
    document.getElementById("fecha").value = "";
    document.getElementById("id").focus();
}

function generarGrafico(){
    google.charts.load('current',{'packages': ['corechart']});
    google.charts.setOnLoadCallback(grafico);

    function grafico(){
        let data = google.visualization.arrayToDataTable([
            ['Carrera' , 'Matriculados por Carrera'],
            ['Computacion' , contComp],
            ['Industrial' , contInd],
            ['Electronica' , contElec],
            ['Negocios' , contNeg]
        ]);

        let options = {
            title:'Matriculados por Carrera'
        };

        let chart = new google.visualization.PieChart(document.getElementById("pieChart"));
        chart.draw(data , options);
    }
}