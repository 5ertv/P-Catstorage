$(document).ready(function(){
    mostrar_consultas();
    function mostrar_consultas(){
        let funcion='mostrar_consultas';
        $.post('../Controlador/VentaController.php',{funcion},(response)=>{
            const vistas = JSON.parse(response);
            $('#venta_dia_vendedor').html(vistas.venta_dia_vendedor);
            $('#venta_diaria').html(vistas.venta_diaria);
            $('#venta_mensual').html(vistas.venta_mensual);
            $('#venta_anual').html(vistas.venta_anual);
        })
    }
        funcion="listar";
    let datatable = new DataTable('#tabla_venta', {
        ajax:{
            "url": "../Controlador/VentaController.php",
            "method": "POST",
            "data":{funcion:funcion}
        },
        columns: [
            { data: 'id_venta' },
            { data: 'fecha' },
            { data: 'cliente' },
            { data: 'rut' },
            { data: 'total' },
            { data: 'vendedor' },
            {"defaultContent": `<button class=" imprimir btn btn-secondary"><i class="fas fa-print"></i></button>
            <button class="ver btn btn-success" type="button" data-toggle="modal" data-target="#vista_venta"><i class="fas fa-search"></i></button>
            <button class="borrar btn btn-danger"><i class="fas fa-window-close"></i></button>`}
        ],
        "language":espanol
    });
    $('#tabla_venta tbody').on('click','.imprimir',function(){
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_venta;
        $.post('../Controlador/PDFController.php',{id},(response)=>{
            console.log(response);
            window.open('../pdf/pdf-'+id+'.pdf','_blank')
        })
    })
    $('#tabla_venta tbody').on('click','.borrar',function(){
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_venta;
        funcion="borrar_venta";
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: "btn btn-success m-1",
              cancelButton: "btn btn-danger m-1"
            },
            buttonsStyling: false
          });
          swalWithBootstrapButtons.fire({
            title: "Estas seguro que deseas eliminar la venta: "+id+"?",
            text: "No podras revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, borra esto!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                $.post('../Controlador/DetalleVentaController.php',{funcion,id},(response)=>{
                    if(response=='delete'){
                        swalWithBootstrapButtons.fire({
                            title: "Eliminado!",
                            text: "La venta "+id+" ha sido eliminado",
                            icon: "success"
                          }).then(function(){
                            location.href = 'adm_venta.php'
                          })
                    }
                    else if(response=='nodelete'){
                        swalWithBootstrapButtons.fire({
                            title: "No eliminado",
                            text: "No tienes permiso para hacer esta accion",
                            icon: "error"
                          });
                    }
                })
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "La venta no se elimino",
                icon: "error"
              });
            }
          });
    })
    $('#tabla_venta tbody').on('click','.ver',function(){
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_venta;
        funcion="ver";
        $('#codigo_venta').html(datos.id_venta);
        $('#fecha').html(datos.fecha);
        $('#cliente').html(datos.cliente);
        $('#rut').html(datos.rut);
        $('#vendedor').html(datos.vendedor);
        $('#total').html(datos.total);
        $.post('../Controlador/VentaProductoController.php',{funcion,id},(response)=>{
            let registros = JSON.parse(response);
            let template="";
            $('#registros').html(template);
            registros.forEach(registro => {
                template+=`
                    <tr>
                        <td>${registro.cantidad}</td>
                        <td>${registro.precio}</td>
                        <td>${registro.producto}</td>
                        <td>${registro.descripcion}</td>
                        <td>${registro.tipo}</td>
                        <td>${registro.subtotal}</td>
                    </tr>
                `;
                $('#registros').html(template);
            });
        })
    })
})
let espanol = {
    "aria": {
        "sortAscending": ": orden ascendente",
        "sortDescending": ": orden descendente"
    },
    "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellenar todas las celdas con <i>%d&lt;\\\/i&gt;<\/i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmente"
    },
    "buttons": {
        "collection": "Colección <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
        "colvis": "Visibilidad de la columna",
        "colvisRestore": "Restaurar visibilidad",
        "copy": "Copiar",
        "copyKeys": "Presiona ctrl or u2318 + C para copiar los datos de la tabla al portapapeles.<br \/><br \/>Para cancelar, haz click en este mensaje o presiona esc.",
        "copyTitle": "Copiado al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pdf": "PDF",
        "print": "Imprimir",
        "copySuccess": {
            "1": "Copiaste un registro al portapapeles",
            "_": "Copiaste %ds registros al portapapeles"
        },
        "pageLength": {
            "-1": "Mostrar todos",
            "_": "Mostrar %ds filas"
        },
        "createState": "Crear Estado",
        "removeAllStates": "Eliminar Todos los Estados",
        "removeState": "Eliminar",
        "renameState": "Renombrar",
        "savedStates": "Estados Guardados",
        "stateRestore": "Estado %d",
        "updateState": "Actualizar"
    },
    "datetime": {
        "amPm": [
            "AM",
            "PM"
        ],
        "hours": "Horas",
        "minutes": "Minutos",
        "months": {
            "0": "Enero",
            "1": "Febrero",
            "10": "Noviembre",
            "11": "Diciembre",
            "2": "Marzo",
            "3": "Abril",
            "4": "Mayo",
            "5": "Junio",
            "6": "Julio",
            "7": "Agosto",
            "8": "Septiembre",
            "9": "Octubre"
        },
        "next": "Siguiente",
        "previous": "Anterior",
        "seconds": "Segundos",
        "weekdays": [
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ],
        "unknown": "-"
    },
    "decimal": ",",
    "editor": {
        "close": "Cerrar",
        "create": {
            "button": "Nuevo",
            "submit": "Crear",
            "title": "Crear nuevo registro"
        },
        "edit": {
            "button": "Editar",
            "submit": "Actualizar",
            "title": "Editar registro"
        },
        "error": {
            "system": "Ocurrió un error de sistema (&lt;a target=\"\\\" rel=\"nofollow\" href=\"\\\"&gt;Más información)."
        },
        "multi": {
            "info": "Los elementos seleccionados contienen diferentes valores para esta entrada. Para editar y configurar todos los elementos de esta entrada con el mismo valor, haga clic o toque aquí, de lo contrario, conservarán sus valores individuales.",
            "noMulti": "Esta entrada se puede editar individualmente, pero no como parte de un grupo.",
            "restore": "Deshacer cambios",
            "title": "Múltiples valores"
        },
        "remove": {
            "button": "Eliminar",
            "submit": "Eliminar",
            "title": "Eliminar registro",
            "confirm": {
                "_": "¿Estás seguro de que deseas eliminar %d registros?",
                "1": "¿Estás seguro de que deseas eliminar 1 registro?"
            }
        }
    },
    "emptyTable": "Sin registros",
    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
    "infoFiltered": "(filtrado de _MAX_ registros)",
    "infoThousands": ".",
    "lengthMenu": "Mostrar _MENU_ registros",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "processing": "Procesando...",
    "search": "Buscar:",
    "searchBuilder": {
        "add": "Agregar Condición",
        "button": {
            "_": "Filtros (%d)",
            "0": "Filtrar"
        },
        "clearAll": "Limpiar Todo",
        "condition": "Condición",
        "conditions": {
            "array": {
                "contains": "Contiene",
                "empty": "Vacío",
                "equals": "Igual",
                "not": "Distinto",
                "notEmpty": "No vacío",
                "without": "Sin"
            },
            "date": {
                "after": "Mayor",
                "before": "Menor",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual",
                "not": "Distinto",
                "notBetween": "No entre",
                "notEmpty": "No vacío"
            },
            "number": {
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual",
                "gt": "Mayor",
                "gte": "Mayor o igual",
                "lt": "Menor",
                "lte": "Menor o igual",
                "not": "Distinto",
                "notBetween": "No entre",
                "notEmpty": "No vacío"
            },
            "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina con",
                "equals": "Igual",
                "not": "Distinto",
                "notEmpty": "No vacío",
                "startsWith": "Comienza con",
                "notContains": "No contiene",
                "notStartsWith": "No comienza con",
                "notEndsWith": "No termina con"
            }
        },
        "data": "Datos",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Filtros anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Filtro",
        "title": {
            "_": "Filtros (%d)",
            "0": "Filtrar"
        },
        "value": "Valor"
    },
    "searchPanes": {
        "clearMessage": "Limpiar todo",
        "collapse": {
            "_": "Paneles de búsqueda (%d)",
            "0": "Paneles de búsqueda"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda...",
        "title": "Filtros activos - %d",
        "showMessage": "Mostrar Todos",
        "collapseMessage": "Colapsar Todos"
    },
    "select": {
        "cells": {
            "_": "%d celdas seleccionadas",
            "1": "Una celda seleccionada"
        },
        "columns": {
            "_": "%d columnas seleccionadas",
            "1": "Una columna seleccionada"
        },
        "rows": {
            "1": "Una fila seleccionada",
            "_": "%d filas seleccionadas"
        }
    },
    "thousands": ".",
    "zeroRecords": "No se encontraron registros",
    "searchPlaceholder": "Ingresa un término",
    "stateRestore": {
        "creationModal": {
            "button": "Crear",
            "columns": {
                "search": "Búsqueda de Columnas",
                "visible": "Visibilidad de Columnas"
            },
            "name": "Nombre:",
            "order": "Ordenamiento",
            "paging": "Paginación",
            "scroller": "Posición del Scroll",
            "search": "Búsqueda",
            "searchBuilder": "Constructor de Búsquedas",
            "select": "Seleccionar",
            "title": "Crear un Nuevo Estado",
            "toggleLabel": "Incluir:"
        },
        "duplicateError": "Ya existe un estado con este nombre.",
        "emptyError": "El nombre no puede estar vacío.",
        "emptyStates": "No hay estados guardados",
        "removeConfirm": "¿Estás seguro de que deseas eliminar %s?",
        "removeError": "Hubo un error al eliminar el estado",
        "removeJoiner": "y",
        "removeSubmit": "Eliminar",
        "removeTitle": "Eliminar Estado",
        "renameButton": "Renombrar",
        "renameLabel": "Nombre nuevo para %s:",
        "renameTitle": "Renombrar Estado"
    }
};