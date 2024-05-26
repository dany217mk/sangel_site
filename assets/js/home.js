

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
