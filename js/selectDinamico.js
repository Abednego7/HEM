function cargarSubDepto() {
  var array = ["INFRAESTRUCTURA", "MANTENCION", "SERV_LOGISTICA", "APOYO_HOSPITALARIO", "PROYECTOS", "OPERACIONES"];
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
    opcion.value = array[sub_depto].toLowerCase()
    selector.add(opcion);
  }
}


function cargarUnidades() {
  // Objeto de sub_deptos con unidades
  var listaUnidad = {
    infraestructura: ["CARPINTERIA", "GASFITERIA", "SOLDADURIA"],
    mantencion: ["EQPS MEDICOS", "EQPS INDUSTRIALES", "REDES ELECTRICAS", "GASES CLINICOS"],
    serv_logistica: ["LOGISTICA", "MOVILIZACION"],
    apoyo_hospitalario: ["LAVANDERIA", "UCP"]
  }

  var sub_deptos = document.getElementById('sub_depto')
  var unidades = document.getElementById('unidad')
  var sub_deptoSeleccionada = sub_deptos.value

  // Se limpian los unidades
  unidades.innerHTML = '<option value="" style="background-color: rgb(14, 247, 169);">SELECCIONE</option>'

  if (sub_deptoSeleccionada !== '') {
    // Se seleccionan los unidades y se ordenan
    sub_deptoSeleccionada = listaUnidad[sub_deptoSeleccionada]
    sub_deptoSeleccionada.sort()

    // Insertamos los unidades
    sub_deptoSeleccionada.forEach(function (unidad) {
      let opcion = document.createElement('option')
      opcion.value = unidad
      opcion.text = unidad
      unidades.add(opcion)
    });
  }

}

// Iniciar la carga de sub_deptos solo para comprobar que funciona    
cargarSubDepto();


// Funcion de Calculo 1
function calculoPorCantidad() {
  var totalNetos = 0;
  var totalIvas = 0;
  var totales = 0;

  for (var i = 1; i <= 20; i++) {
    var cantidad = parseFloat(document.getElementById("cantidad_" + i).value);
    var valorUnitario = parseFloat(document.getElementById("valor_unitario_" + i).value);

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

  var formatNetos = new Intl.NumberFormat('es-CL', { style: 'currency', currency: 'CLP' }).format(totalNetos);
  var formatIvas = new Intl.NumberFormat('es-CL', { style: 'currency', currency: 'CLP' }).format(totalIvas);
  var formatTotales = new Intl.NumberFormat('es-CL', { style: 'currency', currency: 'CLP' }).format(totales);

  document.getElementById("totalNetos").value = formatNetos;
  document.getElementById("totalIvas").value = formatIvas;
  document.getElementById("totales").value = formatTotales;
}


function empresas() {
  var empresa = document.getElementById("empresa").value;

  if (empresa === "A&O SERV. Y CONSTRUCCIONES LTDA") {
    document.getElementById("rut").value = "76961393-5";
  } else if (empresa === "ACRILICOS ACRILANDIA SPA") {
    document.getElementById("rut").value = "76700764-7";
  } else if (empresa === "ADVANCED STERILIZATION PRODUCTS CHILE  SPA") {
    document.getElementById("rut").value = "76994168-1";
  } else if (empresa === "AGENCIAS INTERNACIONALES S.A.") {
    document.getElementById("rut").value = "76824390-5";
  } else if (empresa === "AGUAS DECIMAS S.A.") {
    document.getElementById("rut").value = "96703230-1";
  } else if (empresa === "AGUASIN SPA") {
    document.getElementById("rut").value = "76377649-2";
  } else if (empresa === "AGUIRRE, BRAVO Y MELLADO LTDA (ABMEDICAL)") {
    document.getElementById("rut").value = "76047684-6";
  } else if (empresa === "AILLAPAN MELLA EQUIPOS MEDICOS LTDA") {
    document.getElementById("rut").value = "77115243-0";
  } else if (empresa === "ANALISIS AMBIENTALES S.A") {
    document.getElementById("rut").value = "96967550-1";
  } else if (empresa === "ANDOVER ALIANZA MEDICA S.A") {
    document.getElementById("rut").value = "96625550-1";
  } else if (empresa === "ARTURO RODRIGUEZ LOPEZ") {
    document.getElementById("rut").value = "7971593-K";
  } else if (empresa === "ASCENSORES SCHINDLER (CHILE) S.A.") {
    document.getElementById("rut").value = "93565000-3";
  } else if (empresa === "ASESORIA E ING DRJ LTDA") {
    document.getElementById("rut").value = "76110429-2";
  } else if (empresa === "B BRAUN MEDICAL SPA") {
    document.getElementById("rut").value = "96765540-7";
  } else if (empresa === "BLUEMEDICAL SPA") {
    document.getElementById("rut").value = "76116604-2";
  } else if (empresa === "CARESTREAM HEALTH CHILE LTDA") {
    document.getElementById("rut").value = "76773210-4";
  } else if (empresa === "COMERC. E INDUSTRIAL INQUINAT CHILE LTDA.") {
    document.getElementById("rut").value = "78931720-8";
  } else if (empresa === "COMERCIAL BYG LTDA") {
    document.getElementById("rut").value = "76397903-2";
  } else if (empresa === "COMERCIAL DIMARA LTDA") {
    document.getElementById("rut").value = "76117739-7";
  } else if (empresa === "COMERCIAL KENDALL CHILE LTDA") {
    document.getElementById("rut").value = "77237150-0";
  } else if (empresa === "COMERCIALIZADORA SMARTVISION LTDA") {
    document.getElementById("rut").value = "77911810-K";
  } else if (empresa === "CONSTRUCTORA BELARMINO JARA LTDA") {
    document.getElementById("rut").value = "76519518-7";
  } else if (empresa === "COTACO LTDA.") {
    document.getElementById("rut").value = "81286300-2";
  } else if (empresa === "DESARROLLO DE TECNOLOGIAS Y SISTEMAS LTDA") {
    document.getElementById("rut").value = "78080440-8";
  } else if (empresa === "DISTRIBUIDORA Y COMERCIAL DE EQUIPOS ELECTRONICOS INTEGRAL SERVICE LTDA") {
    document.getElementById("rut").value = "77662190-0";
  } else if (empresa === "DRAGER CHILE LTDA") {
    document.getElementById("rut").value = "76033880-K";
  } else if (empresa === "ECM INGENIERIA S.A.") {
    document.getElementById("rut").value = "89630400-3";
  } else if (empresa === "ELECTROM S.A.") {
    document.getElementById("rut").value = "96355000-6";
  } else if (empresa === "ENDOS LTDA") {
    document.getElementById("rut").value = "76756755-3";
  } else if (empresa === "ENEL DISTRIBUCIÓN CHILE S.A.") {
    document.getElementById("rut").value = "96800570-7";
  } else if (empresa === "ENRIQUE VAZQUEZ Y CIA LTDA. (PROCOMED)") {
    document.getElementById("rut").value = "76216036-6";
  } else if (empresa === "ENTIDAD TECNICA MONITOREO AGUAS SPA (ETMA)") {
    document.getElementById("rut").value = "76811248-7";
  } else if (empresa === "EQUIMED ELECTRONICA LTDA") {
    document.getElementById("rut").value = "77017950-5";
  } else if (empresa === "EXTINTORES ALFA VALDIVIA SPA") {
    document.getElementById("rut").value = "76356363-4";
  } else if (empresa === "FERNANDO ALBERTO VELOSO OLIVA") {
    document.getElementById("rut").value = "14205876-6";
  } else if (empresa === "FUENTES Y LONCOMIL LTDA. (CORIMED)") {
    document.getElementById("rut").value = "76077525-8";
  } else if (empresa === "GASCO GLP (GAS LICUADO DE PETROLEO)") {
    document.getElementById("rut").value = "96568740-8";
  } else if (empresa === "GEMCO GENERAL MACHINERY S.A.") {
    document.getElementById("rut").value = "76142730-K";
  } else if (empresa === "GENERAL ELECTRIC INTERNATIONAL INC AGENCIA EN CHILE") {
    document.getElementById("rut").value = "59010820-0";
  } else if (empresa === "GENSET ENERGY SOLUTIONS LTDA") {
    document.getElementById("rut").value = "76426817-2";
  } else if (empresa === "GOLDEN SOLUTIONS SPA") {
    document.getElementById("rut").value = "76637087-K";
  } else if (empresa === "GOMEZ VERGARA Y CIA LTDA") {
    document.getElementById("rut").value = "77169700-3";
  } else if (empresa === "HEMISFERIO SUR S.A.") {
    document.getElementById("rut").value = "96533330-4";
  } else if (empresa === "HIDROS DEL SUR SPA") {
    document.getElementById("rut").value = "77377355-6";
  } else if (empresa === "IMPORT. DE EQUIPOS FRANCISCO GACITUA EIRL (NEWLAB)") {
    document.getElementById("rut").value = "76443751-9";
  } else if (empresa === "IMPORT. E INV PROLAB LTDA.") {
    document.getElementById("rut").value = "78835470-3";
  } else if (empresa === "IMPORTA. ARQUIMED LTDA") {
    document.getElementById("rut").value = "92999000-5";
  } else if (empresa === "INDURA S.A") {
    document.getElementById("rut").value = "76150343-K";
  } else if (empresa === "INDUSTRIAL Y COMERCIAL BAXTER DE CHILE LTDA") {
    document.getElementById("rut").value = "78366970-6";
  } else if (empresa === "INDUSTRIAL Y COMERCIAL ROMER HERMANOS LTDA") {
    document.getElementById("rut").value = "78455690-5";
  } else if (empresa === "ING SERVICIOS INTEGRALES LTDA.") {
    document.getElementById("rut").value = "76876847-1";
  } else if (empresa === "INGENIERIA Y CONSTRUCCION SABATEC SPA") {
    document.getElementById("rut").value = "77028141-5";
  } else if (empresa === "INRA REFRIGERACION INDUSTRIAL SPA") {
    document.getElementById("rut").value = "81527100-9";
  } else if (empresa === "INVERSIONES Y SERVICIOS BALDER LTDA") {
    document.getElementById("rut").value = "79510190-K";
  } else if (empresa === "JOHNSON Y JOHNSON DE CHILE S.A") {
    document.getElementById("rut").value = "93745000-1";
  } else if (empresa === "JORGE ANDRES VILLAR MUÑOZ") {
    document.getElementById("rut").value = "15549350-K";
  } else if (empresa === "LABORATORIOS LBC LTDA.") {
    document.getElementById("rut").value = "78028610-5";
  } else if (empresa === "LINDE GAS CHILE S.A.") {
    document.getElementById("rut").value = "90100000-K";
  } else if (empresa === "LUIS ALBERTO MEDEL RIVAS") {
    document.getElementById("rut").value = "5726050-5";
  } else if (empresa === "MANANTIAL S.A.") {
    document.getElementById("rut").value = "96711590-8";
  } else if (empresa === "MANTENGINEER SPA") {
    document.getElementById("rut").value = "76506152-0";
  } else if (empresa === "MEDIPLEX S.A.") {
    document.getElementById("rut").value = "86383300-0";
  } else if (empresa === "MEDLAND INGENIERIA SPA") {
    document.getElementById("rut").value = "76763275-4";
  } else if (empresa === "MISAEL FERNANDO FUENTES PAREDES INGENIERIA EIRL") {
    document.getElementById("rut").value = "76420367-4";
  } else if (empresa === "MORENO ASOCIADOS LTDA") {
    document.getElementById("rut").value = "78762910-5";
  } else if (empresa === "NOVENTA GRADOS SPA") {
    document.getElementById("rut").value = "76918593-3";
  } else if (empresa === "OPENFAB SPA") {
    document.getElementById("rut").value = "76430744-5";
  } else if (empresa === "PENTAFARMA S.A") {
    document.getElementById("rut").value = "96640350-0";
  } else if (empresa === "PHILIPS CHILENA S.A") {
    document.getElementById("rut").value = "90761000-4";
  } else if (empresa === "PROCESOS SANITARIOS SPA") {
    document.getElementById("rut").value = "96697710-8";
  } else if (empresa === "PROJECTA LTDA") {
    document.getElementById("rut").value = "77720240-5";
  } else if (empresa === "PV EQUIP S.A.") {
    document.getElementById("rut").value = "79895670-1";
  } else if (empresa === "QCLASS SPA") {
    document.getElementById("rut").value = "96913350-4";
  } else if (empresa === "RAUL OYARZUN MENDEZ (VAMPRODEM)") {
    document.getElementById("rut").value = "8164535-3";
  } else if (empresa === "RUDOLF CHILE S.A.") {
    document.getElementById("rut").value = "96924310-5";
  } else if (empresa === "SERV. DE BIOINGENIERIA LTDA.") {
    document.getElementById("rut").value = "76644150-5";
  } else if (empresa === "SERV. INT. DE EQUIPOS MEDICOS E INDUSTRIALES") {
    document.getElementById("rut").value = "77233977-3";
  } else if (empresa === "SERVICIO DE INGENIERIA EN AGUAS CLINICAS SIAC LTDA") {
    document.getElementById("rut").value = "76679310-K";
  } else if (empresa === "SERVICIO DE REFRIGERACION Y CLIMATIZACION ISABEL GARRIDO EIRL") {
    document.getElementById("rut").value = "76146972-K";
  } else if (empresa === "SERVICIOS SIMPLES SPA") {
    document.getElementById("rut").value = "76300752-9";
  } else if (empresa === "SIEMENS HEALTCARE EQUIPOS MEDICOS SPA") {
    document.getElementById("rut").value = "76481921-7";
  } else if (empresa === "SINAMED Y CIA LTDA.") {
    document.getElementById("rut").value = "77376300-3";
  } else if (empresa === "SISTEM PLUS S.A.") {
    document.getElementById("rut").value = "76087464-7";
  } else if (empresa === "SOC. DE ING. Y SERV HOGG Y SERRANO LTDA (HOSER)") {
    document.getElementById("rut").value = "79555420-3";
  } else if (empresa === "SOC. DE INSUMOS MEDICOS LTDA (AMTEC)") {
    document.getElementById("rut").value = "78587050-6";
  } else if (empresa === "SOC. VENT MEDICAL LTDA") {
    document.getElementById("rut").value = "76164399-1";
  } else if (empresa === "SOCIEDAD AUSTRAL DE ELECTRICIDAD S.A.") {
    document.getElementById("rut").value = "76073162-5";
  } else if (empresa === "SOCIEDAD AUTOMOTRIZ MACKENNA LIMITADA.") {
    document.getElementById("rut").value = "76013794-4";
  } else if (empresa === "ST INGENIERIA Y TECNOLOGIA LTDA") {
    document.getElementById("rut").value = "76773127-2";
  } else if (empresa === "TECNIGEN S.A.") {
    document.getElementById("rut").value = "93020000-K";
  } else if (empresa === "TECNOIMAGEN S.A.") {
    document.getElementById("rut").value = "96843010-6";
  } else if (empresa === "TELEFONICA DEL SUR S.A.") {
    document.getElementById("rut").value = "90299000-3";
  } else if (empresa === "THYSSENKRUPP ELEVADORES S.A.") {
    document.getElementById("rut").value = "96726480-6";
  } else if (empresa === "TRASLADOS MANTENIMIENTO Y CONSTRUCCIÓN SPA") {
    document.getElementById("rut").value = "76935672-K";
  } else if (empresa === "TRULY NOLEN CHILE S.A.") {
    document.getElementById("rut").value = "96591760-8";
  } else if (empresa === "V&V SEGURIDAD LTDA.") {
    document.getElementById("rut").value = "76799890-2";
  } else if (empresa === "VIVENDO IBEROAMERICA SERV. ENERGETICOS SPA") {
    document.getElementById("rut").value = "76211402-K";
  } else if (empresa === "ZERO IMPACTO INGENIERIA TRABAJOS EN ALTURA Y RESCATE SPA") {
    document.getElementById("rut").value = "77068011-5";
  }
}


function refTec1() {
  var ref_tec_1 = document.getElementById("ref_tec_1").value;

  if (ref_tec_1 === "0") {
    document.getElementById("cargo_ref_tec_1").value = "0";
  } else if (ref_tec_1 === "NARUTO UZUMAKI") {
    document.getElementById("cargo_ref_tec_1").value = "ING.EQUIPOS INDUSTRIALES";
  } else if (ref_tec_1 === "SENKU ISHIGAMI") {
    document.getElementById("cargo_ref_tec_1").value = "ING.CIVIL BIOMEDICO";
  } else if (ref_tec_1 === "IPPO MAKUNOUCHI") {
    document.getElementById("cargo_ref_tec_1").value = "CONSTRUCTOR CIVIL";
  }
}


function refTec2() {
  var ref_tec_2 = document.getElementById("ref_tec_2").value;

  if (ref_tec_2 === "0") {
    document.getElementById("cargo_ref_tec_2").value = "0";
  } else if (ref_tec_2 === "NARUTO UZUMAKI") {
    document.getElementById("cargo_ref_tec_2").value = "ING.EQUIPOS INDUSTRIALES";
  } else if (ref_tec_2 === "SENKU ISHIGAMI") {
    document.getElementById("cargo_ref_tec_2").value = "ING.CIVIL BIOMEDICO";
  } else if (ref_tec_2 === "IPPO MAKUNOUCHI") {
    document.getElementById("cargo_ref_tec_2").value = "CONSTRUCTOR CIVIL";
  }
}

function correo_respon() {
  var responsable = document.getElementById("responsable").value;

  if (responsable === "0") {
    document.getElementById("correo_responsable").value = "0";
  } else if (responsable === "BAKI HANMA") {
    document.getElementById("correo_responsable").value = "baki.hanma@gmail.com";
  } else if (responsable === "RETSU KAIOH") {
    document.getElementById("correo_responsable").value = "retsu.kaioh@gmail.com";
  } else if (responsable === "JACK HANMA") {
    document.getElementById("correo_responsable").value = "jack.hanma@gmail.com";
  }
}


function correo_eject() {
  var ejecutivo_compra = document.getElementById("ejecutivo_compra").value;

  if (ejecutivo_compra === "0") {
    document.getElementById("correo_ejecutivo").value = "0";
  } else if (ejecutivo_compra === "YUICHIRO HANMA") {
    document.getElementById("correo_ejecutivo").value = "yuichiro.kaioh@gmail.com";
  } else if (ejecutivo_compra === "YUJIRO HANMA") {
    document.getElementById("correo_ejecutivo").value = "yujiro.hanma@gmail.com";
  }
}
