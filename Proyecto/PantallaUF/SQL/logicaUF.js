function ticket(anterior) {
        let elemento = document.createElement("wrapper2");
        let txto = document.createElement("h1");
        txto.type = "h1";
    
        let codigoN = anterior;

        let texto1 = document.createTextNode(codigoN);
    
        elemento.appendChild(texto1);
    
        let lista = document.getElementById("ticket");
        lista.appendChild(elemento);
    
        let btngenerar = document.getElementById("generar");
        //btngenerar.disabled = true;
}


