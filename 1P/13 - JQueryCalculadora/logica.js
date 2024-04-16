function soloNumeros(e){
    let key = e.keyCode || e.which;
    let tecla = String.fromCharCode(key).toLocaleLowerCase();
    let numeros = "0123456789";

    if(numeros.indexOf(tecla) == -1)
        return false;
}



function calcular(){

    let operacion = document.getElementById("operador").value;
    let val1 = parseInt(document.getElementById("valor1").value);
    let val2 = parseInt(document.getElementById("valor2").value);
    let resultado;

    if(operacion == "suma")
    {
        resultado = val1 + val2;
        //document.getElementById("resultado").innerHTML = resultado;
        $("#resultado").text(resultado);
    }
    else if(operacion == "resta")
    {
        resultado = val1 - val2;
        $("#resultado").text(resultado);
    }
    else if(operacion == "mult")
    {
        resultado = val1 * val2;
        $("#resultado").text(resultado);
    }
        else if(operacion == "div")
    {
        if(val2 == 0)
        {
            $("#resultado").text("No existe la división entre cero.");
        }
        else
        {
            resultado = val1 / val2;
            $("#resultado").text(resultado);

            const autoNumericOptions = {
                decimalPlaces       : '2',
                decimalCharacater   : '.'
            };

            let myNummericText = new AutoNumeric("#resultado", autoNumericOptions);
        }
        
    }
}



function cancelar(){
    document.getElementById("operador").value = "";
    document.getElementById("valor1").value = "";
    document.getElementById("valor2").value = "";
    
}
