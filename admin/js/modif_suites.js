let btnSubmit = document.getElementById('btnSubmit')

let queryString = window.location.search;
let urlParams = new URLSearchParams (queryString);
let id = urlParams.get('id')

id = parseInt(id)

console.log(id)

btnSubmit.addEventListener('click', function(event)
{
    event.preventDefault()

    let titre = document.getElementById('titre')
    let prix = document.getElementById('prix')
    let lien = document.getElementById('lien')
    let couverture = document.getElementById('couverture')
    let gallerie = document.getElementById('gallerie')
    let description = document.getElementById('description')

    let main = document.querySelector('main')
    let divError = document.querySelectorAll('.divError')

    let suite = {

        titre: titre.value,
        prix: prix.value,
        lien: lien.value,
        description: description.value,
        id: id
    }

    if(titre.value.length == 0)
    {
        divError[0].style.visibility = "visible"
        titre.style.borderColor = "red"
    }
    else
    {
        divError[0].style.visibility = "hidden"
        titre.style.borderColor = "#bd9e56"
    }

    if(prix.value.length == 0)
    {
        divError[1].style.visibility = "visible"
        prix.style.borderColor = "red"
    }
    else
    {
        divError[1].style.visibility = "hidden"
        prix.style.borderColor = "#bd9e56"
    }

    if(lien.value.length == 0)
    {
        divError[2].style.visibility = "visible"
        lien.style.borderColor = "red"
    }
    else
    {
        divError[2].style.visibility = "hidden"
        lien.style.borderColor = "#bd9e56"
    }

    if(couverture.files.length == 0)
    {
        divError[3].style.visibility = "visible"
    }
    else
    {
        divError[3].style.visibility = "hidden"
    }

    if(gallerie.files.length == 0)
    {
        divError[4].style.visibility = "visible"
    }
    else
    {
        divError[4].style.visibility = "hidden"
    }

    if(description.value.length == 0)
    {
        divError[5].style.visibility = "visible"
        description.style.borderColor = "red"
    }
    else
    {
        divError[5].style.visibility = "hidden"
        description.style.borderColor = "#bd9e56"
    }

    console.log(couverture.files.length)
    console.log(gallerie.files.length)

    if(titre.value.length !== 0 && prix.value.length !== 0 && lien.value.length !== 0 && couverture.files.length !== 0 && gallerie.files.length !== 0 && description.value.length !== 0)
    {
        let data = new FormData()

        data.append("donnees", JSON.stringify(suite))
        data.append("couverture", couverture.files[0])

        for (const file of gallerie.files)
        {
            data.append("gallerie[]", file)
        }

        $.ajax({
            url: "js/ajax/ajax_suite.php",
            method: "post",
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            success: function(res) {

                let reponse = JSON.parse(res)

                console.log(reponse)

                if(reponse.titre == 1)
                {
                    divError[0].style.visibility = "visible"
                    titre.style.borderColor = "red"
                }
                else
                {
                    divError[0].style.visibility = "hidden"
                    titre.style.borderColor = "#bd9e56"
                }
            
                if(reponse.prix == 1)
                {
                    divError[1].style.visibility = "visible"
                    prix.style.borderColor = "red"
                }
                else
                {
                    divError[1].style.visibility = "hidden"
                    prix.style.borderColor = "#bd9e56"
                }
            
                if(reponse.lien == 1)
                {
                    divError[2].style.visibility = "visible"
                    lien.style.borderColor = "red"
                }
                else
                {
                    divError[2].style.visibility = "hidden"
                    lien.style.borderColor = "#bd9e56"
                }
            
                if(reponse.couverture == 1)
                {
                    divError[3].style.visibility = "visible"
                }
                else
                {
                    divError[3].style.visibility = "hidden"
                }
            
                if(reponse.gallerie == 1)
                {
                    divError[4].style.visibility = "visible"
                }
                else
                {
                    divError[4].style.visibility = "hidden"
                }
            
                if(reponse.description == 1)
                {
                    divError[5].style.visibility = "visible"
                    description.style.borderColor = "red"
                }
                else
                {
                    divError[5].style.visibility = "hidden"
                    description.style.borderColor = "#bd9e56"
                }
                if(reponse.id == 1)
                {
                    window.location.replace("gerant.php");
                }

                if(reponse.titre == 0 && reponse.prix == 0 && reponse.lien == 0 && reponse.couverture == 0 && reponse.gallerie == 0 && reponse.description == 0)
                {
                    main.innerHTML = `<h1>Suite ajouté !</h1>`
                    function redirection()
                    {
                        window.location.replace("gerant.php");
                    }
                    setTimeout(redirection, 3000)
                }
            }
        })
    }
})