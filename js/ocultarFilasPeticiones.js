// ----------------------- Buscardor Equipos --------------------------------------------------------->
function buscar_equipo(numero_equipo, buscar_eq) {
    var parametros = {
        "buscar": buscar_eq
    };
    $.ajax({
        data: parametros,
        type: 'POST',
        url: '../../procesos/buscar/buscador_proc_pet_eq.php',
        success: function (data) {
            document.getElementById("equipo_" + numero_equipo).innerHTML = data;
        }
    });
}


// ----------------------- Buscardor Cod Manager --------------------------------------------------------->
function buscar_producto(numero_producto, buscar) {
    var parametros = {
        "buscar": buscar
    };
    $.ajax({
        data: parametros,
        type: 'POST',
        url: '../../procesos/buscar/buscador_proc_pet_cm.php',
        success: function (data) {
            document.getElementById("producto_" + numero_producto).innerHTML = data;
        }
    });
}


// ----------------------- Ocultar filas --------------------------------------------------------->

// Ocultar filas automaticamente
$(document).ready(function () {
    $(".eqs").css("display", "none");
});


// Verificar si las filas contienen datos (si es asi, se mostraran)
$(document).ready(function () {
    for (var i = 5; i <= 20; i++) {
        if ($("#equipo_" + i).val() !== "") {
            $('.eqs_' + (i - 4)).show();
        } else {
            break; // Detener el bucle si no se cumple la condición
        }
    }
});



// Ocultar filas (con ingreso de un numero)
$(document).ready(function () {
    $("#filas").on("input", function () {
        var numfilas = parseInt($("#filas").val());

        var maxFilas = 16;
        if (numfilas > maxFilas) {
            numfilas = maxFilas;
        }

        // Ocultar todos los elementos
        $('.eqs').hide();

        for (var i = 1; i <= numfilas; i++) {
            $('.eqs_' + i).show();
        }
    });
});



// Ocultar filas sin datos (proceso administrativo)
$(function () {
    let cods = [
        $('#buscar').val(),
        $('#buscar_2').val(),
        $('#buscar_3').val(),
        $('#buscar_4').val(),
        $('#buscar_5').val(),
        $('#buscar_6').val(),
        $('#buscar_7').val(),
        $('#buscar_8').val(),
        $('#buscar_9').val(),
        $('#buscar_10').val(),
        $('#buscar_11').val(),
        $('#buscar_12').val(),
        $('#buscar_13').val(),
        $('#buscar_14').val(),
        $('#buscar_15').val(),
        $('#buscar_16').val(),
        $('#buscar_17').val(),
        $('#buscar_18').val(),
        $('#buscar_19').val(),
        $('#buscar_20').val()
    ];

    $.each(cods, function (i, cod) {
        if (cod === '0') {
            $('#sec-' + (i + 1)).hide();
        }
    });
});
