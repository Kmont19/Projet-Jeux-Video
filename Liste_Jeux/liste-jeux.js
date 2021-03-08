$(document).ready(function() {
    $("#menu").load("menu.html");
    $("#footer").load("footer.html");
    getJeux();
    checkCategorie();
})

//Check categorie si le menu a été clické
function checkCategorie() {
    if(localStorage.getItem("categorie") !== null) {
        var categorie = localStorage.getItem("categorie");
        $("input[class='filtre-categorie']").each(function() {
            if($(this).val() == categorie) {
                $(this).prop("checked", true);
                getJeuxByCategorie(categorie);
            }
        })
        localStorage.clear();
    }
}

function getJeux() { 
    var prixActuel;
    var prixPrecedent;   
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: "getJeux",
        success: function(reponse) {
            reponse.forEach(function(jeu) {
                if( jeu.rabais > 0) {
                    prixActuel = jeu.prix - (jeu.prix * (jeu.rabais) / 100);
                    prixPrecedent = jeu.prix;
                    var jeuCard = `<div class="card-jeux" id="cardJeux">							
                        <div class="card-jeux-img" id="imgContainer">
                            <img src=Images/"${jeu.image_lien}" class="img-responsive" alt="Image Jeux" id="imgJeux">
                        </div>
                        <h5 class="card-jeux-titre" id="nomJeux">${jeu.nom}</h5>
                        <div class="card-jeux-prix" id="containerPrix">
                            <span id="prix-actuel" class="current-price">${prixActuel}</span><span class="current-currency">CAD</span><br> 
                            <span id="prix-precedent"class="previous-price">${prixPrecedent}</span><span class="previous-currency">CAD</span>                         
                        </div>
                    </div>`
                } else {
                    prixActuel = jeu.prix;
                    `<div class="card-jeux" id="cardJeux">							
                        <div class="card-jeux-img" id="imgContainer">
                            <img src=Images/"${jeu.image_lien}" class="img-responsive" alt="Image Jeux" id="imgJeux">
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

function getJeuxByCategorie(categorie) {
    var prixActuel;
    var prixPrecedent;
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: categorie,
        success: function(reponse) {
            if(reponse.length > 0) {
                reponse.forEach(function(jeu) {
                    if( jeu.rabais > 0) {
                        prixActuel = jeu.prix - (jeu.prix * (jeu.rabais) / 100);
                        prixPrecedent = jeu.prix;
                        `<div class="card-jeux" id="cardJeux">							
                        <div class="card-jeux-img" id="imgContainer">
                            <img src=Images/"${jeu.image_lien}" class="img-responsive" alt="Image Jeux" id="imgJeux">
                        </div>
                        <h5 class="card-jeux-titre" id="nomJeux">${jeu.nom}</h5>
                        <div class="card-jeux-prix" id="containerPrix">
                            <span id="prix-actuel" class="current-price">${prixActuel}</span><span class="current-currency">CAD</span><br> 
                            <span id="prix-precedent"class="previous-price">${prixPrecedent}</span><span class="previous-currency">CAD</span>                         
                        </div>
                    </div>`
                    } else {
                        prixActuel = jeu.prix;
                        `<div class="card-jeux" id="cardJeux">							
                            <div class="card-jeux-img" id="imgContainer">
                                <img src=Images/"${jeu.image_lien}" class="img-responsive" alt="Image Jeux" id="imgJeux">
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
        }
    });
}