function cargarSubDepto() {
  var array = [
    "INFRAESTRUCTURA",
    "MANTENCION",
    "SERV_LOGISTICA",
    "APOYO_HOSPITALARIO",
    "PROYECTOS",
    "OPERACIONES",
  ];
  array.sort();
  addOptions("sub_depto", array);
}

//Función para agregar opciones a un <select>.
function addOptions(domElement, array) {
  var selector = document.getElementsByName(domElement)[0];
  for (sub_depto in array) {
    var opcion = document.createElement("option");
    opcion.text = array[sub_depto];
    // Añadimos un value a los option para hacer mas facil escoger los unidades
    opcion.value = array[sub_depto].toLowerCase();
    selector.add(opcion);
  }
}

function cargarUnidades() {
  // Objeto de sub_deptos con unidades
  var listaUnidad = {
    infraestructura: ["CARPINTERIA", "GASFITERIA", "SOLDADURIA"],
    mantencion: [
      "EQPS MEDICOS",
      "EQPS INDUSTRIALES",
      "REDES ELECTRICAS",
      "GASES CLINICOS",
    ],
    serv_logistica: ["LOGISTICA", "MOVILIZACION"],
    apoyo_hospitalario: ["LAVANDERIA", "UCP"],
  };

  var sub_deptos = document.getElementById("sub_depto");
  var unidades = document.getElementById("unidad");
  var sub_deptoSeleccionada = sub_deptos.value;

  // Se limpian los unidades
  unidades.innerHTML =
    '<option value="" style="background-color: rgb(14, 247, 169);">SELECCIONE</option>';

  if (sub_deptoSeleccionada !== "") {
    // Se seleccionan los unidades y se ordenan
    sub_deptoSeleccionada = listaUnidad[sub_deptoSeleccionada];
    sub_deptoSeleccionada.sort();

    // Insertamos los unidades
    sub_deptoSeleccionada.forEach(function (unidad) {
      let opcion = document.createElement("option");
      opcion.value = unidad;
      opcion.text = unidad;
      unidades.add(opcion);
    });
  }
}

// Iniciar la carga de sub_deptos solo para comprobar que funciona
cargarSubDepto();

// Funcion de Calculo
function calculoPorCantidad() {
  var totalNetos = 0;
  var totalIvas = 0;
  var totales = 0;

  for (var i = 1; i <= 20; i++) {
    var cantidad = parseFloat(document.getElementById("cantidad_" + i).value);
    var valorUnitario = parseFloat(
      document.getElementById("valor_unitario_" + i).value
    );

    var valorNeto = cantidad * valorUnitario;
    var valorIva = valorNeto * 0.19;
    var valorTotal = valorNeto + valorIva;

    document.getElementById("neto_" + i).value = valorNeto.toFixed(2);
    document.getElementById("iva_" + i).value = valorIva.toFixed(2);
    document.getElementById("total_" + i).value = valorTotal.toFixed(2);

    totalNetos += valorNeto;
    totalIvas += valorIva;
    totales += valorTotal;
  }

  var formatNetos = new Intl.NumberFormat("es-CL", {
    style: "currency",
    currency: "CLP",
  }).format(totalNetos);
  var formatIvas = new Intl.NumberFormat("es-CL", {
    style: "currency",
    currency: "CLP",
  }).format(totalIvas);
  var formatTotales = new Intl.NumberFormat("es-CL", {
    style: "currency",
    currency: "CLP",
  }).format(totales);

  document.getElementById("totalNetos").value = formatNetos;
  document.getElementById("totalIvas").value = formatIvas;
  document.getElementById("totales").value = formatTotales;
}

function empresas() {
  var empresa = document.getElementById("empresa").value;

  var empresasRut = {
    "A&O SERV. Y CONSTRUCCIONES LTDA": "76961393-5",
    "ACRILICOS ACRILANDIA SPA": "76700764-7",
    "ADVANCED STERILIZATION PRODUCTS CHILE  SPA": "76994168-1",
    "AGENCIAS INTERNACIONALES S.A.": "76824390-5",
    "AGUAS DECIMAS S.A.": "96703230-1",
    "AGUASIN SPA": "76377649-2",
    "AGUIRRE, BRAVO Y MELLADO LTDA (ABMEDICAL)": "76047684-6",
    "AILLAPAN MELLA EQUIPOS MEDICOS LTDA": "77115243-0",
    "ANALISIS AMBIENTALES S.A": "96967550-1",
    "ANDOVER ALIANZA MEDICA S.A": "96625550-1",
    "ARTURO RODRIGUEZ LOPEZ": "7971593-K",
    "ASCENSORES SCHINDLER (CHILE) S.A.": "93565000-3",
    "ASESORIA E ING DRJ LTDA": "76110429-2",
    "B BRAUN MEDICAL SPA": "96765540-7",
    "BLUEMEDICAL SPA": "76116604-2",
    "CARESTREAM HEALTH CHILE LTDA": "76773210-4",
    "COMERC. E INDUSTRIAL INQUINAT CHILE LTDA.": "78931720-8",
    "COMERCIAL BYG LTDA": "76397903-2",
    "COMERCIAL DIMARA LTDA": "76117739-7",
    "COMERCIAL KENDALL CHILE LTDA": "77237150-0",
    "COMERCIALIZADORA SMARTVISION LTDA": "77911810-K",
    "CONSTRUCTORA BELARMINO JARA LTDA": "76519518-7",
    "COTACO LTDA.": "81286300-2",
    "DESARROLLO DE TECNOLOGIAS Y SISTEMAS LTDA": "78080440-8",
  };

  var rut = empresasRut[empresa];

  if (rut) {
    document.getElementById("rut").value = rut;
  }
}

function asignarCargo(refId, cargoId) {
  var ref = document.getElementById(refId).value;
  var cargo = document.getElementById(cargoId);

  if (ref === "0") {
    cargo.value = "0";
  } else if (ref === "NARUTO UZUMAKI") {
    cargo.value = "ING.EQUIPOS INDUSTRIALES";
  } else if (ref === "SENKU ISHIGAMI") {
    cargo.value = "ING.CIVIL BIOMEDICO";
  } else if (ref === "IPPO MAKUNOUCHI") {
    cargo.value = "CONSTRUCTOR CIVIL";
  }
}

function refTec1() {
  asignarCargo("ref_tec_1", "cargo_ref_tec_1");
}

function refTec2() {
  asignarCargo("ref_tec_2", "cargo_ref_tec_2");
}

function correo_respon() {
  var responsable = document.getElementById("responsable").value;

  if (responsable === "0") {
    document.getElementById("correo_responsable").value = "0";
  } else if (responsable === "BAKI HANMA") {
    document.getElementById("correo_responsable").value =
      "baki.hanma@gmail.com";
  } else if (responsable === "RETSU KAIOH") {
    document.getElementById("correo_responsable").value =
      "retsu.kaioh@gmail.com";
  } else if (responsable === "JACK HANMA") {
    document.getElementById("correo_responsable").value =
      "jack.hanma@gmail.com";
  }
}

function correo_eject() {
  var ejecutivo_compra = document.getElementById("ejecutivo_compra").value;

  if (ejecutivo_compra === "0") {
    document.getElementById("correo_ejecutivo").value = "0";
  } else if (ejecutivo_compra === "YUICHIRO HANMA") {
    document.getElementById("correo_ejecutivo").value =
      "yuichiro.kaioh@gmail.com";
  } else if (ejecutivo_compra === "YUJIRO HANMA") {
    document.getElementById("correo_ejecutivo").value =
      "yujiro.hanma@gmail.com";
  }
}
