$(function() {

    // New user
    $("#form-agregar-user").on('submit', function(e) {
        e.preventDefault();
        var form = $('#form-agregar-user');
        var btn = $('#text');
        $.ajax({
            type: "POST",
            url: "newUser",
            data: form.serialize(),
            beforeSend: function() {
                $('button, input, select, textarea').attr("disabled", true);
                btn.html('Processing...');
            },
            success: function(json) {
                $('button, input, select, textarea').attr("disabled", false);
                btn.html('Add');
                if (NotificationService(json)) {
                    $('#modal-agregar-user').modal('hide');
                    form[0].reset();
                    $('#table_users').DataTable().ajax.reload();
                }
            }
        });
    });


    // Table users
    $('#table_users').dataTable({
        columnDefs: [{
            orderable: false,
            //targets: [1]
        }],
        pageLength: 10,
        lengthMenu: [
            [5, 8, 15, 20],
            [5, 8, 15, 20]
        ],
        autoWidth: false,
        dom: 'Bfrtip',
        "scrollX": false,
        "processing": true,
        "responsive": true,
        "ajax": "users",
        columns: [{
                data: "name",
                title: 'First Name',
                className: 'name1 editable'
            },
            {
                data: "last_name",
                title: 'Last Name',
                className: 'last_name1 editable'
            },
            {
                data: "email",
                title: 'Email',
                className: 'email1 editable'
            },
            {
                data: "contact_number",
                title: 'Contact Number',
                className: 'contact_number1 editable'
            },
            {
                sTitle: "Delete",
                mDataProp: "id",
                className: 'text-center',
                sWidth: '5%',
                orderable: false,
                render: function(data, type, item) {
                    return "<button type='button' class='btn btn-sm btn-danger alerta_delete2 ' id='users-table_users-" + data + "' ><i class='fa fa-trash'></i></button>";
                }
            }
        ],
        "aaSorting": [
            [0, "asc"]
        ],
        rowId: 'id'
    });

    var tabla = "table_users";
    var tabla_bd = "users";

    //Name
    editarCampo(tabla, "name", tabla_bd, "text");

    //Last Name
    editarCampo(tabla, "last_name", tabla_bd, "text");

    //Email
    editarCampo(tabla, "email", tabla_bd, "text");

    //Contact Number
    editarCampo(tabla, "contact_number", tabla_bd, "number");

});