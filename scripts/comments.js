$(document).ready(function(){
  $('#edit-text').val($('#original-text').html());
});




$('#write_btn').click(function addingComm(){
    // Zmienna przechowuje oryginalną zawartość diva, potrzebne do anulowania
    var original_content = $('#new_comment_text').html();
    var edit_box = '<div class="modal" tabindex="-1" role="dialog">'+
    '<div class="modal-dialog" role="document">'+
      '<div class="modal-content">'+
        '<div class="modal-header">'+
          '<h5 class="modal-title">Modal title</h5>'+
          '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
          '</button>'+
        '</div>'+
        '<div class="modal-body">'+
          '<p>Modal body text goes here.</p>'+
        '</div>'+
        '<div class="modal-footer">'+
          '<button type="button" class="btn btn-primary">Save changes</button>'+
          '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'+
        '</div>'+
      '</div>'+
    '</div>'+
  '</div>';

    

    // $('#new_comment_text').html('<textarea id="comment_text" class="comment-info d-inline-block form-control"></textarea>'+
    // '<div class="text-center mx-auto">'+
    // '<button class="btn btn-secondary write-comment px-4 mx-2" id="cancel_btn">Anuluj</button>'+
    // '<button class="btn btn-success write-comment px-4 mx-2" id="add_btn">Dodaj</button>'+
    // '</div>');

    $('#cancel_btn').click(function (){
        $('#new_comment_text').html(original_content);
        return;
    });

   

});

$('#add_btn').click(function (){
    
    var email = $('#info-email').html();
    var isbn = $('#info-isbn').html();
    var content = $('#comment-text').val();

    $.post('comment_handler.php', {author: email, book: isbn, comment: content, request: 'new'}, function(output){
        $(".modal-body").html(output);
        // $('#new_comment').html('');
        location.reload();
    });
});

$('#edit_btn').click(function (){
    
  var email = $('#info-email').html();
  var isbn = $('#info-isbn').html();
  var content = $('#edit-text').val();

  $.post('comment_handler.php', {author: email, book: isbn, comment: content, request: 'edit'}, function(output){
      $('#original-text').html(output);
      $('#edit_btn').disable();
  });
});