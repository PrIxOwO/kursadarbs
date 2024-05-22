var count = 0;

function cauntOne() {
    count++;
    return i;
}
document.getElementById("demo").innerHTML = count ;




var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var header = document.getElementById("header");
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    header.style.opacity = 1;
  } else {
    header.style.opacity = 0;
  }
  prevScrollpos = currentScrollPos;
};