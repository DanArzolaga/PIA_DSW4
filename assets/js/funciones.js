document.addEventListener("DOMContentLoaded", function () {
    $('#tbl').DataTable({
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        "order": [
            [0, "desc"]
        ]
    });
    $(".confirmar").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    })

$("#des_mesa").autocomplete({
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: "ajax.php",
                dataType: "json",
                data: {
                    q: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            $("#idmesa").val(ui.item.id);
            $("#des_mesa").val(ui.item.label);
        }
    })
    $("#des_menu").autocomplete({
        minLength: 3,
        source: function (request, response) {
            $.ajax({
                url: "ajax.php",
                dataType: "json",
                data: {
                    pro: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            $("#id").val(ui.item.id);
            $("#des_menu").val(ui.item.value);
            $("#precio").val(ui.item.precio);
            $("#cantidad").focus();
        }
    })

    $('#btn_generar').click(function (e) {
        e.preventDefault();
        var rows = $('#tblDetalle tr').length;
        if (rows > 2) {
            var action = 'procesarVenta';
            var id = $('#idmesa').val();
            $.ajax({
                url: 'ajax.php',
                async: true,
                data: {
                    procesarVenta: action,
                    id: id
                },
                success: function (response) {

                    const res = JSON.parse(response);
                    if (response != 'error') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Comanda Generada',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        setTimeout(() => {
                            generarPDF(res.id_mesa, res.id_comanda);
                            location.reload();
                        }, 300);
                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Error al generar la comanda',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                },
                error: function (error) {

                }
            });
        } else {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'No hay platillos para generar la comanda',
                showConfirmButton: false,
                timer: 2000
            })
        }
    });
    if (document.getElementById("comanda_detalle")) {
        listar();
    }
})

function calcularPrecio(e) {
    e.preventDefault();
    const cant = $("#cantidad").val();
    const precio = $('#precio').val();
    const total = cant * precio;
    $('#sub_total').val(total);
    if (e.which == 13) {
        if (cant > 0 && cant != '') {
            const id = $('#id').val();
            registrarDetalle(e, id, cant, precio);
            $('#des_menu').focus();
        } else {
            $('#cantidad').focus();
            return false;
        }
    }
}


function listar() {
    let html = '';
    let detalle = 'detalle';
    $.ajax({
        url: "ajax.php",
        dataType: "json",
        data: {
            detalle: detalle
        },
        success: function (response) {

            response.forEach(row => {
                html += `<tr>
                <td>${row['id']}</td>
                <td>${row['descripcion']}</td>
                <td>${row['cantidad']}</td>
                <td>${row['precio_venta']}</td>
                <td>${row['sub_total']}</td>
                <td><button class="btn btn-danger" type="button" onclick="deleteDetalle(${row['id']})">
                <i class="fas fa-trash-alt"></i></button></td>
                </tr>`;
            });
            document.querySelector("#comanda_detalle").innerHTML = html;
            calcular();
        }
    });
}

function registrarDetalle(e, id, cant, precio) {
    if (document.getElementById('des_menu').value != '') {
        if (id != null) {
            let action = 'regDetalle';
            $.ajax({
                url: "ajax.php",
                type: 'POST',
                dataType: "json",
                data: {
                    id: id,
                    cant: cant,
                    regDetalle: action,
                    precio: precio
                },
                success: function (response) {

                    if (response == 'registrado') {
                        $('#cantidad').val('');
                        $('#precio').val('');
                        $("#des_menu").val('');
                        $("#sub_total").val('');
                        $("#des_menu").focus();
                        listar();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Platillo Ingresado',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    } else if (response == 'actualizado') {
                        $('#cantidad').val('');
                        $('#precio').val('');
                        $("#des_menu").val('');
                        $("#des_menu").focus();
                        listar();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Platillo Actualizado',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    } else {
                        $('#id').val('');
                        $('#cantidad').val('');
                        $('#precio').val('');
                        $("#des_menu").val('');
                        $("#des_menu").focus();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: response,
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                }
            });
        }
    }
}

function deleteDetalle(id) {
    let detalle = 'Eliminar'
    $.ajax({
        url: "ajax.php",
        data: {
            id: id,
            delete_detalle: detalle
        },
        success: function (response) {

             if (response == 'ok') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Platillo Eliminado',
                    showConfirmButton: false,
                    timer: 2000
                })
                document.querySelector("#des_menu").value = '';
                document.querySelector("#des_menu").focus();
                listar();
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error al eliminar el platillo',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    });
}

function calcular() {
    // obtenemos todas las filas del tbody
    var filas = document.querySelectorAll("#tblDetalle tbody tr");

    var total = 0;

    // recorremos cada una de las filas
    filas.forEach(function (e) {

        // obtenemos las columnas de cada fila
        var columnas = e.querySelectorAll("td");

        // obtenemos los valores de la cantidad y importe
        var importe = parseFloat(columnas[4].textContent);

        total += importe;
    });

    // mostramos la suma total
    var filas = document.querySelectorAll("#tblDetalle tfoot tr td");
    filas[1].textContent = total.toFixed(2);
}

function generarPDF(mesa, id_comanda) {
    url = 'pdf/generar.php?cl=' + mesa + '&v=' + id_comanda;
    window.open(url, '_blank');
}
if (document.getElementById("comandasUsuario")) {
    const action = "sales";
    $.ajax({
        url: 'chart.php',
        type: 'POST',
        data: {
            action
        },
        async: true,
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['nombre']);
                    cantidad.push(data[i]['Comandas']);
                }
                var ctx = document.getElementById("comandasUsuario");
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: nombre,
                        datasets: [{
                            data: cantidad,
                            backgroundColor: ['#C82A54', '#EF280F', '#23BAC4', '#8C4966', '#FF689D', '#E7D40A', '#E36B2C', '#69C36D', '#581845', '#024A86'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}
if (document.getElementById("PlatillosVendidos")) {
    const action = "polarChart";
    $.ajax({
        url: 'chart.php',
        type: 'POST',
        async: true,
        data: {
            action
        },
        success: function (response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var nombre = [];
                var cantidad = [];
                for (var i = 0; i < data.length; i++) {
                    nombre.push(data[i]['descripcion']);
                    cantidad.push(data[i]['cantidad']);
                }
                var ctx = document.getElementById("PlatillosVendidos");
                var myPieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: nombre,
                        datasets: [{
                            data: cantidad,
                            backgroundColor: ['#C82A54', '#EF280F', '#23BAC4', '#8C4966', '#FF689D', '#E7D40A', '#E36B2C', '#69C36D', '#581845', '#024A86'],
                        }],
                    },
                });
            }
        },
        error: function (error) {
            console.log(error);

        }
    });
}

function btnCambiar(e) {
    e.preventDefault();
    const actual = document.getElementById('actual').value;
    const nueva = document.getElementById('nueva').value;
    if (actual == "" || nueva == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Los campos estan vacios',
            showConfirmButton: false,
            timer: 2000
        })
    } else {
        const cambio = 'pass';
        $.ajax({
            url: "ajax.php",
            type: 'POST',
            data: {
                actual: actual,
                nueva: nueva,
                cambio: cambio
            },
            success: function (response) {
                if (response == 'ok') {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Contraseña modificado',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    document.querySelector('#frmPass').reset();
                    $("#nuevo_pass").modal("hide");
                } else if (response == 'dif') {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'La contraseña actual incorrecta',
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al modificar la contraseña',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }
        });
    }
}

function editarMesa(id) {
    const action = "editarMesa";
    $.ajax({
        url: 'ajax.php',
        type: 'GET',
        async: true,
        data: {
            editarMesa: action,
            id: id
        },
        success: function (response) {
            const datos = JSON.parse(response);
            $('#Descrip').val(datos.Descrip);
            $('#id').val(datos.id);
            $('#btnAccion').val('Modificar');
        },
        error: function (error) {
            console.log(error);

        }
    });
}

function editarUsuario(id) {
    const action = "editarUsuario";
    $.ajax({
        url: 'ajax.php',
        type: 'GET',
        async: true,
        data: {
            editarUsuario: action,
            id: id
        },
        success: function (response) {
            const datos = JSON.parse(response);
            $('#nombre').val(datos.nombre);
            $('#usuario').val(datos.usuario);
            $('#tipoUsuario').val(datos.tipoUsuario);
            $('#id').val(datos.idusuario);
            $('#btnAccion').val('Modificar');
        }, 
        error: function (error) {
            console.log(error);

        }
    });
}

function editarMenu(id) {
    const action = "editarMenu";
    $.ajax({
        url: 'ajax.php',
        type: 'GET',
        async: true,
        data: {
            editarMenu: action,
            id: id
        },
        success: function (response) {
            const datos = JSON.parse(response);
            $('#descrip').val(datos.descripcion);
            $('#precio').val(datos.precio);
            $('#id').val(datos.IdMenu);
            $('#categoria').val(datos.IdCategoria);
            $('#btnAccion').val('Modificar');
        },
        error: function (error) {
            console.log(error);

        }
    });
}

function limpiar() {
    $('#formulario')[0].reset();
    $('#id').val('');
    $('#btnAccion').val('Registrar');
}
function editarCategoria(id) {
    const action = "editarCategoria";
    $.ajax({
        url: 'ajax.php',
        type: 'GET',
        async: true,
        data: {
            editarCategoria: action,
            id: id
        },
        success: function (response) {
            const datos = JSON.parse(response);
            $('#Descrip').val(datos.Descrip);
            $('#id').val(datos.id);
            $('#btnAccion').val('Modificar');
        },
        error: function (error) {
            console.log(error);

        }
    });
}
