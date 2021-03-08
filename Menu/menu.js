
function getCategorie (cat) {
    categorie = cat.innerHTML;
    localStorage.setItem("categorie", categorie);
}



function rechercheJeu(nom) {
    var prixActuel;
    var prixPrecedent;  
    var jeuCard; 
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: nom,
        success: function(reponse) {
            reponse.forEach(function(jeu) {
                console.log(jQuery.type(jeu.image_lien))
                var imgLien = jeu.image_lien.replace("../", "");
                if( jeu.rabais > 0) {
                    prixActuel = jeu.prix - (jeu.prix * (jeu.rabais) / 100);
                    prixPrecedent = jeu.prix;
                    jeuCard = `<div class="card-jeux" id="cardJeux">							
                        <div class="card-jeux-img" id="imgContainer">
                            <img src=${imgLien} class="img-responsive" alt="Image Jeux" id="imgJeux">
                        </div>
                        <h5 class="card-jeux-titre" id="nomJeux">${jeu.nom}</h5>
                        <div class="card-jeux-prix" id="containerPrix">
                            <span id="prix-actuel" class="current-price">${prixActuel}</span><span class="current-currency">CAD</span><br> 
                            <span id="prix-precedent"class="previous-price">${prixPrecedent}</span><span class="previous-currency">CAD</span>                         
                        </div>
                    </div>`
                } else {
                    prixActuel = jeu.prix;
                    jeuCard =  `<div class="card-jeux" id="cardJeux">							
                        <div class="card-jeux-img" id="imgContainer">
                            <img src=${imgLien} class="img-responsive" alt="Image Jeux" id="imgJeux">
                        </div>
                        <h5 class="card-jeux-titre" id="nomJeux">${jeu.nom}</h5>
                        <div class="card-jeux-prix" id="containerPrix">
                            <span id="prix-actuel" class="current-price">${prixActuel}</span><span class="current-currency">CAD</span>
                            </div>
                    </div>`
                }
                $('#cardDeck').append(jeuCard);
            })
        }
    });
}