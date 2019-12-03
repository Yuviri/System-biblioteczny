// raporty po dniu
function day_search() {
    var rok = $('#rok').val();
    var miesiac = $('#miesiac').val();
    var dzien = $('#dzien').val();

    if(dzien==''){
        //Raport miesięczny
        var date = rok + "-" + miesiac; 
    } else{
        //Raport dniowy
        var date = rok + "-" + miesiac + "-" + dzien;
    }

    

    $.post('includes/stats_script.inc.php', {date: date}, function(final){
        $("#rep_page").html(final);
    });
}