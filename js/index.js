
$(".list-group-item").click(function () {
    this.firstChild.click();
});

Date.prototype.addDays = function(days) {
    var dat = new Date(this.valueOf());
    dat.setDate(dat.getDate() + days);
    return dat;
}
$("#numDay").change(function(){
    var date=new Date($('#startDate').val());
    var number=$("#numDay").val();
    var newDate=date.addDays(parseInt(number));
    var month = newDate.getMonth() + 1;
    month= (month) < 10 ? '0' + month : '' + month;
    var day=newDate.getDate();
    day=(day) < 10 ? '0' + day : '' + day;
    var string=newDate.getFullYear()+'-'+month+'-'+day;
    // alert(mth);
    $("#endDate").val(string);
});

$("#startDate").change(function(){
    var date=new Date($('#startDate').val());
    var number=$("#numDay").val();
    var newDate=date.addDays(parseInt(number));
    var month = newDate.getMonth() + 1;
    month= (month) < 10 ? '0' + month : '' + month;
    var day=newDate.getDate();
    day=(day) < 10 ? '0' + day : '' + day;
    var string=newDate.getFullYear()+'-'+month+'-'+day;
    // alert(mth);
    $("#endDate").val(string);
});


// dat.getDay()-dat.getMonth()-dat.getFullYear()
