$(document).ready(function () {
    $('#commentForm').on('submit', function comment(e) {
        e.preventDefault();
        var name = $('#name').val();
        var message = $('#message').val();
        var event_id = $('#event_id').val();
        var user_id = $('#user_id').val();
        var user_lastname = $('#user_lastname').val();
        var user_firstname = $('#user_firstname').val();
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();

        if (dd < 10) {
            dd = '0' + dd
        }

        if (mm < 10) {
            mm = '0' + mm
        }
        today = mm + '/' + dd + '/' + yyyy;
        $.ajax({
            type: "POST",
            url: '/comment/add',
            data: $(this).serialize(),
            success: function (data) {
                console.log(data)
                $('.event_comments_list1').append('<div class="row">' + '<div class="col-3">' + '<div>' + user_firstname + ' ' + user_lastname + '</div>' + '<br>' + '<small>(' + today + ')</small>' + '</div>' + '<div class="col">' + '<div>' + name + '</div>' + '<hr>' + message + '</div></div><br>');
                name = $('#name').val('');
                message = $('#message').val('');
            }
        });
    });

    $('.delete_comment').click(function () {
        $.ajaxSetup({
            beforeSend: function (xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });
        var id = $(this).data("id");
        // var token = $(this).data("token");
        $.ajax({
            type: 'delete',
            url: "/comment/delete/" + id,
            dataType: "JSON",
            data: {
                "id": id,
                _token: '{!! csrf_token() !!}',
            },
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                $('#' + id).remove();
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    $('#AddColorAjax').on('submit', function (e) {
        e.preventDefault();
        var nom = $('#nom').val();
        var pantone = $('#pantone')[0].files[0];
        var select_couleurs = $('#select_couleurs').val();
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: '/admin/Couleur/store',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#select_color').append('<option value="' + data.couleur.id + '" >' + data.couleur.nom + '</option>');
                $('#select_color2').append('<option value="' + data.couleur.id + '" >' + data.couleur.nom + '</option>');
                $('#select_color3').append('<option value="' + data.couleur.id + '" >' + data.couleur.nom + '</option>');
                console.log(data.couleur)
            }
        });
    });

    $('#AddProductsVariants').on('submit', function (e) {
        e.preventDefault();
        $('#submit_modal').hide();
        $('#loading_modal').removeClass('d-none');
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: '/admin/ProductsVariants/store',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (msg) {
                if (msg.errors) {
                    $('.alert-danger').html('');
                    jQuery.each(msg.errors, function (key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<li>' + value + '</li>');
                    });
                    $('#submit_modal').show();
                    $('#loading_modal').addClass('d-none');
                } else {
                    color = $('#color').val('');
                    size = $('#size').val('');
                    console.log(msg.products_variant);
                    $(this).removeClass('btn-primary');
                    $(this).addClass('btn-success');
                    $('#addVariante').modal('hide');
                    $('#submit_modal').show();
                    $('#loading_modal').addClass('d-none');
                    location.reload();
                }
            },
            error: function (request, status, error) {
                $('#submit_modal').show();
                $('#loading_modal').addClass('d-none');
            }
        });
    });

    $('#AddEventsProduct').on('submit', function (e) {
        e.preventDefault();
        $('#submit_modal_EP').hide();
        $('#loading_modal_EP').removeClass('d-none');
        $.ajax({
            type: "POST",
            url: '/admin/EventsProducts/store',
            data: $(this).serialize(),
            success: function (msg) {
                if (msg.errors) {
                    $('.alert-danger').html('');
                    jQuery.each(msg.errors, function (key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<li>' + value + '</li>');
                    });
                    $('#submit_modal_EP').show();
                    $('#loading_modal_EP').addClass('d-none');
                } else {
                    title = $('#title').val('');
                    description = $('#description').val('');
                    console.log(msg.events_product);
                    $(this).removeClass('btn-primary');
                    $(this).addClass('btn-success');
                    $('#addEventsProductModal').modal('hide');
                    $('#submit_modal_EP').show();
                    $('#loading_modal_EP').addClass('d-none');
                    location.reload();
                }
            },
            error: function (request, status, error) {
                $('#submit_modal_EP').show();
                $('#loading_modal_EP').addClass('d-none');
            }
        });
    });

    $('#AddVarianteEP').on('submit', function (e) {
        e.preventDefault();
        $('#submit_modalVarianteEP').hide();
        $('#loading_modalVarianteEP').removeClass('d-none');
        $.ajax({
            type: "POST",
            url: '/admin/EventsProducts/addVarianteEP',
            data: $(this).serialize(),
            success: function (msg) {
                if (msg.errors) {
                    $('.alert-danger').html('');
                    jQuery.each(msg.errors, function (key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<li>' + value + '</li>');
                    });
                    $('#submit_modalVarianteEP').show();
                    $('#loading_modalVarianteEP').addClass('d-none');
                } else {
                    console.log(msg.events_product);
                    $(this).removeClass('btn-primary');
                    $(this).addClass('btn-success');
                    $('#addVarianteEPModal').modal('hide');
                    $('#submit_modalVarianteEP').show();
                    $('#loading_modalVarianteEP').addClass('d-none');
                    location.reload();
                }
            },
            error: function (request, status, error) {
                $('#submit_modalVarianteEP').show();
                $('#loading_modalVarianteEP').addClass('d-none');
            }
        });
    });

    $('#AddFont').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: '/admin/EventsCustoms/uploadFile',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.errors) {
                    $('.alert-danger').html('');
                    jQuery.each(data.errors, function (key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<li>' + value + '</li>');
                    });
                } else {
                    $('#submit_modalAddFont').hide();
                    $('#loading_modalAddFont').removeClass('d-none');
                    $(this).removeClass('btn-primary');
                    $('.alert-danger').hide();
                    var id = $('#tp_id_font').val();
                    var font_title = $('#title').val();
                    var font_url = $('#file').val();
                    var font_transform = $('#font_transform').val();
                    var font_weight = $('#font_weight').val();
                    var font_name = font_url.replace('C:\\fakepath\\', '');
                    addDeleteBtn(font_title, id, font_transform, font_weight, font_name);
                    $('#addFontModal').modal('hide');
                    $('#submit_modalAddFont').show();
                    $('#loading_modalAddFont').addClass('d-none');
                    $('#title').val('');
                    $('#file').val('');
                }
            }
        });
    });

    $('#eventIsReady').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/admin/EventLocalDownload/store',
            data: $(this).serialize(),
            success: function (res) {
                console.log(res);
                $('#submit_modal_eventIsReady').hide();
                $('#loading_modal_eventIsReady').removeClass('d-none');
                $(this).removeClass('btn-primary');
                $('#eventIsReadyModal').modal('hide');
                $('#submit_modal_eventIsReady').show();
                $('#loading_modal_eventIsReady').addClass('d-none');
                location.reload();
            }
        });
    });

    $('#isNotReadyBtn').click(function () {
        $.ajaxSetup({
            beforeSend: function (xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });
        var event_id = $(this).data("event_id");
        // var token = $(this).data("token");
        $.ajax({
            type: 'GET',
            url: "/admin/EventLocalDownload/destroy/" + event_id,
            data: {
                "event_id": event_id,
                _token: '{!! csrf_token() !!}',
            },
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                location.reload();
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
    $('.progressbar').on('click', 'li', function (e) {
        e.preventDefault();
        if (confirm('ëtes-vous sûr de vouloir changer le status de l\'événement')) {
            var new_status = $(this).attr('data-status');
            var event_id = $(this).attr('data-event_id');
            $.ajax({
                type: "POST",
                url: '/admin/Event/changeStatus/' + event_id + '/' + new_status,
                success: function (res) {
                    console.log(res);
                    location.reload();
                }
            });
        }
    });

});