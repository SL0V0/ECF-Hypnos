let galerie = document.getElementById('galerie')
let croix = document.getElementById('close')
let background = document.getElementById('background')
let couverture = document.getElementById('couverture')
let divCarousel = document.getElementById('divCarousel')
let imgCarousel = document.querySelectorAll('.imgCarousel')
let imgGalerie = document.querySelectorAll('.imgGalerie')
let r = document.querySelector(':root')
let btnDroit = document.getElementById('arrowDroite')
let btnGauche = document.getElementById('arrowGauche')
let pg = document.getElementById('pg')


let varheight =  `${divCarousel.offsetHeight}px`

pg.style.display = ""
divCarousel.style.display = "none"

r.style.setProperty('--height', varheight);

let numero = 0

for(let i = 0; i < imgGalerie.length; i++)
{
    imgGalerie[i].addEventListener('click', function(event)
    {
        event.preventDefault()

        pg.style.display = "none"
        divCarousel.style.display = ""
        imgCarousel[i].style.display = ""

        console.log(imgGalerie[i])
    })
}

console.log(imgCarousel[numero])

btnDroit.addEventListener('click', function(event)
{
    event.preventDefault()

    imgCarousel[numero].style.display = "none"

    numero++

    if(numero == imgCarousel.length)
    {
        numero = 0
    }

    imgCarousel[numero].style.display = ""

    console.log(imgCarousel[numero])

})

btnGauche.addEventListener('click', function(event)
{
    event.preventDefault()

    imgCarousel[numero].style.display = "none"

    if(numero == 0)
    {
        numero = imgCarousel.length - 1
    }else
    {
        numero--
    }

    imgCarousel[numero].style.display = ""

    console.log(imgCarousel[numero])
    
})

couverture.addEventListener('click', function(event)
{
    event.preventDefault()

    background.style.visibility = "visible"
    galerie.style.visibility = "visible"

})

croix.addEventListener('click', function(event)
{
    event.preventDefault()

    background.style.visibility = "hidden"
    galerie.style.visibility = "hidden"

})