class Modal {
    constructor(opt) {
        this.modal = opt.modal;
        this.fadeIn = opt.fade || 100;
        this.fadeOut = opt.fade || 100;
        this.opening = opt.opening && opt.opening.bind(this.modal);
        this.closing = opt.closing && opt.closing.bind(this.modal);
        this.handler = {
            open: Array.from(document.querySelectorAll(`*[data-target='#${this.modal.getAttribute('id')}']`)),
            close: Array.from(document.querySelectorAll(`*[data-dismiss='#${this.modal.getAttribute('id')}']`))
        }

        this.handleEvents();

    }

    handleEvents() {
        this.handler.open.forEach(handle => {
            handle.addEventListener('click', e => { this.open(e) });
        });
        
        this.handler.close.forEach(handle => {
            handle.addEventListener('click', e => { this.close(e) });
        });
    }

    open(e) {
        this.opening && this.opening(e.originalTarget);
        
        this.modal.classList.contains('modal-show') || this.modal.classList.add('modal-show');
        setTimeout(() => { this.modal.classList.add('modal-fadeIn'); }, this.fadeIn);
    }

    close(e) {
        this.closing && this.closing(e.originalTarget);
    
        this.modal.classList.add('modal-fadeOut');
        setTimeout(() => {
            this.modal.classList.remove('modal-fadeIn');
            this.modal.classList.remove('modal-fadeOut');
            this.modal.classList.remove('modal-show');
        }, this.fadeOut);
    }
}

export default Modal;