/*****||||||||||||||||||||||||||||||||||||||||||*****\
                @Jérémy @27/07/2018                            
\*****||||||||||||||||||||||||||||||||||||||||||*****/

/*****||||||||||||||||||||||||||||||||||||||||||*****\
                INSERT CLASS W ID VAL()                   
\*****||||||||||||||||||||||||||||||||||||||||||*****/
function test(btm){
  var previous = $(btm).prev();
  var curr_input_val = previous.val();
  var p_todo = previous.prev();
  p_todo.append(' #' + curr_input_val);
}

$(document).ready(function(){
  $('#btn').click(function(){
    $.ajax({
      type: 'GET',
      url: 'server.php',
      success: function(data){
        $('ul').append('<li>' + data + '</li>');
      }  
    }) 
  })  
    // $('#btn_list').click(function(){
    //   if ($('#note').val() != '')
    //   {
    //     $('ul').append('<li class="note">' + $('#note').val() + '</li>');
    //   }
    //   if ($('#email').val() != '')
    //   {
    //     $('ul').append('<li class="email">' + $('#email').val() + '</li>');
    //   }
    //   if ($('#todo').val() != '')
    //   {
    //     $('ul').append('<li class="todo">' + $('#todo').val() + '</li>');
    //     if($('#checkbox_todo').is(':checked')){
    //       $('<input type="text" class="input_tag" placeholder="add_tag"/>').insertAfter('.todo:last');
    //       $('<button onClick="test(this)" class="submit_tag">Submit</button><br>').insertAfter('.input_tag:last');
    //     }
    //   }
    });

/*****||||||||||||||||||||||||||||||||||||||||||*****\
                FILTER WITH CHECKBOX                   
\*****||||||||||||||||||||||||||||||||||||||||||*****/

    // $(':checkbox').click(function(){
    //   if ($('#checkbox_note').is(':checked') || $('#checkbox_email').is(':checked') ||$('#checkbox_todo').is(':checked'))
    //   {
    //     if ($('#checkbox_note').is(':checked'))
    //       $('.note').show();
    //     else
    //       $('.note').hide();
    //     if ($('#checkbox_email').is(':checked'))
    //       $('.email').show();
    //     else
    //       $('.email').hide();
    //     if ($('#checkbox_todo').is(':checked'))
    //       $('.todo').show();
    //     else
    //       $('.todo').hide();
    //   }
    //   else
    //   {
    //     $('.note').show();
    //     $('.email').show();
    //     $('.todo').show();
    //   }
    // });
  });
  
/*****||||||||||||||||||||||||||||||||||||||||||*****\
                SEARCH WITH A FILTER                     
\*****||||||||||||||||||||||||||||||||||||||||||*****/

// $("#search").on("keyup", function(){
//     var value = $(this).val().toLowerCase();
//     $("ul li").filter(function(){
//       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//     });
// });

/*****||||||||||||||||||||||||||||||||||||||||||*****\
                  ADD TAG FOR "TODO"                     
\*****||||||||||||||||||||||||||||||||||||||||||*****/

