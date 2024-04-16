
function agregar(){
    let id = document.getElementById("id").value;
    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellido").value;
    let salario = parseInt(document.getElementById("salario").value);
    let edad = parseInt(document.getElementById("edad").value);
    let dir = document.getElementById("dir").value;
    let red = document.getElementById("red").value;
    let imp, salneto;

    if(edad<20 || salario<15000){
        imp=0;
    }
    else if(salario>=15000 && salario<20000){
        imp=0.1;
    }
    else if(salario>=20000){
        imp=0.25;
    }

    if(edad >=60){
        imp-=0.10;
    }
    imp*=salario;


    salneto = salario - imp;

    let registro = "<tr><td>" + id + "</td><td>" + nombre + " " + apellido + "</td><td>" + edad + "</td><td id='sal-prom'>" + salario + "</td><td id='imp-prom'>" + imp + "</td><td id='salneto-prom'>" + salneto + "</td><td>" + "<a href=''>" + red + "</a>" + "</td><td>";
    let fila = document.createElement("tr");
    fila.innerHTML = registro;

    document.getElementById("body").appendChild(fila);

    calcularPromedios();
}

var tabla = document.getElementById("grilla");

// Obtener los labels para mostrar los promedios
var promedioEdadLabel = document.getElementById("prom-edad");
var promedioSalarioLabel = document.getElementById("prom-sal");
var promedioImpuestoLabel = document.getElementById("prom-imp");
var promedioSalarioNetoLabel = document.getElementById("prom-salneto");


function calcularPromedios() {
    var filas = tabla.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    var totalEdad = 0;
    var totalSalario = 0;
    var totalImpuesto = 0;
    var totalSalarioNeto = 0;
    var cantidadRegistros = filas.length;

    for (var i = 0; i < filas.length; i++) {
        var edad = parseFloat(filas[i].getElementsByTagName("td")[2].innerText);
        var salario = parseFloat(filas[i].getElementsByTagName("td")[3].innerText);
        var impuesto = parseFloat(filas[i].getElementsByTagName("td")[4].innerText);
        var salarioNeto = parseFloat(filas[i].getElementsByTagName("td")[5].innerText);

        totalEdad += edad;
        totalSalario += salario;
        totalImpuesto += impuesto;
        totalSalarioNeto += salarioNeto;
    }

    var promedioEdad = totalEdad / cantidadRegistros;
    var promedioSalario = totalSalario / cantidadRegistros;
    var promedioImpuesto = totalImpuesto / cantidadRegistros;
    var promedioSalarioNeto = totalSalarioNeto / cantidadRegistros;

    
    promedioEdadLabel.textContent = promedioEdad.toFixed(2);
    promedioSalarioLabel.textContent = promedioSalario.toFixed(2);
    promedioImpuestoLabel.textContent = promedioImpuesto.toFixed(2);
    promedioSalarioNetoLabel.textContent = promedioSalarioNeto.toFixed(2);
}



