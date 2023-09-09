// ----------------------- Ocultar filas --------------------------------------------------------->

// Ocultar filas automaticamente
$(document).ready(function () {
    $(".mts").css("display", "none");
});


// Verificar si las filas contienen datos (si es asi, se mostraran)
$(document).ready(function () {
    for (var i = 1; i <= 12; i++) {
        if ($("#programado_" + i).val() !== "") {
            $('.mts_' + i).show();
        } else {
            break; // Detener el bucle si no se cumple la condición
        }
    }
});



// Ocultar filas (con ingreso de un numero)
$(document).ready(function () {
    $("#mostrarFilas").click(function () {
        var numfilas = parseInt($("#n_manten_preventivas").val());

        // Ocultar todos los elementos generados previamente
        $('.mts').hide();

        if (!isNaN(numfilas) && numfilas >= 1 && numfilas <= 12) {
            for (var i = 1; i <= numfilas; i++) {
                $('.mts_' + i).show();
            }
        }
    });
});

// Borrar filas (boton)
$(document).ready(function () {
    $("#borrarFilas").click(function () {
        var numfilas = parseInt($("#n_manten_preventivas").val());

        if (!isNaN(numfilas) && numfilas >= 1 && numfilas <= 12) {
            for (var i = 1; i <= numfilas; i++) {
                $('.mts_' + i).hide();
            }
        }
    });
});