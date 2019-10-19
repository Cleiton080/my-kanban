function bindId(id, match) {
    let field = document.querySelector(match).value = id;

    return field ? true : false
}

/**
 * Modal
*/
function Modal(modal) {
    this.fadeIn = modal.fadeIn;
    this.fadeOut = modal.fadeOut;
}
  
Modal.prototype.open = function(id) {
    let modal = document.querySelector(`#${id}`);

    modal.classList.contains('modal-show') || modal.classList.add('modal-show');
    setTimeout(function(){ modal.classList.add('modal-fadeIn'); }, this.fadeIn);
}
  
Modal.prototype.close = function() {
    let modal = document.querySelector('.modal-show');

    modal.classList.add('modal-fadeOut');
    setTimeout(function(){
        modal.classList.remove('modal-fadeIn');
        modal.classList.remove('modal-fadeOut');
        modal.classList.remove('modal-show');
    }, this.fadeOut)
}
  
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

// Contextmenu
function ContextMenu(o) {
    this.menu = o.menu;
    this.visible = false;
    this.display = o.display;
    this.parentElement = null;
}

ContextMenu.prototype.clickRight = function(e) {
    e.preventDefault();
    if(this.visible) return;

    this.menu.style.display = this.display.show;
    this.menu.style.top = `${e.pageY}px`;
    this.menu.style.left = `${e.pageX}px`;
    this.parentElement = e.originalTarget;
}

ContextMenu.prototype.clickLeft = function(e) {
    if(e.button === 0) this.menu.style.display = this.display.hidden;
}