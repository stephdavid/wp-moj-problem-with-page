function get_user_timezone() {
    var d = new Date();
    var n = d.getTimezoneOffset();
    document.getElementById("timezone").innerHTML = n;
}
// n.b. the returned value is not a constant, because of the practice of using Daylight Saving Time.
// From the end of March to the end of October the offset for the UK(GMT) will display as -60