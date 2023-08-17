// suppresion de l'image quand on edit un trick / deleting the image when editing a trick

let links = document.querySelectorAll("[data-delete]");

for (let link of links) {
    link.addEventListener("click", function(image) {
        image.preventDefault();
        const element = this.parentElement;
        console.log(this.dataset)
        if (confirm("voulez-vous supprimer cettte image ?")) {

            fetch(this.getAttribute('href'), {
                method: "DELETE",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({"_token": this.dataset.token})  
            })
            .then(response => response.json())
            .then(data => {
                if (data.succes) {
                    element.parentElement.remove();
                }else {
                    alert(data.error);
                }
            })
        }
    });   
}

// function modification de l'image principal / main image modification function
let editLinks = document.querySelectorAll("[data-edit]");
for (let editLink of editLinks) {
    editLink.addEventListener("click", function(event) {
        event.preventDefault();
        const divButton = this.parentElement;
        const divPosRelative = divButton.parentElement;
        const divHoldPrincipal = document.querySelector('.holdPrincipal');
        console.log(divHoldPrincipal)
        let messageElement = null;
        if (divHoldPrincipal !== null) {
             messageElement = divHoldPrincipal.querySelector("p");
        }
        const divHoldMain = document.querySelector('.holdMain');
        const messageElementMain = divHoldMain.querySelector("p");
        fetch(this.getAttribute('href'), {
            method: "POST", 
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({"_token": this.dataset.token})  
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                divHoldMain.removeChild(messageElementMain);
                if (divHoldPrincipal !== null) {
                    divHoldPrincipal.removeChild(messageElement);
                }
                this.remove();
                divPosRelative.insertAdjacentHTML('beforeend', '<p class="position-absolute top-50 start-50 translate-middle text-center" style="background: white">Image principal</p>');
                alert("L'image principale a été modifiée avec succès.");
            } else {
                alert("Une erreur s'est produite lors de la modification de l'image principale.");
            }
        })
    });   
}
