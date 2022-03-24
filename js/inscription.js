let btnSubmit = document.getElementById('btnSubmit')
console.log('ah')

btnSubmit.addEventListener('click', function(event)
{
    event.preventDefault()

    let nom = document.getElementById('nom').value
    let prenom = document.getElementById('prenom').value
    let email = document.getElementById('email').value
    let password = document.getElementById('mdp').value
    let confPass = document.getElementById('confmdp').value

    let inscription = {

        nom: nom,
        prenom: prenom,
        email: email,
        password: password,
        confPass: confPass
    }

    
    console.log(inscription)

    console.log(nom.length)
    
    if(nom.length == 0 || prenom.length == 0 || email.length == 0 || password.length == 0 || confPass.length == 0)
    {

    }else
    {
        $.ajax({
            url: "js/ajax/ajax_inscription.php",
            method: "post",
            data: {donnees: JSON.stringify(inscription)},
            success: function(res) {

                let reponse = JSON.parse(res)
                console.log(reponse)
                
            }
        })
    }

})