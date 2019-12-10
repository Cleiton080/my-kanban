const modal = modalElement => {
    const modalId = modalElement.getAttribute("id");
    const handlersOpen = Array.from(document.querySelectorAll(
        `*[data-target='#${modalId}']`
    ));
    const handlersClose = Array.from(document.querySelectorAll(
        `*[data-dismiss='#${modalId}']`
    ));

    return {
        init: open => {
            // Close
            handlersClose.forEach(handlerClose => {
                handlerClose.addEventListener("click", () => {
                    modalElement.classList.remove("modal-fadeIn");
                    modalElement.classList.remove("modal-show");
                });
            });

            // Open
            handlersOpen.forEach(handlerOpen => {
                handlerOpen.addEventListener("click", () => {
                    modalElement.classList.contains("modal-show") ||
                        modalElement.classList.add("modal-show");
                    modalElement.classList.add("modal-fadeIn");
    
                    if (Function.prototype.isPrototypeOf(open))
                        open(modalElement, handlerOpen);
                });
            });
        }
    };
};
