import './app';
//DataTable
import "datatables.net-bs5/js/dataTables.bootstrap5";
import "datatables.net-dt/js/dataTables.dataTables";
//jquery Validate
//import "jquery-validation/dist/additional-methods";
import "jquery-validation/dist/jquery.validate";
$(document).ready(function(){
    //Datatables
    $("table#equipo").DataTable({
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
        "columns" : [
            {"data":"id"},
            {"data":"nombre"},
            {"data":"descripcion"},
            {"data":"status","render": function (data, type, row) {
                    switch(data){
                        case '0' :
                            return "<label class='text text-danger'><strong>Inactivo</strong></label>";
                        break;
                        case '1' :
                            return "<label class='text text-success'><strong>Activo</strong></label>";
                        break;
                    }
                }
            },
            {"data":"defaultContent"}
        ]
    });
    //Agregar equipo
    $("form#nuevo_equipo").validate({
        rules : {
            nombre : {
                required : true
            },
            descripcion : {
                required : true
            },
            status : {
                required : true
            }
        },
        messages : {
            nombre : {
                required : "Nombre del equipo requerido"
            },
            descripcion : {
                required : "Iglesia o lugar de precedencia"
            },
            status : {
                required : "Estatus, requerido"
            }
        },
        submitHandler : function(){
            if(confirm("¿Confirma el registro de los datos?"))
                $("form#nuevo_equipo")[0].submit();
                //console.log($("form#nuevo_equipo").serialize());
        }
    });
    //Actualizar equipo
    $("form#editar_equipo").validate({
        rules : {
            nombre : {
                required : true
            },
            descripcion : {
                required : true
            },
            status : {
                required : true
            }
        },
        messages : {
            nombre : {
                required : "Nombre del equipo requerido"
            },
            descripcion : {
                required : "Iglesia o lugar de precedencia"
            },
            status : {
                required : "Estatus, requerido"
            }
        },
        submitHandler : function(){
            if(confirm("¿Confirma la actualización los datos? ACTUALIZAR"))
                $("form#editar_equipo")[0].submit();
                //console.log($("form#editar_equipo").serialize());
        }
    });
});
