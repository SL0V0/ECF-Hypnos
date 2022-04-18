let etablissement = document.getElementById('etablissement')
let suite = document.getElementById('suite')

console.log(suite)
console.log(etablissement)

function choixEtablissement()
{
    $.ajax({
        url: "js/ajax/ajax_reservation.php",
        method: "post",
        data: {donnees: JSON.stringify(reservation)},
        success: function(res) {

            let reponse = JSON.parse(res)
        }
    })
}