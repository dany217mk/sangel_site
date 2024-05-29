function notification(str, incident='usual', time=2000){
    let div = document.createElement('div');
    let incidents = ['success', 'error', 'notice', 'warning'];
    let classIncident = incident;
    if (incidents.indexOf(classIncident) == -1) {
      classIncident = 'usual';
    }
    div.classList.add(classIncident);
    div.id = "notification";
    let title = document.createElement("span");
    title.innerHTML = str;
    div.append(title);
    document.body.append(div);
    div.classList.add('active');
    setTimeout(function() {
      div.classList.add('darker');
    }, time);
    setTimeout(function() {
      div.className = '';
    div.remove();
    }, time+200);
}

function report(str, time=4000){
    let blockMas = document.getElementsByClassName('report');
    if (blockMas.length > 0){
      return;
    }
    let div = document.createElement('div');
    div.classList.add('report');
    div.id = "report";
    let title = document.createElement("span");
    title.innerHTML = str;
    div.append(title);
    document.body.append(div);
    div.classList.add('active');
    setTimeout(function() {
      div.classList.add('darker');
    }, time);
    setTimeout(function() {
      div.className = '';
    div.remove();
    }, time+200);
}

function openMenu(){
  document.getElementById('nav').classList.toggle('active');
}




function openAccountMenu() {
  document.getElementById('account-menu').classList.toggle('active');
}

let html = document.querySelector('html');
html.addEventListener('click', function(event) {
 let target = event.target;
 let boolAccount = false;
 let boolNav = false;
 try {
   while (target.tagName != 'HTML'){
     if (target.id == 'account-menu' || target.id == 'account'){
       boolAccount = true;
     }
     if (target.id == 'nav' || target.id == 'menu') {
       boolNav = true
     }
     target = target.parentNode;
   }
 } catch (e) {}
 if (!boolAccount && typeof boolHomePage == 'undefined'){
   document.getElementById('account-menu').classList.remove('active');
 }
 if (!boolNav){
   document.getElementById('nav').classList.remove('active');
 }
});
