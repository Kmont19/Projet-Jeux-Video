$(document).ready(function() {
    $("#menu").load("menu.html");
    $("#footer").load("footer.html");
    loadJeux();
})

//Charger jeux dans la liste
function loadJeux() {
    if(localStorage.getItem("categorie") !== null) {
        var categorie = localStorage.getItem("categorie");
        $("input[class='filtre-categorie']").each(function() {
            if($(this).val() == categorie) {
                $(this).prop("checked", true);
                getJeuxByCategorie(categorie);
            }
        })
        localStorage.clear();

    } else if(localStorage.getItem('nom')  !== null) {
        var nom = localStorage.getItem('nom');
        getJeuxByNom(nom)
        localStorage.clear('nom');

    } else {
        getJeux();
    }
}

function clearListe() {
    $("#cardDeck").empty()
}

function createCardJeu(imgLien, nom, prix, rabais) {
    var prixActuel;
    var prixPrecedent;  
    var jeuCard;

    if( rabais > 0) {
        prixActuel = (prix - (prix * (rabais) / 100)).toFixed(2);
        prixPrecedent = prix;

        jeuCard = `<div class="card-jeux" id="cardJeux">							
            <div class="card-jeux-img" id="imgContainer">
                <img src=${imgLien} class="img-responsive" alt="Image Jeux" id="imgJeux">
            </div>
            <h5 class="card-jeux-titre" id="nomJeux">${nom}</h5>
            <div class="card-jeux-prix" id="containerPrix">
                <span id="prix-actuel" class="current-price">${prixActuel}</span><span class="current-currency">CAD</span><br> 
                <span id="prix-precedent"class="previous-price">${prixPrecedent}</span><span class="previous-currency">CAD</span>                         
            </div>
        </div>`
    } else {
        prixActuel = prix;
        jeuCard =  `<div class="card-jeux" id="cardJeux">							
            <div class="card-jeux-img" id="imgContainer">
                <img src=${imgLien} class="img-responsive" alt="Image Jeux" id="imgJeux">
            </div>
            <h5 class="card-jeux-titre" id="nomJeux">${nom}</h5>
            <div class="card-jeux-prix mt-4" id="containerPrix">
                <span id="prix-actuel" class="current-price">${prixActuel}</span><span class="current-currency">CAD</span>
                </div>
        </div>`
    }
    return jeuCard;
}

function getJeux() { 
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: "getJeux",
        success: function(reponse) {
            reponse.forEach(function(jeu) {
                var imgLien = jeu.image_lien.replace("../", "");   
                var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                $('#cardDeck').prepend(cardJeu);
            })
        }
    });
}

function getJeuxByNom(nom) {
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: {nom: nom},
        success: function(reponse) {
            reponse.forEach(function(jeu) {
                var imgLien = jeu.image_lien.replace("../", "");
                var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                $('#cardDeck').prepend(cardJeu);
            })
        }
    });
}


function getJeuxByCategorie(categorie) {
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: {
            categorie: categorie
        },
        success: function(reponse) {
            if(reponse.length > 0) {
                reponse.forEach(function(jeu) {
                    var imgLien = jeu.image_lien.replace('../', '');
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);                   
                })
            }
        }
    });
}

function getJeuxByPrix(prixMin, prixMax) {
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: {
            recherchePrix: "getJeuxByPrix",
            prixMin: prixMin,
            prixMax: prixMax
        },
        success: function(reponse) {
            if(reponse.length > 0) {
                reponse.forEach(function(jeu) {
                    var imgLien = jeu.image_lien.replace('../', '');
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);                   
                })
            }
        }
    });
}

