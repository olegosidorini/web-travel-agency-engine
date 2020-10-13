//--------------------------------------------------------------------
//--------------  Функция отправки формы заказа тура -----------------
//----------------------------------------------------------------------
function verify() {
  var err;
  function emailCheck (emailStr) {
    var emailPat=/^(.+)@(.+)$/;
    var matchArray=emailStr.match(emailPat);
    if (matchArray==null) {
      return false;
    }
    return true;
  }

  var themessage = "";
  if (document.up_form.fio.value=="") {
    themessage = themessage + " - Вы незаполнили поле : Имя\n";
  }
  if (document.up_form.email.value !="" & !emailCheck(document.up_form.email.value)) {
    themessage = themessage + " - Неправильный e-mail адрес\n";
  }
  if (document.up_form.email.value=="") {
    themessage = themessage + " - Вы ненаписали контактный E-mail\n";
  }
  //if (document.up_form.residing_info.value=="") {
  //themessage = themessage + " - Вы не заполнили информацию по размещению\n";
  //}
  if (document.up_form.phone.value=="") {
    themessage = themessage + " - Вы ненаписали контактный телефон\n";
  }
  if (document.up_form.date_s && document.up_form.date_s.value=="") {
    themessage = themessage + " - Вы не указали дату заезда\n";
  }
  if (document.up_form.date_e && document.up_form.date_e.value=="") {
    themessage = themessage + " - Вы не указали дату выезда\n";
  }
  err = themessage;
  if (err == "") {
    return sendForm();
  } else {
    alert(themessage);
  return false;
  }
}

function ref_reset(){
  document.up_form.fio.value="";
  document.up_form.email.value="";
  //document.up_form.residing_info.value="";
  document.up_form.date_s.value="";
  document.up_form.date_e.value="";
  document.up_form.phone.value="";
}

function sendForm ()
{
console.log(region)
  var email = $("#email").val();
  var fio = $("#fio").val();
  var residing_info = $("#residing_info").val();
  var phone = $("#phone").val();
  var date_s = $("#date_s").val();
  var date_e = $("#date_e").val();

  $.post("lib/post_form.php", { email: email, fio: fio, residing_info: residing_info, phone: phone,  date_s: date_s, date_e: date_e,  region: region, object: object}, function(data){$('#ve_content').html(data)});
}


