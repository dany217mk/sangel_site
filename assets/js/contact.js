let fioError = document.getElementById('error-fio');
let emailError = document.getElementById('error-email');
let reasonError = document.getElementById('error-reason');
let textError = document.getElementById('error-text');

let emailCheck = /^[a-z0-9_.-]+@([a-z0-9-]+\.)+[a-z]{2,6}$/i;

let email = document.getElementById('email');
let fio = document.getElementById('fio');
let select_reason = document.getElementById('select_reason');
let text = document.getElementById('text');



select_reason.onchange = function(){
  if (select_reason.value == 2) {
    document.getElementById('rating-area').classList.add('active');
    textError.innerHTML = "";
  } else {
    document.getElementById('rating-area').classList.remove('active');
    reasonError.innerHTML = "";
  }
}


email.oninput = function(){
    if (email.value.trim() != ""){
      email.classList.add("valid");
    } else {
      email.classList.remove("valid");
    }
    if (emailCheck.test(email.value)){
      emailError.innerHTML = "";
    }
}
fio.oninput = function(){
    if (fio.value.trim() != ""){
      fio.classList.add("valid");
    } else {
      fio.classList.remove("valid");
    }
    if (fio.value.trim() != "" || fio.value.length <= 64 || fio.value.length >= 5) {
      fioError.innerHTML = "";
    }
  }
  text.oninput = function(){
      if (text.value.trim() != ""){
        text.classList.add("valid");
      } else {
        text.classList.remove("valid");
      }
      if (text.value.trim() != "" || text.value.length <= 3000) {
          textError.innerHTML = "";
      }
  }

document.getElementById('form-feedback').onsubmit = function(){
    let counter = 0;
    if (!emailCheck.test(email.value)){
          emailError.innerHTML = "Неверный email";
      } else{
          counter++;
      }
    if (fio.value.trim() == "" || fio.value.length > 64 || fio.value.length < 5){
        fioError.innerHTML = "Неверный формат ФИО";
    } else{
        counter++;
    }
    if (select_reason.value == 0){
      reasonError.innerHTML = "Выберите причину обращения";
    } else{
      counter++;
    }
    if ((text.value.trim() == "" || text.value.length > 3000) && select_reason.value != 2){
      textError.innerHTML = "Неверный формат текста";
    } else{
      counter++;
    }
    if (select_reason.value == 2 && text.value.trim() == "" && this.rating.value.trim() === "") {
      report("Поставьте оценку или напишите текст отзыва");
    } else {
      counter++;
    }
    if (counter != 5){
      notification("Неверно заполнены поля!", 'error');
      return false;
    }
  }
