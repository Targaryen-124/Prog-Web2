function ticket(anterior) {
        let elemento = document.createElement("wrapper2");
        let txto = document.createElement("h1");
        txto.type = "h1";
    
        let codigoN = anterior;

        let texto1 = document.createTextNode(codigoN);
    
        elemento.appendChild(texto1);
    
        let lista = document.getElementById("ticket");
        lista.appendChild(elemento);
    
        date = new Date();
        year = date.getFullYear();
        month = date.getMonth() + 1;
        day = date.getDate();
        hora = date.getHours();
        minutos = date.getMinutes()
        document.getElementById("fecha").innerHTML = "Hoy " +day + "/" + month + "/" + year + " a las " + hora + ":" + minutos;
}
