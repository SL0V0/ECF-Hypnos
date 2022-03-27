let btnSubmit = document.getElementById('btnSubmit')

btnSubmit.addEventListener('click', function(event)
{
    event.preventDefault()

    let main = document.querySelector('main')

    let nom = document.getElementById("nom")
    let prenom = document.getElementById('prenom')
    let email = document.getElementById('email')
    let sujet = document.getElementById('sujet')
    let message = document.getElementById('message')

    let divError = document.querySelectorAll('.divError')

    console.log(sujet.value)

    let contact = {

        nom: nom.value,
        prenom: prenom.value,
        email: email.value,
        sujet: sujet.value,
        message: message.value
    }

    console.log(contact)

    if(nom.value.length == 0)
    {
        nom.style.borderColor = "red"
    }
    else
    {
        nom.style.borderColor = "#bd9e56"
    }

    if(prenom.value.length == 0)
    {
        prenom.style.borderColor = "red"
    }
    else
    {
        prenom.style.borderColor = "#bd9e56"
    }

    if(email.value.length == 0)
    {
        email.style.borderColor = "red"
    }
    else
    {
        email.style.borderColor = "#bd9e56"
    }

    if(sujet.value.length == 0)
    {
        sujet.style.borderColor = "red"
    }
    else
    {
        sujet.style.borderColor = "#bd9e56"
    }

    if(message.value.length == 0)
    {
        message.style.borderColor = "red"
    }
    else
    {
        message.style.borderColor = "#bd9e56"
    }

    if(nom.value.length !== 0 && prenom.value.length !== 0 && email.value.length !== 0 && sujet.value.length !== 0 && message.value.length !== 0)
    {
        $.ajax({
            url: "js/ajax/ajax_contact.php",
            method: "post",
            data: {donnees: JSON.stringify(contact)},
            success: function(res) {

                let reponse = JSON.parse(res)
                console.log(reponse)
                console.log("--------------------------")
                console.log(reponse.nom)

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

                if(reponse.sujet == 1)
                {
                    sujet.style.borderColor = "red"
                }
                else
                {
                    sujet.style.borderColor = "#bd9e56"
                }

                if(reponse.message == 1)
                {
                    divError[3].style.visibility = "visible"
                    message.style.borderColor = "red"
                }
                else
                {
                    divError[3].style.visibility = "hidden"
                    message.style.borderColor = "#bd9e56"
                }
                if(reponse.nom == 0 && reponse.prenom == 0 && reponse.email == 0 && reponse.sujet == 0 && reponse.message == 0)
                {
                    main.innerHTML = `<h1>Demande envoyé !</h1>`
                    function redirection()
                    {
                        window.location.replace("index.php");
                    }
                    setTimeout(redirection, 3000)
                }
                
            }
        })
    }
})