function open_rating_block(){
  var select_reason = document.getElementById("select_reason").value;
  if (select_reason == 2) {
    document.getElementById('rating-area').classList.add('active');
  } else {
    document.getElementById('rating-area').classList.remove('active');
  }
}
