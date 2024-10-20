const cad = document.querySelector(".cad");
const opt = document.querySelector(".opt");
const cadalct = document.querySelector(".cadalct");
const add = document.querySelector("#add");
const fch = document.querySelector("#fch");
add.addEventListener("click", () => {
    cadalct.style.display = "flex";
    setTimeout(() => {
        cadalct.style.opacity = "1";
    }, 10)
})

fch.addEventListener("click", () => {
    cadalct.style.opacity = "0";
    setTimeout(() => {
        cadalct.style.display = "none";
    }, 300)
})

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