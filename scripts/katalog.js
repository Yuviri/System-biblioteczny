function searchq() {
    // Pobranie wartości z formularza

    var searchInput = $('#search_input').val();
    var filter_ad = $('#asc_desc').val();
    var filter_an = $('#alpha_num').val();

    //Kontakt z php

    $.post('search.php', {searchVal: searchInput, asc_desc: filter_ad, alpha_num: filter_an}, function(output){
        $("#r_w").html(output);
    });

}

function searchUser() {
    // Pobranie wartości z formularza

    var searchInput = $('#czytelnik').val();

    //Kontakt z php

    $.post('search_user.php', {searchVal: searchInput}, function(output){
        $("#c-list").html(output);
    });

}

function searchBook() {
    // Pobranie wartości z formularza

    var searchInput = $('#egzemplarz').val();

    //Kontakt z php

    $.post('search_book.php', {searchVal: searchInput}, function(output){
        $("#b-list").html(output);
    });

}

//Chowanie i pokazywanie podpowiedzi przy czytelniku

$('#czytelnik').keyup(function(){
    if($('#czytelnik').val().length == 0){
        $('#c-list').hide();
    } else {
        $('#c-list').show();
    }
}).keyup();



$(document).on('click','.user-suggestion', function(){
    var value = $(this).attr('id');
    $('#czytelnik').val(value);
    $('#c-list').hide();
});

//Chowanie i pokazywanie podpowiedzi przy egzemplarzu

$('#egzemplarz').keyup(function(){
    if($('#egzemplarz').val().length == 0){
        $('#b-list').hide();
    } else {
        $('#b-list').show();
    }
}).keyup();



$(document).on('click','.book-suggestion', function(){
    var value = $(this).attr('id');
    $('#egzemplarz').val(value);
    $('#b-list').hide();
});



//Przypisywanie funkcji

$('select').change(function(){searchq()});
$('#czytelnik').keyup(function(){searchUser()});
$('#egzemplarz').keyup(function(){searchBook()});

