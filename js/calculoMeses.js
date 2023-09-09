window.onload = function () {
    getToday();
}

function months() {
    var dateTo = new Date(document.getElementById("fecha_inicio_convenio").value);
    var dateFrom = new Date(document.getElementById("fecha_termino_convenio").value);

    if (dateTo !== "" && dateFrom !== "") {

        var mths = dateTo.getMonth() - dateFrom.getMonth() + (12 * (dateTo.getFullYear() - dateFrom.getFullYear()));

        var positive = Math.abs(mths);
        var posAdd = positive + 1;

        document.getElementById("duracion_en_meses").value = posAdd;
    }
}

function maintenance() {

    var dateTo = new Date(document.getElementById("fecha_inicio_convenio").value);
    var dateFrom = new Date(document.getElementById("fecha_termino_convenio").value);
    var valorPeridiocidad = document.getElementById("peridiocidad").value;

    if (dateTo !== "" && dateFrom !== "") {

        var mths = dateTo.getMonth() - dateFrom.getMonth() + (12 * (dateTo.getFullYear() - dateFrom.getFullYear()));

        var positive = Math.abs(mths);
        var posAdd = positive + 1;
        var maintenanceV = posAdd / 12;


        if (valorPeridiocidad === "SEMANAL") {
            var semanal = maintenanceV * 52;
            var semanalR = Math.round(semanal);

            document.getElementById("n_manten_preventivas").value = semanalR;
        }
        else if (valorPeridiocidad === "MENSUAL") {
            var semanal = maintenanceV * 12;
            var semanalR = Math.round(semanal);

            document.getElementById("n_manten_preventivas").value = semanalR;
        }
        else if (valorPeridiocidad === "BIMENSUAL") {
            var semanal = maintenanceV * 6;
            var semanalR = Math.round(semanal);

            document.getElementById("n_manten_preventivas").value = semanalR;
        }
        else if (valorPeridiocidad === "TRIMESTRAL") {
            var semanal = maintenanceV * 4;
            var semanalR = Math.round(semanal);

            document.getElementById("n_manten_preventivas").value = semanalR;
        }
        else if (valorPeridiocidad === "CUATRIMESTRAL") {
            var semanal = maintenanceV * 3;
            var semanalR = Math.round(semanal);

            document.getElementById("n_manten_preventivas").value = semanalR;
        }
        else if (valorPeridiocidad === "SEMESTRAL") {
            var semanal = maintenanceV * 2;
            var semanalR = Math.round(semanal);

            document.getElementById("n_manten_preventivas").value = semanalR;
        }
        else if (valorPeridiocidad === "ANUAL") {
            var semanal = maintenanceV * 1;
            var semanalR = Math.round(semanal);

            document.getElementById("n_manten_preventivas").value = semanalR;
        }
    }
}