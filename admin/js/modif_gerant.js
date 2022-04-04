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
    let prenom = document.getElementById('prenom')
    let email = document.getElementById('email')
    let ville = document.getElementById('ville')
    let mdp = document.getElementById('password')
    let confPass = document.getElementById('confPass')

    console.log(ville.value)

    let divError = document.querySelectorAll('.divError')

    let gerant = {

        nom: nom.value,
        prenom: prenom.value,
        email: email.value,
        ville: ville.value,
        mdp: mdp.value,
        confPass: confPass.value,
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

    if(prenom.value.length == 0)
    {
        divError[1].style.visibility = "visible"
        prenom.style.borderColor = "red"
    }
    else
    {
        divError[1].style.visibility = "hidden"
        prenom.style.borderColor = "#bd9e56"
    }

    if(email.value.length == 0)
    {
        divError[2].style.visibility = "visible"
        email.style.borderColor = "red"
    }
    else
    {
        divError[2].style.visibility = "hidden"
        email.style.borderColor = "#bd9e56"
    }

    if(ville.value.length == 0)
    {
        divError[3].style.visibility = "visible"
        ville.style.borderColor = "red"
    }
    else
    {
        divError[3].style.visibility = "hidden"
        ville.style.borderColor = "#bd9e56"
    }

    if(mdp.value.length == 0)
    {
        divError[4].style.visibility = "visible"
        mdp.style.borderColor = "red"
    }
    else
    {
        divError[4].style.visibility = "hidden"
        mdp.style.borderColor = "#bd9e56"
    }

    if(confPass.value.length == 0)
    {
        divError[5].style.visibility = "visible"
        confPass.style.borderColor = "red"
    }
    else
    {
        divError[5].style.visibility = "hidden"
        confPass.style.borderColor = "#bd9e56"
    }
    

    if(nom.value.length !== 0 && prenom.value.length !== 0 && email.value.length !== 0 && ville.value.length !== 0 && mdp.value.length !== 0 && confPass.value.length !== 0)
    {
        $.ajax({
            url: "js/ajax/ajax_modif_gerant.php",
            method: "post",
            data: {donnees: JSON.stringify(gerant)},
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

                if(reponse.prenom == 1)
                {
                    divError[1].style.visibility = "visible"
                    prenom.style.borderColor = "red"
                }
                else
                {
                    divError[1].style.visibility = "hidden"
                    prenom.style.borderColor = "#bd9e56"
                }

                if(reponse.email == 1)
                {
                    divError[2].style.visibility = "visible"
                    email.style.borderColor = "red"
                }
                else
                {
                    divError[2].style.visibility = "hidden"
                    email.style.borderColor = "#bd9e56"
                }

                if(reponse.ville == 1)
                {
                    ville.style.borderColor = "red"
                    divError[3].style.visibility = "visible"
                }
                else
                {
                    ville.style.borderColor = "#bd9e56"
                    divError[3].style.visibility = "hidden"
                }

                if(reponse.mdp == 1)
                {
                    divError[4].style.visibility = "visible"
                    mdp.style.borderColor = "red"
                }
                else
                {
                    divError[4].style.visibility = "hidden"
                    mdp.style.borderColor = "#bd9e56"
                }

                if(reponse.confPass == 1)
                {
                    divError[5].style.visibility = "visible"
                    confPass.style.borderColor = "red"
                }
                else
                {
                    divError[5].style.visibility = "hidden"
                    confPass.style.borderColor = "#bd9e56"
                }
                if(reponse.id == 1)
                {
                    window.location.replace("administration.php");
                }



                if(reponse.nom == 0 && reponse.prenom == 0 && reponse.email == 0 && reponse.ville == 0 && reponse.mdp == 0 && reponse.confPass == 0 && reponse.id == 0)
                {
                    main.innerHTML = `<h1>Gerant modifié !</h1>`
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