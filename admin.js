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

addp.addEventListener("click", () => {
    cadalct.style.display = "flex";
    setTimeout(() => {
        cadalct.style.opacity = "1";
    }, 10)
})

cad.addEventListener("click", () => {
    opt.style.display = "block";
    setTimeout(() => {
        opt.style.opacity = "1";
    }, 10)
    cad.style.backgroundColor = "#d1d1d1";
})

window.addEventListener("click", (event) => {
    if (!event.target.matches(".alunos")) {
        del.style.opacity = "0";
        del.style.bottom = "-12vh";
        setTimeout(() => {
            del.style.display = "none";
        }, 300)
        for (let i = 0; i < altr.length; i++) {
            altr[i].style.backgroundColor = "";
        }
    }
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

del.addEventListener("click", (event) => {
    event.stopPropagation();
})

alunos.addEventListener("click", (event) => {
    event.stopPropagation();
})

excct.addEventListener("click", (event) => {
    event.stopPropagation();
})

fche.addEventListener("click", () => {
    excct.style.opacity = "0";
    setTimeout(() => {
        excct.style.display = "none";
    }, 300)
})

delet.addEventListener("click", () => {
    excct.style.display = "flex";
    setTimeout(() => {
        excct.style.opacity = "1";
    }, 10)
})

fch.addEventListener("click", () => {
    cadalct.style.opacity = "0";
    setTimeout(() => {
        cadalct.style.display = "none";
    }, 300)
})