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
const altr = document.querySelectorAll(".alunos tr");

if(document.querySelector("#add")) {
add.addEventListener("click", () => {
    cadalct.style.display = "flex";
    setTimeout(() => {
        cadalct.style.opacity = "1";
    }, 10)
})
}

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
del.addEventListener("click", (event) => {
    event.stopPropagation();
})

alunos.addEventListener("click", (event) => {
    event.stopPropagation();
})

edict.addEventListener("click", (event) => {
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

const nm = document.querySelectorAll(".nm");
const cp = document.querySelector("#cp");
const al = document.querySelector("#al");

const ne = document.querySelectorAll(".ne");

const tu = document.querySelectorAll(".tu");
const tfe = document.querySelectorAll(".tfe");
const tfr = document.querySelectorAll(".tfr");
const en = document.querySelectorAll(".en");
const med = document.querySelectorAll(".med");

const turmae = document.querySelector("#turmae");
const telefonee = document.querySelector("#telefonee");
const telrese = document.querySelector("#telrese");
const ende = document.querySelector("#ende");
const saudee = document.querySelector("#saudee");

const cg = document.querySelectorAll(".cg");
const cgm = document.querySelector("#cgm");
const env = document.querySelector("#env");

const nme = document.querySelector("#nme");

let alunonm;
let alunone;

for (let i = 0; i < altr.length; i++) {
    altr[i].addEventListener("click", () => {
        alunonm = nm[i].textContent;
        alunone = ne[i].textContent;
        cp.value = alunonm;
        al.value = alunonm;
        nme.value = alunone;
        turmae.value = tu[i].textContent;
        telefonee.value = tfe[i].textContent;
        telrese.value = tfr[i].textContent;
        ende.value = en[i].textContent;
        saudee.value = med[i].textContent;
        for (let j = 0; j < altr.length; j++) {
            altr[j].style.backgroundColor = "";
            altr[j].style.borderColor = "";
        }
        altr[i].style.backgroundColor = "#dddddd";
        altr[i].style.borderColor = "#73e964";
        let link = document.querySelector("#expp");
        let blob = new Blob([`${altr[i].textContent.replace('Ver', '')}`], { type: "text/plain" });
        link.addEventListener("click", () => {
        link.href = URL.createObjectURL(blob);
        link.download = "Aluno.txt";
        })
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

setInterval(() => {
    for (let i = 0; i < cg.length; i++) {
    if(cg[i].textContent == cgm.value) {
        env.style.pointerEvents = "none";
        env.style.opacity = "0.5";
    }
    else {
        env.style.pointerEvents = "auto";
        env.style.opacity = "1";
    }
}
}, 0)

const na = document.querySelector(".na");
const th = document.querySelector("table thead");

if(altr.length == 0 && !document.querySelector("#add")) {
    na.style.display = "flex";
    th.style.display = "none";
}
else if(altr.length == 0) {
    na.style.display = "flex";
    th.style.display = "none";
    na.textContent = "Nenhum aluno cadastrado";
    na.style.backgroundColor = "#dddddd";
    na.style.borderColor = "#585858";
}