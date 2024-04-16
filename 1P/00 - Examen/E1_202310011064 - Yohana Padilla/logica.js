function soloNumeros(e){
    let key = e.keyCode || e.which;
    let tecla = String.fromCharCode(key).toLocaleLowerCase();
    let numeros = "0123456789";

    if(numeros.indexOf(tecla) == -1)
        return false;
}

function mostrarPrecio(){
    if($("#producto").val() == "maiz"){
        $("#precio").text("$1.50");
        $("#precio").val(1.50);
    }
        
    if($("#producto").val() == "frijol"){
        $("#precio").text("$2.00");
        $("#precio").val(2.00);
    }
        
    if($("#producto").val() == "arroz"){
        $("#precio").text("$1.00");
        $("#precio").val(1.00);
    }      
}

function cancelar(){
    document.getElementById("codExportacion").value = "";
    document.getElementById("producto").value = "";
    document.getElementById("cantidad").value = "";
    $("#precio").text("");
    $("#subtotal").text("");
    $("#isv").text("");
    $("#total").text("");
    document.getElementById("categoria").focus();
}

function calcular(){
    let cantidad = $("#cantidad").val();
    let precio = $("#precio").val();
    let subtotal = cantidad*precio;
    let imp = subtotal*0.20;
    let total = subtotal+imp;
    if (cantidad < 15000){
        alert ('La carga es insuficiente');
        document.getElementById("cantidad").focus();

    } else if (cantidad > 40000){
        alert ('La carga excede el peso máximo');
        document.getElementById("cantidad").focus();

    }else{
        $("#subtotal").text(subtotal);
        $("#subtotal").val(subtotal);
        $("#isv").text(imp);
        $("#isv").val(imp);
        $("#total").text(total);
        $("#total").val(total);
    }
}

var acumMaiz = 0;
var acumFrijol = 0;
var acumArroz = 0;

function activar(){
    $("#total").val(0);
}

function agregar() {
    let codExportacion = document.getElementById("codExportacion").value;
    let producto = document.getElementById("producto").value;
    let precio = $("#precio").val();
    let cantidad = document.getElementById("cantidad").value;
    let subtotal = $("#subtotal").val();
    let isv = $("#isv").val();
    let total = $("#total").val();

    if (total == 0){
        alert ('Favor realizar los Calculos antes de Agregar');

    }else{
        let registro = "<tr><td>" + codExportacion + "</td>" + "<td>" + producto + "</td>" + "<td>" + precio + "</td>" + "<td>" + cantidad + "</td>" + "<td>" + subtotal + "</td>" + "<td>" + isv + "</td>" + "<td>" + total + "</td><td><button class='btnDel' onclick='eliminar(event);'>Eliminar</button></td></tr>";
        let fila = document.createElement("tr");
        fila.innerHTML = registro;

        document.getElementById("grilla").appendChild(fila);

        if (producto == "maiz") {
            acumMaiz = acumMaiz + parseInt(total);
        } else if (producto == "frijol") {
            acumFrijol = acumFrijol + parseInt(total);
        } else {
            acumArroz = acumArroz + parseInt(total);
        }
    }
}

function generarGrafico(){
    google.charts.load('current',{'packages': ['corechart']});
    google.charts.setOnLoadCallback(grafico);

    function grafico(){
        let data = google.visualization.arrayToDataTable([
            ['Producto' , 'Total $ por Producto'],
            ['Maiz' , acumMaiz],
            ['Frijol' , acumFrijol],
            ['Arroz' , acumArroz]
        ]);

        let options = {
            title:'Total $ por Producto'
        };

        let chart = new google.visualization.ColumnChart(document.getElementById("columnChart"));
        chart.draw(data , options);
    }
}

function eliminar(evento) {
    if (confirm("Esta Seguro que desea Eliminar este registro?")) {
        let fila = evento.target.parentNode.parentNode;
        let celdas = fila.getElementsByTagName("td");

        if (celdas[1].innerHTML == "maiz") {
            acumMaiz = acumMaiz - parseInt(total);
        } else if (celdas[1].innerHTML == "frijol") {
            acumFrijol = acumFrijol - parseInt(total);
        } else {
            acumArroz = acumArroz - parseInt(total);
        }

        fila.remove();
    }
}
