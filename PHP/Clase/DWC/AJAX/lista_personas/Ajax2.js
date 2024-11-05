class pAJAX {
    constructor() {
        this.p = new XMLHttpRequest();
    }
    // Definir el metodo 

    peticion(url, metodo, fRes = null, param = "") {
        metodo = metodo.toUpperCase();
        if (fRes != null) {
            this.p.onreadystatechange = function () {
                if ((this.readyState == 4) && (this.status == 200)) {
                    fRes(JSON.parse(this.responseText));
                    console.log(this.responseText);

                };
            }
        }
        if (metodo == "GET") {
            if (param.trim().length > 0)
                url += "?" + param;
            this.p.open(metodo, url);
            this.p.send();


        }

        if (metodo == "POST") {
            this.p.open(metodo, url);
            this.p.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            this.p.send(param);
        }

    }
}