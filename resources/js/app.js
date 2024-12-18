import './bootstrap';
import.meta.glob([
    '../images/**',
    '../fonts/**',
]);


function adjustMainHeight() {
    let header = document.getElementsByTagName("header")[0];
    let main = document.getElementsByTagName("main")[0];
    let headerHeight = header.offsetHeight;
    let windowHeight = window.innerHeight;
    let newHeight = windowHeight - headerHeight + "px";
    main.style.height = newHeight;
    console.log("Nouvelle hauteur:", newHeight, "Hauteur du main:", main.style.height);
}

adjustMainHeight()

