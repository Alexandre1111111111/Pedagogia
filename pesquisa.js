const cad = document.querySelector(".cad");
const opt = document.querySelector(".opt");

cad.addEventListener("click", () => {
    opt.style.display = "block";
    setTimeout(() => {
        opt.style.opacity = "1";
    }, 10)
})

window.addEventListener("click", (event) => {
    if (!event.target.matches(".opt")) {
        opt.style.opacity = "0";
        setTimeout(() => {
            opt.style.display = "none";
        }, 300)
    }
})
opt.addEventListener("click", (event) => {
    event.stopPropagation();
})
cad.addEventListener("click", (event) => {
    event.stopPropagation();
})