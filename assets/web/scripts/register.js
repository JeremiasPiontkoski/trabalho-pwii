
window.onload = () =>{
    forPerson.forEach(e => {
        e.classList.remove("none")
        e.disabled = false
    })

    forCompany.forEach(e => {
        e.classList.add("none")
        e.disabled = true
    })
}

let selectTypeUser = document.querySelector("#userType");

let forPerson = document.querySelectorAll(".forPerson");
let forCompany = document.querySelectorAll(".forCompany");


selectTypeUser.addEventListener("change", (e) => {
    e.preventDefault()

    let value = selectTypeUser.options[selectTypeUser.selectedIndex].value

    if(value == "person") {
        addPersonField()
    }else {
        addCompanyField()
    }
})

function addPersonField() {
    forPerson.forEach(e => {
        e.classList.remove("none")
        e.disabled = false
    })

    forCompany.forEach(e => {
        e.classList.add("none")
        e.disabled = true
    })
}

function addCompanyField() {
    forPerson.forEach(e => {
        e.classList.add("none")
        e.disabled = true
    })

    forCompany.forEach(e => {
        e.classList.remove("none")
        e.disabled = false
    })
}