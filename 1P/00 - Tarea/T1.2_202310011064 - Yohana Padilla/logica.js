function soloNumeros(e) {
    let key = e.keyCode || e.which //devuelte el codigo la tecla presionada
    let tecla = String.fromCodePoint(key).toLocaleLowerCase();
    let numeros = "0123456789.";

    if (numeros.indexOf(tecla) == -1)
        return false;
}

var contEntradas = 0;
var contPizzas = 0;
var contEspecial = 0;
var contPostre = 0;

var acumPanAjo = 0;
var acumEnsalada = 0;
var acumPizzaPersonal = 0; 
var acumPizzaGrande = 0;
var acumPastaCarbonara = 0;
var acumPastelChocolate = 0;
var acumCopaHelado = 0;

function agregar() {
    let catPlatillo = document.getElementById("catPlatillo").value;
    let platillo = document.getElementById("platillo").value;
    let precio = document.getElementById("precio").value;
    let fecha = document.getElementById("fecha").value;

    let registro = "<tr><td>" + catPlatillo + "</td>" + "<td>" + platillo + "</td>" + "<td>" + precio + "<td>" + fecha + "</td><td><button class='btnDel' onclick='eliminar(event);'>Eliminar</button></td></tr>";
    let fila = document.createElement("tr");
    fila.innerHTML = registro;

    document.getElementById("grilla").appendChild(fila);

    if (catPlatillo == "entradas") {
        contEntradas++;
    } else if (catPlatillo == "pizzas") {
        contPizzas++;
    } else if (catPlatillo == "especial") {
        contEspecial++;
    } else {
        contPostre++;
    }

    if (platillo == "panAjo"){
        acumPanAjo=acumPanAjo+parseFloat(precio);
    } else if (platillo == "ensalada"){
        acumEnsalada=acumEnsalada+parseFloat(precio);
    } else if (platillo == "pizzaPersonal"){
        acumPizzaPersonal=acumPizzaPersonal+parseFloat(precio);
    } else if (platillo == "pizzaGrande"){
        acumPizzaGrande=acumPizzaGrande+parseFloat(precio);
    } else if (platillo == "pastaCarbonara"){
        acumPastaCarbonara=acumPastaCarbonara+parseFloat(precio);
    } else if (platillo == "pastelChocolate"){
        acumPastelChocolate=acumPastelChocolate+parseFloat(precio);
    } else {
        acumCopaHelado=acumCopaHelado+precio;
    }
}

function eliminar(evento) {
    if (confirm("Esta Seguro que desea Eliminar este registro?")) {
        let fila = evento.target.parentNode.parentNode;
        let celdas = fila.getElementsByTagName("td");

        if (celdas[0].innerHTML == "entradas") {
            contEntradas--;
        } else if (celdas[0].innerHTML == "pizzas") {
            contPizzas--;
        } else if (celdas[0].innerHTML == "especial") {
            contEspecial--;
        } else {
            contPostre--;
        }

        fila.remove();
    }
}

function cancelar(){
    document.getElementById("catPlatillo").value = "";
    document.getElementById("platillo").value = "";
    document.getElementById("precio").value = "";
    document.getElementById("fecha").value = "";
    document.getElementById("catPlatillo").focus();
}

function generarGrafico(){
    google.charts.load('current',{'packages': ['corechart']});
    google.charts.setOnLoadCallback(graficoBar);
    google.charts.setOnLoadCallback(graficoPie);

    function graficoPie(){
        let data = google.visualization.arrayToDataTable([
            ['CatPlatillo' , 'Categoria de Platillo'],
            ['Entrada' , contEntradas],
            ['Pizzas' , contPizzas],
            ['Especial' , contEspecial],
            ['Postres' , contPostre]
        ]);

        let options = {
            title:'Categoria de Platillo'
        };

        let chart = new google.visualization.PieChart(document.getElementById("pieChart"));
        chart.draw(data , options);
    }

    function graficoBar(){
        let data = google.visualization.arrayToDataTable([
            ['Platillo' , 'Consumo por Platillo'],
            ['Pan de Ajo' , acumPanAjo],
            ['Ensalada' , acumEnsalada],
            ['Pizza Personal' , acumPizzaPersonal],
            ['Pizza Grande' , acumPizzaGrande],
            ['Pasta Carbonara' , acumPastaCarbonara],
            ['Pastel de Chocolate' , acumPastelChocolate],
            ['Copa de Helado' , acumCopaHelado]
        ]);

        let options = {
            title:'Consumo por Platillo'
        };

        let chart = new google.visualization.BarChart(document.getElementById("barChart"));
        chart.draw(data , options);
    }
}