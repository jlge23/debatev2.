import './app';
//DataTable
import "datatables.net-bs5/js/dataTables.bootstrap5";
import "datatables.net-dt/js/dataTables.dataTables";
//jquery Validate
//import "jquery-validation/dist/additional-methods";
import "jquery-validation/dist/jquery.validate";
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'

import Modal from 'bootstrap/js/dist/modal';

$(function(){
    if($("div#inicio").length > 0){
        const AudioInicio = new Audio("/storage/audio/inicio.mp3");
        AudioInicio.loop = false;
        AudioInicio.controls = true;
        AudioInicio.play();
    }

    if($("div#final").length > 0){
        const AudioFinal = new Audio("/storage/audio/final.mp3");
        AudioFinal.loop = false;
        AudioFinal.controls = true;
        AudioFinal.play();
    }

    //resetear juego
    $("button#resetear").on("click",function(){
        Swal.fire({
            title: "¿Esta seguro que desea reinicar el juego?",
            text: "Esto reiniciara las estadisticas y podra comenzar a jugar desde cero, todas las preguntas estaran disponibles",
            icon: "question",
            allowOutsideClick : false,
            allowEscapeKey : false,
            allowEnterKey : false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "¡Cancelar!",
            confirmButtonText: "¡Si, deseo reiniciar el Juego!"
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "juego/reset";
            }
        })
    });

    //activar / desactivar demo
    $("button#demo").on("click",function(){
        var demo = $(this).data('juego');
        switch(demo){
            case 0:
                var texto = 'Esto activará las preguntas de demostración en el juego';
            break;

            case 1:
                var texto = 'Esto desactivará las preguntas de demostración en el juego';
            break;
        }
        Swal.fire({
            title: "¡Modo Demostración!",
            text: texto,
            icon: "info",
            allowOutsideClick : false,
            allowEscapeKey : false,
            allowEnterKey : false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "¡Cancelar!",
            confirmButtonText: "¡Si!"
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "juego/demo/"+demo;
            }
        });
    });

    $("button#anular").on("click",function(){
        Swal.fire({
            title: "¿Hay algun problema?",
            text: "Puede anularse esta pregunta y contestar otra, o el equipo pierde este turno",
            icon: "question",
            allowOutsideClick : false,
            allowEscapeKey : false,
            allowEnterKey : false,
            showDenyButton: true,
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            denyButtonColor: "red",
            confirmButtonText: "Anular pregunta y seguir",
            denyButtonText: "Pierde el turno",
            }).then((result) => {
            if (result.isConfirmed) {
                var preg = $("input#preg").val();
                var url = "/anular/"+preg;
                window.location.href = url;
            }else if (result.isDenied) {
                var e = $("input#equipo").val();
                var r = $("input#respuesta_id").val();
                var url = "/perder/"+r+"/"+e;
                window.location.href = url;
            }
        })
    });

    var equipo = $("input#equipo").val();
    var table = $("table#DT_juego").DataTable({
        responsive: true,
        paging: true,
        fixedColumns: true,
        //paging: false,
        //scrollCollapse: true,
        //scrollX: true,
        //scrollY: 300,
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
        "order": [[0, 'asc']],
        "ajax":{
            "type":"get",
            "url":"juego/dificultad"
        },
        "columns" : [
            {"data":"id,",
                "render": function (data, type, row) {
                    return "<a href='juego/"+equipo+"/"+row.id+"' class='btn btn-info'>"+row.id+"</a>";
                }
            },
            {"data":"nombre",
                "render": function (data, type, row) {
                    return "<label class='text text-dark text-center'>"+data+"</b></label>";

                }
            },
            {"data":"puntaje"},
            {"data":"tiempo"},
            {"data":"cantidad"},
            {"data":"id,",
                "render": function (data, type, row) {
                    return "<a href='juego/"+equipo+"/"+row.id+"' class='btn btn-info'>Pasar a la Pregunta</a>";
                }
            }
        ]
    });
/*     //seelccion de dificultad y activacion de modal
    $("table#DT_juego tbody").on("click","button",function(){
        //var data = $(this).data("action");
        var D = table.row($(this).parents('tr')).data();
        alert(D);
    }); */
    //
    //Verdadero y falso
    $("form#FRM_vf").validate({
        rules : {
            validez : {
                required : true
            }
        },
        messages : {
            validez : {
                required : "Debe seleccionar un puntaje"
            }
        },
        submitHandler : function(){
            $("form#FRM_vf")[0].submit();
        }
    });

    //Simple
    $("form#FRM_simple").validate({
        submitHandler : function(){
            $("form#FRM_simple")[0].submit();
        }
    });

    //Desarrollo
    $("form#FRM_desarrollo").validate({
        submitHandler : function(){
            $("form#FRM_desarrollo")[0].submit();
        }
    });

    //audio de pregunta
    if($("body#P").length > 0 ){
        const AudioPregunta = new Audio("/storage/audio/pregunta.mp3");
        AudioPregunta.defaultMuted = true;
        AudioPregunta.loop = false;
        AudioPregunta.controls = true;
        AudioPregunta.play();
    };

    $("button[type='submit']").on("click",function(){
        $(this).attr("disabled",true);
        var frm1,frm2,frm3;
        frm1= $("form#FRM_vf").serialize();
        frm2= $("form#FRM_seleccion").serialize();
        frm3= $("form#FRM_desarrollo").serialize();
        if(frm1.length > 0){document.getElementById("FRM_vf").submit();}
        if(frm2.length > 0){document.getElementById("FRM_seleccion").submit();}
        if(frm3.length > 0){document.getElementById("FRM_desarrollo").submit();}
    });
});
