$(document).ready(function () {
  $('#telefono')
    .keypress(function (event) {
      if (event.which < 48 || event.which > 57 || this.value.length === 9) {
        return false;
      }
    });
});
function rut(evt) {
  if (window.event) {
    keynum = evt.keyCode;
  }
  else{
    keynum = evt.keyCode;
  }
  if ((keynum > 47 && keynum < 58)  || keynum== 8 || keynum== 13 || keynum== 107 || keynum== 32 ) {
    return true;
  }
  else{
    return false;
  }
}
