function updateData(id, titulo, data, tabla, api, tablaBd, idCampo, lugar) {
    if (data === '' || data === null) {
        $('#' + idCampo).css('border-color', 'red');
        $('#' + idCampo).focus();
    } else {
        $.ajax({
            url: `${$('#base_api').val()}` + api,
            type: 'POST',
            data: {
                id: id,
                campo: titulo,
                data: data,
                tabla: tablaBd
            },
            success: function(json) {
                NotificationService(json);
                $('#' + tabla).DataTable().ajax.reload();
                lugar.html(data);
                lugar.removeClass(idCampo);
                lugar.addClass(idCampo + '1');
            },
            error: function(xhr, status) {
                alert('An internal problem has occurred');
            }
        });
    }
}

function NotificationService(obj) {
    switch (obj.code) {
        //Errores de Validación
        case 800:
            var msj = [];
            $.each(obj.data, function(i, v) {
                msj.push(v + "<br>");
            });
            toast(msj, 'error');
            return false;
            break;
            //Error de fin de sesión
        case 900:
            toast('Your session has ended, please re-enter.', 'warning');
            setTimeout(function() {
                document.getElementById('logout-form').submit();
            }, 2000);
            break;
            // Respuesta del método que procesa error / success
        default:
            if (obj.status === 'error') {
                toast(obj.message, 'error');
                //swal("¡ SORRY !", obj.message)
                return false;
            }
            toast(obj.message, 'success');
            return true;
            break;
    }
}

function toast(mens, alert) {
    var title;
    switch (alert) {
        case 'info':
            title = '¡ Important !';
            break;
        case 'warning':
            title = '¡ Caution !';
            break;
        case 'success':
            title = '¡ Ready !';
            break;
        default:
            title = '¡ Sorry !';
            break;
    }

    $.toast({
        heading: title,
        text: mens,
        position: 'top-right',
        loaderBg: '#D9D9D9',
        icon: alert,
        hideAfter: 6000,
        showHideTransition: 'slide',
        stack: 6
    });
}


function editarCampo(tabla, clase, tablaNombre, tipoCampo, idCloneSelect = null) {
    // Campo 
    //-------------------------------------------------------------------------------------------------------------
    $(document).on('dblclick', '#' + tabla + ' tbody .' + clase + '1', function(e) {
        e.defaultPrevented;
        var text = $(this).text(),
            html;

        switch (tipoCampo) {
            case "number":
                html = '<input style="width: 100px" max="" min="0"  id="' + clase + '" class="form-control" type="number"  name="' + clase + '">';
                break;
            case "textarea":
                html = '<div class="form-group"><textarea name="' + clase + '" id="' + clase + '" class="form-control " style="width: 300px" ></textarea></div>';
                break;
            case "text":
                html = '<div class="form-group"><input style="width: 300px"  id="' + clase + '" class="form-control" type="text" name="' + clase + '">';
                break;
            case "select":
                html = '<div class="form-group "><select style="width: 200px" id="' + clase + '" name="' + clase + '" class="form-control"></select></div>';
                break;
            default:
                break;
        }
        $(this).html(html);
        if (tipoCampo == "select") {
            $('#' + idCloneSelect).find('option').clone().appendTo('#' + clase);
            console.log(text);
            $("#" + clase + " option:contains(" + text + ")").attr("selected", true);
        }
        $(this).removeClass(clase + '1');
        $(this).addClass(clase);
        $('#' + clase).focus();
        $('#' + clase).val(text);
    });

    $(document).on('blur', '#' + tabla + ' tbody .' + clase + '', function(e) {
        var nombreCampoBD = clase;
        var valor = $('#' + clase).val();
        var uriAjax = "updateTable";
        var nombreTablaBD = tablaNombre;
        var idCampoActual = clase;

        updateData($(this).closest('tr').attr('id'), nombreCampoBD, valor, tabla, uriAjax, nombreTablaBD, idCampoActual, $(this));
    });
}


$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function(jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 0) {
                alert('Not connect: Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found [404]');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].');
            } else if (textStatus === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (textStatus === 'timeout') {
                alert('Time out error.');
            } else if (textStatus === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error: ' + jqXHR.responseText);
            }
            $('button, input, select, textarea').attr("disabled", false);
        }
    });


    $(document).on('click', '.alerta_delete2', function(e) {
        e.preventDefault();
        var i = $(this).attr('id');
        swal({
            title: "Are you sure of this operation?",
            text: "¡You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "¡Yes, Delete!",
            cancelButtonText: "¡No, cancel!",
        }).then(result => {
            if (result.value) {
                var sep = i.split("-");
                var id = sep[2];
                var tabla = sep[0];
                var dataTable = sep[1];
                $.ajax({
                    type: "POST",
                    url: "deleteTable",
                    data: {
                        'tabla': tabla,
                        'id': id
                    },
                    beforeSend: function() {
                        $('#borrar' + id).removeClass("fa-trash").addClass("fa-spinner fa-spin");
                        $('#' + i).attr("disabled", true);
                    },
                    success: function(data) {
                        $('#borrar' + id).removeClass("fa-spinner fa-spin").addClass("fa-trash");
                        $('#' + i).attr("disabled", false);
                        if (NotificationService(data)) {
                            swal("¡Removed!", "Registry deleted successfully.", "success");
                            $('#' + dataTable).DataTable().ajax.reload();
                        } else {
                            swal("¡Sorry!", "There is an error processing this operation.)", "error");
                        }
                    }
                });
                swal("¡Erased!", "Deleted successfully.", "success");
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal("Cancelado", "Not erased.", "error");
            }
            swall.closeModal();
        });
    });


    $('.modal').on('shown.bs.modal', function() {
        $(this).find('[autofocus]').focus();
    });

});