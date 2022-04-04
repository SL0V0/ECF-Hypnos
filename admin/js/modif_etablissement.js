let btnSubmit = document.getElementById('btnSubmit')

let queryString = window.location.search;
let urlParams = new URLSearchParams (queryString);
let id = urlParams.get('id')

id = parseInt(id)

btnSubmit.addEventListener('click', function(event)
{
    event.preventDefault()

    let main = document.querySelector('main')

    let nom = document.getElementById('nom')
    let ville = document.getElementById('ville')
    let adresse = document.getElementById('adresse')
    let description = document.getElementById('description')

    let divError = document.querySelectorAll('.divError')

    let etablissement = {

        nom: nom.value,
        ville: ville.value,
        adresse: adresse.value,
        description: description.value,
        id: id
    }

    if(nom.value.length == 0)
    {
        divError[0].style.visibility = "visible"
        nom.style.borderColor = "red"
    }
    else
    {
        divError[0].style.visibility = "hidden"
        nom.style.borderColor = "#bd9e56"
    }

    if(ville.value.length == 0)
    {
        divError[1].style.visibility = "visible"
        ville.style.borderColor = "red"
    }
    else
    {
        divError[1].style.visibility = "hidden"
        ville.style.borderColor = "#bd9e56"
    }

    if(adresse.value.length == 0)
    {
        divError[2].style.visibility = "visible"
        adresse.style.borderColor = "red"
    }
    else
    {
        divError[2].style.visibility = "hidden"
        adresse.style.borderColor = "#bd9e56"
    }

    if(description.value.length == 0)
    {
        divError[3].style.visibility = "visible"
        description.style.borderColor = "red"
    }
    else
    {
        divError[3].style.visibility = "hidden"
        description.style.borderColor = "#bd9e56"
    }

    if(nom.value.length !== 0 && ville.value.length !== 0 && adresse.value.length !== 0 && description.value.length !== 0)
    {
        $.ajax({
            url: "js/ajax/ajax_modif_etablissement.php",
            method: "post",
            data: {donnees: JSON.stringify(etablissement)},
            success: function(res) {

                let reponse = JSON.parse(res)

                console.log(reponse)

                if(reponse.nom == 1)
                {
                    divError[0].style.visibility = "visible"
                    nom.style.borderColor = "red"
                }
                else
                {
                    divError[0].style.visibility = "hidden"
                    nom.style.borderColor = "#bd9e56"
                }

                if(reponse.ville == 1)
                {
                    divError[1].style.visibility = "visible"
                    ville.style.borderColor = "red"
                }
                else
                {
                    divError[1].style.visibility = "hidden"
                    ville.style.borderColor = "#bd9e56"
                }

                if(reponse.adresse == 1)
                {
                    divError[2].style.visibility = "visible"
                    adresse.style.borderColor = "red"
                }
                else
                {
                    divError[2].style.visibility = "hidden"
                    adresse.style.borderColor = "#bd9e56"
                }

                if(reponse.description == 1)
                {
                    description.style.borderColor = "red"
                    divError[3].style.visibility = "visible"
                }
                else
                {
                    description.style.borderColor = "#bd9e56"
                    divError[3].style.visibility = "hidden"
                }
                if(reponse.id == 1)
                {
                    window.location.replace("administration.php");
                }

                if(reponse.nom == 0 && reponse.ville == 0 && reponse.adresse == 0 && reponse.description == 0 && reponse.id == 0)
                {
                    main.innerHTML = `<h1>Etablissement modifié !</h1>`
                    function redirection()
                    {
                        window.location.replace("administration.php");
                    }
                    setTimeout(redirection, 3000)
                }
                
            }
        })
    }
})