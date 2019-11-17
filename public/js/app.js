// function bindId(id, match) {
//     let field = document.querySelector(match).value = id;

//     return field ? true : false
// }
  
/**
 * Nav
*/
function Nav(o) {
    this.id = o;
}
  
Nav.prototype.click = function() {
    let nav = document.querySelector(this.id);

    if(nav.classList.contains('nav-show')) {
        nav.classList.remove('nav-show');
        nav.classList.add('nav-off');
    } else {
        nav.classList.remove('nav-off');
        nav.classList.add('nav-show');
    }
}