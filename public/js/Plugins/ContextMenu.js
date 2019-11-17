class ContextMenu {
    constructor(opt) {
        this.wrapper = Array.from(opt.wrapper);
        this.menu = opt.menu;
        this.lastEventElement = null;
    
        this.handler();
    }

    handler() {
        this.wrapper.forEach(element => {
            element.addEventListener('contextmenu', e => {
                e.preventDefault();
                this.rightClick(e);
            });

            document.addEventListener('click', e => {
                if(e.button === 0)
                    this.leftClick(e);
            });

        });
    }
    

    rightClick(e) {
        this.menu.style.display = 'block';
        this.menu.style.left = e.pageX + 'px';
        this.menu.style.top = e.pageY + 'px';
        this.lastEventElement = e.originalTarget;
    }

    leftClick(e) {
        this.menu.style.display = 'none';
    }
}

export default ContextMenu;