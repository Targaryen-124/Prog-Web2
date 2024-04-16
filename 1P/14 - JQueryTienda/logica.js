function soloNumeros(e){
    let key = e.keyCode || e.which;
    let tecla = String.fromCharCode(key).toLocaleLowerCase();
    let numeros = "0123456789";

    if(numeros.indexOf(tecla) == -1)
        return false;
}

function cargarProductos(){

    $("#producto option").remove();

    let categoria = $("#categoria").val();

    $("#producto").append("<option>Seleccione Producto</option>")

    if(categoria == "damas")
    {
        $("#producto").append("<option value='blusa'>Blusa L 500.00</option>");
        $("#producto").append("<option value='vestido'>Vestido L 2,000.00</option>");
    }

    if(categoria == "caballeros")
    {
        $("#producto").append("<option value='jeans'>Jeans L 700.00</option>");
        $("#producto").append("<option value='zapatilla'>Zapatillas L 1,500.00</option>");
    }

    if(categoria == "niños")
    {
        $("#producto").append("<option value='juguete'>Juguete L 400.00</option>");
    }
}

function mostrarPrecio(){
    if($("#producto").val() == "blusa"){
        $("#precio").text("500");
        $("#precio").val(500);
    }
        
    if($("#producto").val() == "vestido"){
        $("#precio").text("2000");
        $("#precio").val(2000);
    }
        
    if($("#producto").val() == "jeans"){
        $("#precio").text("700");
        $("#precio").val(700);
    }
        
    if($("#producto").val() == "zapatilla"){
        $("#precio").text("1500");
        $("#precio").val(1500);
    }
        
    if($("#producto").val() == "juguete"){
        $("#precio").text("400");
        $("#precio").val(400);
    }
        
}

function cancelar(){
    document.getElementById("categoria").value = "";
    document.getElementById("producto").value = "";
    document.getElementById("cantidad").value = "";
    $("#precio").text("");
    $("#subtotal").text("");
    $("#isv").text("");
    $("#descuento").text("");
    $("#total").text("");
    document.getElementById("categoria").focus();
}

function calcular(){
    let cantidad = $("#cantidad").val();
    let precio = $("#precio").val();
    let subtotal = cantidad*precio;
    let imp = subtotal*0.15;
    let desc = 0;
    let total = subtotal+imp-desc;
    $("#subtotal").text(subtotal);
    $("#isv").text(imp);
    $("#descuento").text(desc);
    $("#total").text(total);

}