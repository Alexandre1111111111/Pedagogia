const addo = document.querySelector("#addo");
const fch = document.querySelector("#fch");
const cadalct = document.querySelector(".cadalct");
const cad = document.querySelector(".cad");
const opt = document.querySelector(".opt");
const altr = document.querySelectorAll(".alunos tr");

if(document.querySelector("#addo")) {
addo.addEventListener("click", () => {
    cadalct.style.display = "flex";
    setTimeout(() => {
        cadalct.style.opacity = "1";
    }, 10)
})
}

cad.addEventListener("click", () => {
    opt.style.display = "block";
    setTimeout(() => {
        opt.style.opacity = "1";
    }, 10)
    cad.style.backgroundColor = "#d1d1d1";
})


fch.addEventListener("click", () => {
    cadalct.style.opacity = "0";
    setTimeout(() => {
        cadalct.style.display = "none";
    }, 300)
})

window.addEventListener("click", (event) => {
    if (!event.target.matches(".opt")) {
        opt.style.opacity = "0";
        setTimeout(() => {
            opt.style.display = "none";
        }, 300)
        cad.style.backgroundColor = "";
    }
})
opt.addEventListener("click", (event) => {
    event.stopPropagation();
})
cad.addEventListener("click", (event) => {
    event.stopPropagation();
})

const na = document.querySelector(".na");
const th = document.querySelector("table thead");

if(altr.length == 0 && !document.querySelector("#addo")) {
    na.style.display = "flex";
    th.style.display = "none";
}