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
                color = $('#color').val('');
                size = $('#size').val('');
                console.log(msg.products_variant);
                $(this).removeClass('btn-primary');
                $(this).addClass('btn-success');
                $('#addVariante').modal('hide');
                $('#submit_modal').show();
                $('#loading_modal').addClass('d-none');
                location.reload();
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
                title = $('#title').val('');
                description = $('#description').val('');
                console.log(msg.events_product);
                $(this).removeClass('btn-primary');
                $(this).addClass('btn-success');
                $('#addEventsProductModal').modal('hide');
                $('#submit_modal_EP').show();
                $('#loading_modal_EP').addClass('d-none');
                location.reload();
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
                console.log(msg.events_product);
                $(this).removeClass('btn-primary');
                $(this).addClass('btn-success');
                $('#addVarianteEPModal').modal('hide');
                $('#submit_modalVarianteEP').show();
                $('#loading_modalVarianteEP').addClass('d-none');
                location.reload();
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
                console.log(data);
                console.log(data.font_id);
                var id = $('#tp_id_font').val();
                var font_title = $('#ec_font_title').val();
                var font_url = $('#ec_font_url').val();
                var font_transform = $('#font_transform').val();
                var font_weight = $('#font_weight').val();
                var font_name = font_url.replace('C:\\fakepath\\','');
                var new_path = '/fonts/'+font_title+'/';
                var font_url_replaced = font_url.replace('C:\\fakepath\\', new_path);
                var fontsIdsList = document.getElementById("fontsIdsList"+id).value;
                var fonts_ids = [];
                fonts_ids.push(fontsIdsList);
                var array_fonts_ids = [data.font_id];
                fonts_ids.push([array_fonts_ids]);
                document.getElementById("fontsIdsList"+id).value = fonts_ids;
                // document.getElementById("data_font_id"+id).value = data.font_id;
                // console.log(document.getElementById("data_font_id"+id).value);
                // $('#fontsToDelete'+id).html('<input type="hidden" name="data_font_id" id="data_font_id'+id+'" value="'+data.font_id+'">');
                addDeleteBtn(font_title, id, font_transform,font_weight, font_name);
                // là il faut que tu add l'ID de la font dans l'input hidden
                $('#ec_font_title').val('');
                $('#ec_font_url').val('');
                // fin du ajax
            }
        });
    });
});