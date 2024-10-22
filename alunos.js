const cad = document.querySelector(".cad");
const opt = document.querySelector(".opt");
const cadalct = document.querySelector(".cadalct");
const add = document.querySelector("#add");
const fch = document.querySelector("#fch");
const alunos = document.querySelector(".alunos");
const del = document.querySelector('.del');
const fche = document.querySelector("#fche");
const excct = document.querySelector(".excct");
const delet = document.querySelector(".delet");
const fchd = document.querySelector("#fchd");
const editar = document.querySelector(".editar");
const edict = document.querySelector(".edict");

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

window.addEventListener("click", (event) => {
    if (!event.target.matches(".alunos")) {
        del.style.opacity = "0";
        del.style.bottom = "-12vh";
        setTimeout(() => {
            del.style.display = "none";
        }, 300)
    }
})
del.addEventListener("click", (event) => {
    event.stopPropagation();
})

alunos.addEventListener("click", (event) => {
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

const altr = document.querySelectorAll(".alunos tr");
const cg = document.querySelectorAll(".cg");
const cgme = document.querySelector(".cgme");

let cgmid;

for (let i = 0; i < altr.length; i++) {
    altr[i].addEventListener("click", () => {
        cgmid = cg[i].textContent;
        cgme.value = cgmid;
    }) 
}

fchd.addEventListener("click", () => {
    edict.style.opacity = "0";
    setTimeout(() => {
        edict.style.display = "none";
    }, 300)
})

editar.addEventListener("click", () => {
    edict.style.display = "flex";
    setTimeout(() => {
        edict.style.opacity = "1";
    }, 10)
})