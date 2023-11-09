import './app';
//DataTable
import "datatables.net-bs5/js/dataTables.bootstrap5";
import "datatables.net-dt/js/dataTables.dataTables";

//jquery Validate
//import "jquery-validation/dist/additional-methods";
import "jquery-validation/dist/jquery.validate";
import { get } from 'lodash';
//import selectpicker from "bootstrap-select/dist/js/bootstrap-select";
//import "bootstrap-select/sass/bootstrap-select.scss";
$(function(){
    //Datatables
    $("table#pregunta").DataTable({
        "responsive": true,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Ãšltimo",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la  columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "order": [[0, 'desc']]
    });

    //caraga de formulario de respuestas
    $('select#tipo_id').on("change",function(){
        var opt = $("select#tipo_id option:selected").val();
        switch(opt){
            case '1'://Verdadero y Falso
                $("div#R").css("display","block");
                var divR = $("div#R");
                divR.html("");
                var div0 = document.createElement("div");
                div0.className = "input-group mb-3";
                var span0 = document.createElement("span");
                span0.className = "input-group-text";
                span0.innerHTML = "Respuesta Correcta";
                var textarea0 = document.createElement("textarea");
                textarea0.className = "form-control";
                textarea0.id = "respuesta0";
                textarea0.name = "respuesta[]";
                textarea0.placeholder = "Ingrese la respuesta correcta";
                textarea0.required = true;
                var label10 = document.createElement("label");
                label10.className = "error text";
                label10.for = "respuesta0";
                //salto de linea
                var br = document.createElement("br");
                //
                //opcion valida radio-group
                var label0 = document.createElement("label");
                label0.innerHTML = "Opción valida:&nbsp;";
                //radio - true
                var div11 = document.createElement("div");
                div11.className = "form-check";
                var inputradio11 = document.createElement("input");
                inputradio11.type = "radio";
                inputradio11.className = "form-check-input";
                inputradio11.id = "validez1";
                inputradio11.name = "validez";
                inputradio11.value = 1;
                var label11 = document.createElement("label");
                label11.className = "form-check-label";
                label11.for = "validez1";
                label11.innerHTML = " [Verdadero]";
                //radio false
                var div12 = document.createElement("div");
                div12.className = "form-check";
                var inputradio12 = document.createElement("input");
                inputradio12.type = "radio";
                inputradio12.className = "form-check-input";
                inputradio12.id = "validez2";
                inputradio12.name = "validez";
                inputradio12.value = 0;
                var label12 = document.createElement("label");
                label12.className = "form-check-label";
                label12.for = "validez2";
                label12.innerHTML = " [Falso]";
                //impresion
                div0.appendChild(span0);
                div0.appendChild(textarea0);label10
                div0.appendChild(label10);
                div11.appendChild(inputradio11);
                div11.appendChild(label11);
                div12.appendChild(inputradio12);
                div12.appendChild(label12);
                label0.appendChild(div11);
                label0.appendChild(div12);
                divR.append(div0);
                divR.append(br);
                divR.append(label0);
            break;
            case '2'://Selección Simple
                $("div#R").css("display","block");
                var divR = $("div#R");
                divR.html("");
                //div de respuestas
                var div20 = document.createElement("div");
                div20.id = "resp";
                //label y combo
                var label20 = document.createElement("label");
                label20.className = "text";
                label20.innerHTML = "Opción Valida: &nbsp;";
                var SelValidez = document.createElement("select");
                SelValidez.id = "validez";
                SelValidez.name = "validez";
                SelValidez.className = "form-control";
                SelValidez.required = true;
                //iteración de select
                var count = $(this).find(':selected').data("opt");
                var Option1 = document.createElement('option');
                Option1.text = "SELECCIONE";
                Option1.value = "";
                var br = document.createElement("br");
                //
                SelValidez.appendChild(Option1);
                for(var i=0;i<count;i++){
                    //respuestas
                    //objetos de respuestra
                    var div21 = document.createElement("div");
                    div21.className = "input-group mb-3";
                    var span21 = document.createElement("span");
                    span21.className = "input-group-text";
                    span21.innerHTML = "Respuesta ["+(i+1)+"]: ";
                    var input21 = document.createElement("input");
                    input21.className = "form-control";
                    input21.id = "respuesta"+i;
                    input21.name = "respuesta[]";
                    input21.placeholder = "Posible respuesta a la pregunta anterior";
                    input21.required = true;
                    div21.appendChild(span21);
                    div21.appendChild(input21);
                    div20.appendChild(div21);
                    div20.appendChild(br);
                    //combo
                    var OptionN = document.createElement('option');
                    OptionN.text = "Opción: "+(i+1);
                    OptionN.value = (i+1);
                    SelValidez.appendChild(OptionN);
                }
                //impresion
                //div20.appendChild()
                label20.appendChild(SelValidez);
                div20.appendChild(label20);
                divR.append(div20);
            break;
            case '3'://Desarrollo
                $("div#R").css("display","block");
                var divR = $("div#R");
                divR.html("");
                var div30 = document.createElement("div");
                div30.className = "input-group mb-3";
                var span30 = document.createElement("span");
                span30.className = "input-group-text";
                span30.innerHTML = "Respuesta Correcta";
                var textarea30 = document.createElement("textarea");
                textarea30.className = "form-control";
                textarea30.id = "respuesta0";
                textarea30.name = "respuesta[]";
                textarea30.placeholder = "Ingrese la respuesta correcta";
                textarea30.required = true;
                var br = document.createElement("br");
                var input30 = document.createElement("input");
                input30.type = "hidden";
                input30.id = "validez";
                input30.name = "validez";
                input30.required = true;
                input30.value = 1;
                //impresion
                div30.appendChild(span30);
                div30.appendChild(textarea30);
                divR.append(div30);
                divR.append(br);
                divR.append(input30);
            break;
            default: $("div#R").html("").css("display","none");
        }
    });
    //
    //Agregar pregunta
    $("form#nueva_pregunta").validate({
        rules : {
            pregunta : {
                required : true
            },
            tipo_id : {
                required : true
            },
            dificultade_id : {
                required : true
            },
            demo : {required : true},
            status : {required : true},
            validez : {required : true},
            "respuesta[]" : {
                required : true
            }
        },
        messages : {
            pregunta : {
                required : "Descripcion de la pregunta requerida"
            },
            tipo_id : {
                required : "Tipo de pregunta requerido",
            },
            dificultade_id : {
                required : "Nivel de Dficiultad de la pregunta requerido"
            },
            demo : {required : "Es necesario indicar si esta pregunta será para demostración, o nó"},
            status : {required : "Estatus de la pregunta requerido"},
            validez : {required : "Se requiere verificar si la respeusta a la pregunta es Valida, o nó"},
            "respuesta[]" : {
                required : "Se requiere ingresar la respuesta"
            }
        },
        submitHandler : function(){
            if(confirm("¿Confirma el registro de los datos?")){
                // Obtén todos los elementos del formulario
                $("form#nueva_pregunta")[0].submit();
                //console.log($("form#nueva_pregunta").serialize());
            }
        }
    });
});
