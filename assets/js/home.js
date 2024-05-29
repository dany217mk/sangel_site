

// cursor
document.body.onmousemove = function(event){
  let x, y;
  if (document.all)  {
      x = event.x + document.body.scrollLeft;
      y = event.y + document.body.scrollTop;
  } else {
      x = event.pageX;
      y = event.pageY;
  }
  document.getElementById("cursor").style.left = (x+2) + "px";
  document.getElementById("cursor").style.top = (y+2) + "px";
}



let email = document.getElementById('email');
let fio = document.getElementById('fio');
let form_products = document.getElementById('form_products');


let emailCheck = /^[a-z0-9_.-]+@([a-z0-9-]+\.)+[a-z]{2,6}$/i;
let fioCheck = /^[А-ЯЁ][а-яё]*([-][А-ЯЁ][а-яё]*)?\s[А-ЯЁ][а-яё]*\s[А-ЯЁ][а-яё]*$/


document.getElementById('form-res').onsubmit = function(){
    let counter = 0;
    if (!emailCheck.test(email.value)){
          email.classList.add("errorInput");
      } else{
          counter++;
      }
    if (fio.value.trim() == "" || fio.value.length > 64 || fio.value.length < 5){
        fio.classList.add("errorInput");
    } else{
        counter++;
    }
    if (this.form_products.value == 0){
      this.form_products.classList.add("errorInput");
    } else{
      counter++;
    }
    if (counter != 3){
      notification("Неверно заполнены поля!", 'error');
      return false;
    }
  }



email.onfocus = function(){
  email.classList.remove("errorInput");
}
email.onblur = function(){
    if (!emailCheck.test(email.value)){
        email.classList.add("errorInput");
    }
}

fio.onfocus = function(){
  fio.classList.remove("errorInput");
}
fio.onblur = function(){
    if (fio.value.trim() == "" || fio.value.length > 64 || fio.value.length < 5){
        fio.classList.add("errorInput");
    }
}


form_products.onfocus = function(){
  form_products.classList.remove("errorInput");
}
form_products.onblur = function(){
  if (form_products.value == 0) {
    form_products.classList.add("errorInput");
  }

}
