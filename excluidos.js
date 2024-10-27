const del = document.querySelector('.del');
const altr = document.querySelectorAll(".alunos tr");
const alunos = document.querySelector(".alunos");
const excct = document.querySelector(".excct");
const delet = document.querySelector(".delet");
const fche = document.querySelector("#fche");
const opt = document.querySelector(".opt");
const cad = document.querySelector(".cad");
const addp = document.querySelector("#addp");
const cadalct = document.querySelector(".cadalct");
const fch = document.querySelector("#fch");


const nm = document.querySelectorAll(".nm");
const al = document.querySelector("#pe");

let alunonm;

for (let i = 0; i < altr.length; i++) {
    altr[i].addEventListener("click", () => {
        alunonm = nm[i].textContent;
        al.value = alunonm;
        for (let j = 0; j < altr.length; j++) {
            altr[j].style.backgroundColor = "";
            altr[j].style.borderColor = "";
        }
        altr[i].style.backgroundColor = "#dddddd";
        altr[i].style.borderColor = "#73e964";
    }) 
}

cad.addEventListener("click", () => {
    opt.style.display = "block";
    setTimeout(() => {
        opt.style.opacity = "1";
    }, 10)
    cad.style.backgroundColor = "#d1d1d1";
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
alunos.addEventListener("click", (event) => {
    event.stopPropagation();
})

const na = document.querySelector(".na");
const th = document.querySelector("table thead");

if(altr.length == 0) {
    na.style.display = "flex";
    th.style.display = "none";
}