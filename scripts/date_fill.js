var today = new Date();

var year1 = today.getFullYear();
var month1 = today.getMonth();
if(month1<10){
    month1 = "0"+month1;
}
var day1 = today.getDate();
if(day1<10){
    day1 = "0"+day1;
}

var date_o = year1+"-"+month1+"-"+day1;

$('#od').val(date_o);

var estimated_date = new Date();
estimated_date.setDate(estimated_date.getDate()+30);


var year2 = estimated_date.getFullYear();
var month2 = estimated_date.getMonth();
if(month2<10){
    month2 = "0"+month2;
}
var day2 = estimated_date.getDate();
if(day2<10){
    day2 = "0"+day2;
}

var date_d = year2+"-"+month2+"-"+day2;

$('#do').val(date_d);
