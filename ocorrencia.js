const add = document.querySelector("#add");
const fch = document.querySelector("#fch");
const cadalct = document.querySelector(".cadalct");

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
