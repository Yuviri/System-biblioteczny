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

$('select').change(function(){searchq()});