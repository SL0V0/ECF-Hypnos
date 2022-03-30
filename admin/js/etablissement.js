let btnSubmit = document.getElementById('btnSubmit')

btnSubmit.addEventListener('click', function(event)
{
    event.preventDefault()

    let nom = document.getElementById('nom')
    let ville = document.getElementById('ville')
    let adresse = document.getElementById('adresse')
    let description = document.getElementById('description')

    let divError = document.querySelectorAll('.divError')

    let etablissement = {

        nom: nom.value,
        ville: ville.value,
        adresse: adresse.value,
        description: description.value
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

    if(nom.value.length !== 0 && prenom.value.length !== 0 && email.value.length !== 0 && sujet.value.length !== 0 && message.value.length !== 0)
    {
        $.ajax({
            url: "js/ajax/ajax_etablissement.php",
            method: "post",
            data: {donnees: JSON.stringify(etablissement)},
            success: function(res) {

                let reponse = JSON.parse(res)

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

                if(reponse.nom == 0 && reponse.ville == 0 && reponse.adresse == 0 && reponse.dexcription == 0)
                {
                    main.innerHTML = `<h1>Etablissement ajouté !</h1>`
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