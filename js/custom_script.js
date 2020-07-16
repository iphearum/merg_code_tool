function isNum(evt)
    {
    if (event.type == "paste") {
        return false;
    }
     var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
     return true;
}