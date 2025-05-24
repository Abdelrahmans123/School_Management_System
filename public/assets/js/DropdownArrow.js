function DropdownArrow(arrow) {
    for (let i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (event) => {
            let arrowParent = event.target.parentElement.parentElement;
            let link = event.target.parentElement;
            arrowParent.classList.toggle("showMenu");
            link.classList.toggle("active");
        });
    }
}
