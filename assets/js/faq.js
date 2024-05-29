function show_answer(question_id) {
   document.getElementById("question" + question_id).classList.toggle('active');
   document.getElementById("answer" + question_id).classList.toggle('active');
}
