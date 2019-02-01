$( document ).ready( function() {
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
        var mm = today.getMonth()+1; 
        var yyyy = today.getFullYear();

if(dd<10) {
    dd = '0'+dd
} 

if(mm<10) {
    mm = '0'+mm
} 
today = mm + '/' + dd + '/' + yyyy;      
        $.ajax({
            type: "POST",
            url: '/comment/add',
            data: $(this).serialize(),
            success: function(data) {
                console.log(data)    
                $('.event_comments_list1').append('<div class="row">' + '<div class="col-3">' + '<div>' + user_firstname + ' ' + user_lastname + '</div>'+'<br>' + '<small>(' + today+ ')</small>' + '</div>' + '<div class="col">' + '<div>' + name + '</div>' + '<hr>' + message + '</div></div><br>');                
                name = $('#name').val('');
                message = $('#message').val('');
            }
        });
    });

    $('.delete_comment').click(function() {
        $.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });
       var id = $(this).data("id");
        // var token = $(this).data("token");
        $.ajax({
            type: 'delete',
            url: "/comment/delete/"+id,
            dataType: "JSON",
            data: {
                "id": id,
                _token: '{!! csrf_token() !!}',
            },
            contentType: false,
            processData: false,
            success: function(response){
                console.log(response);
                $('#'+id).remove();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }); 

    $('#submit_modal').click(function() {
        $(this).removeClass('btn btn-primary btn-sm');
        $(this).addClass('btn btn-success btn-sm');
    });

    $('#close_modal').click(function() {
        $('#submit_modal').removeClass('btn btn-success btn-sm');
        $('#submit_modal').addClass('btn btn-primary btn-sm');
        $('#submit_modal').val('Valider');
    });

    $('#AddColorAjax').on('submit', function(e) {
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
            success: function(data){
                $('#select_color').append('<option value="' + data.couleur.id +'" >' + data.couleur.nom + '</option>');
                $('#select_color2').append('<option value="' + data.couleur.id +'" >' + data.couleur.nom + '</option>');
                $('#select_color3').append('<option value="' + data.couleur.id +'" >' + data.couleur.nom + '</option>');
                console.log(data.couleur)
            }
        });
    });

    $('#AddProductsVariants').on('submit', function(e) {
        e.preventDefault();
        var product_zone_image1 = $('#product_zone_image1')[0].files[0];
        var product_zone_image2 = $('#product_zone_image2')[0].files[0];
        var product_zone_image3 = $('#product_zone_image3')[0].files[0];
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: '/admin/ProductsVariants/store',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(msg){
                name = $('#name').val('');
                color = $('#color').val('');
                size = $('#size').val('');
                quantity = $('#quantity').val('');
                position = $('#position').val('');
                product_zone_title1 = $('#product_zone_title1').val('');
                product_zone_title2 = $('#product_zone_title2').val('');
                product_zone_title3 = $('#product_zone_title3').val('');
                vendor_sku = $('#vendor_sku').val('');
                vendor_quality = $('#vendor_quantity').val('');
                product_zone_image1 = $('#product_zone_image1').val('');
                product_zone_image2 = $('#product_zone_image2').val('');
                product_zone_image3 = $('#product_zone_image3').val('');
                console.log(msg.products_variants);
            }
        });
    });

    // $('#btn_color_variant').live('click', function(e) {
    //     e.preventDefault(); 
    //     var couleur_id = $('#variants').val();
    //     $.ajax({
    //         type: "GET",
    //         url: '/admin/Couleur/show/'+couleur_id,
    //         success: function(data){
    //             $('#variant_colors').append('<input class="form-check-input" type="checkbox" value="'+data.id+'" id="variant"><label class="form-check-label" for="defaultCheck2">'+data.lastname+'</label> <img src="/uploads/'+data.pantoneName+'" class="miniRoundedImage" alt="pantone" ><div class="form-check"> </div>');
                
    //         }
    //     });
    // });


});

// $('#product_id').on('change', function(e){
//     var product_id = e.target.value;
//     var couleurs = $('#couleurs').val();
//     $.get('/select_product?product_id='+product_id, function(data){
//         $('#variant_colors').empty();
//         $('#btn_color').empty();
//         $('#btn_color').append('<button type="button" class="btn btn-primary btn-sm mb-2" id="btn_color_variant">Sélectionner les couleurs</button>');
//         $.each(data, function(index, variant){
//             $('#variant_colors').append('<div class="form-check"><input class="form-check-input" type="checkbox" value="'+variant.couleur_id+'" id="variants"><label class="form-check-label" for="defaultCheck2">'+variant.couleur_id+'</label></div>');
//             $('#variant_color_id').append('<input type="hidden" id="variants" name="variants" value="'+variant.couleur_id+'">');
//         });
//     });
// });