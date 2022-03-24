let btnSubmit = document.getElementById('btnSubmit')

btnSubmit.addEventListener('click', function(event)
{
    event.preventDefault()

    let main = document.querySelector("main")
    let divError = document.querySelectorAll('.divError')

    let nom = document.getElementById('nom')
    let prenom = document.getElementById('prenom')
    let email = document.getElementById('email')
    let password = document.getElementById('mdp')
    let confPass = document.getElementById('confmdp')

    let inscription = {

        nom: nom.value,
        prenom: prenom.value,
        email: email.value,
        password: password.value,
        confPass: confPass.value
    }

    
    console.log(inscription)
    
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

    if(password.value.length == 0)
    {
        password.style.borderColor = "red"
    }
    else
    {
        password.style.borderColor = "#bd9e56"
    }

    if(confPass.value.length == 0)
    {
        confPass.style.borderColor = "red"
    }
    else
    {
        confPass.style.borderColor = "#bd9e56"
    }

    if(nom.value.length !== 0 && prenom.value.length !== 0 && email.value.length !== 0 && password.value.length !== 0 && confPass.value.length !== 0)
    {
        $.ajax({
            url: "js/ajax/ajax_inscription.php",
            method: "post",
            data: {donnees: JSON.stringify(inscription)},
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

                if(reponse.mdp == 1)
                {
                    divError[3].style.visibility = "visible"
                    password.style.borderColor = "red"
                }
                else
                {
                    divError[3].style.visibility = "hidden"
                    password.style.borderColor = "#bd9e56"
                }

                if(reponse.confMdp == 1)
                {
                    divError[4].style.visibility = "visible"
                    confPass.style.borderColor = "red"
                }
                else
                {
                    divError[4].style.visibility = "hidden"
                    confPass.style.borderColor = "#bd9e56"
                }
                if(reponse.nom == 0 && reponse.prenom == 0 && reponse.email == 0 && reponse.mdp == 0 && reponse.confMdp == 0)
                {
                    main.innerHTML = `<h1>Incription validé</h1>`
                    function redirection()
                    {
                        window.location.replace("connexion.php");
                    }
                    setTimeout(redirection, 3000)
                }
                
            }
        })
    }

})