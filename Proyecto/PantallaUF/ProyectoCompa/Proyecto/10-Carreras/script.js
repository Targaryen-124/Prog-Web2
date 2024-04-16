function mostrarPrecio() {
    let productoSeleccionado = document.getElementById("producto");
    let precioLabel = document.getElementById("precio");

    if (productoSeleccionado.value === "maiz") {
        precioLabel.textContent = 1.50;
    } else if (productoSeleccionado.value === "frijol") {
        precioLabel.textContent = 2.00;
    } else if (productoSeleccionado.value === "arroz") {
        precioLabel.textContent = 1.00;
    }
    else
    precioLabel.textContent = "";
}

function calcular(){
    let precio = parseFloat(document.getElementById("precio").textContent);
    let cantidad = parseFloat(document.getElementById("cantidad").value);
    let subtlbl = document.getElementById("subtotal");
    let implbl = document.getElementById("impuesto");
    let totlbl = document.getElementById("total");
    let subtotal;
    let imp;
    let total;

    subtotal = precio * cantidad;
    imp = subtotal * 0.20;
    total = subtotal + imp;
    
    subtlbl.textContent = subtotal;
    implbl.textContent = imp;
    totlbl.textContent = total;

}

var contmaiz=0;
var contfrijol=0;
var contarroz=0;

function agregar(){
    let cod = document.getElementById("codExpor").value;
    let producto = document.getElementById("producto").value;
    let precio = document.getElementById("precio").textContent;
    let cantidad = document.getElementById("cantidad").value;
    let subtotal = document.getElementById("subtotal").textContent;
    let imp = document.getElementById("impuesto").textContent;
    let total = document.getElementById("total").textContent;
    

    let registro = "<tr><td>" + cod + "</td><td>" + producto + "</td><td>" + precio + "</td><td>" + cantidad + "</td><td>" + subtotal + "</td><td>" + imp + "</td><td>" + total + "  </td><td><button class='btnDel' onclick='eliminar(event);'>Eliminar</button></td></tr>";
    let fila = document.createElement("tr");
    fila.innerHTML = registro;

    document.getElementById("grilla").appendChild(fila);

    if(producto == "maiz")
        contmaiz++;
    else if(producto == "frijol")
        contfrijol++
    else if(producto == "arroz")
        contarroz++;
       

    
}

function eliminar(evento){
    if(confirm('Está seguro que desea eliminar este registro?'))
    {
        let fila = evento.target.parentNode.parentNode;
        let celdas = fila.getElementsByTagName("td");

        if(celdas[2].innerHTML == "maiz")
            contmaiz--;
        else if(celdas[2].innerHTML == "frijol")
            contfrijol--;
        else if(celdas[2].innerHTML == "arroz")
            contarroz--;
      

        fila.remove();
    }   
    
}

function generarGrafico(){
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(grafico);


    function grafico(){
        let data = google.visualization.arrayToDataTable([
            ['Producto', 'Producto'],
            ['Maiz', contmaiz],
            ['frijol', contfrijol],
            ['arroz', contarroz],
            
        ]);

        let options = {
            title: 'Exportacion por producto'
        };

        let chart = new google.visualization.BarChart(document.getElementById("pieChart"));
        chart.draw(data, options);
    }
}

