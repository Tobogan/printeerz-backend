$( document ).ready( function() {
    $('#commentForm').on('submit', function comment(e) {
        e.preventDefault(); 
        var name = $('#name').val();
        var message = $('#message').val();
        var event_id = $('#event_id').val();
        var user_id = $('#user_id').val();
        var user_nom = $('#user_nom').val();
        var user_prenom = $('#user_prenom').val();
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
                $('.event_comments_list1').append('<div class="row">' + '<div class="col-3">' + '<div>' + user_prenom + ' ' + user_nom + '</div>'+'<br>' + '<small>(' + today+ ')</small>' + '</div>' + '<div class="col">' + '<div>' + name + '</div>' + '<hr>' + message + '</div></div><br>');                
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
                $('#select_color1').append('<option value="' + data.couleur.id +'" >' + data.couleur.nom + '</option>');
                $('#select_color2').append('<option value="' + data.couleur.id +'" >' + data.couleur.nom + '</option>');
                $('#select_color3').append('<option value="' + data.couleur.id +'" >' + data.couleur.nom + '</option>');
                console.log(data.couleur)
            }
        });
    });
});