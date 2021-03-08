var tableJeux = [];

$(document).ready(function() {
    $("#menu").load("menu.html");
    $("#footer").load("footer.html");
    loadJeux();
})

//Charger jeux dans la liste
function loadJeux() {
    tableJeux = [];
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
        clearListe();
        getJeuxByNom(nom)
        localStorage.clear();

    } else if(localStorage.getItem('promotions')  !== null) {
        clearListe();
        getJeuxByPromotions();
        localStorage.clear();
    } else if (localStorage.getItem('bestSellers')  !== null) {
        clearListe();
        getBestSellers();
        localStorage.clear();
    } else if(localStorage.getItem('precommandes')  !== null) {
        clearListe();
        getJeuxByPrecommandes();
        localStorage.clear();
    }else {
        getJeux();
        console.log(tableJeux)
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
    clearListe();
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: "getJeux",
        success: function(reponse) {
            reponse.forEach(function(jeu) {
                tableJeux.push(jeu);
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
                tableJeux.push(jeu);
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
                    tableJeux.push(jeu);
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
                    tableJeux.push(jeu);
                    var imgLien = jeu.image_lien.replace('../', '');
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);                   
                })
            }
        }
    });
}

function getJeuxByRating(rating) {
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: {
            rating: rating
        },
        success: function(reponse) {
            if(reponse.length > 0) {
                reponse.forEach(function(jeu) {
                    tableJeux.push(jeu);
                    var imgLien = jeu.image_lien.replace('../', '');
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);                   
                })
            }
        }
    });
}

function getJeuxByPromotions() {
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: "promotions",
        success: function(reponse) {
            if(reponse.length > 0) {
                reponse.forEach(function(jeu) {
                    tableJeux.push(jeu);
                    var imgLien = jeu.image_lien.replace('../', '');
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);                   
                })
            }
        }
    });
}

function getBestSellers() {
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: "bestSellers",
        success: function(reponse) {
            if(reponse.length > 0) {
                reponse.forEach(function(jeu) {
                    tableJeux.push(jeu);
                    var imgLien = jeu.image_lien.replace('../', '');
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);                   
                })
            }
        }
    });
}

function getJeuxByPrecommandes() {
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: "precommandes",
        success: function(reponse) {
            if(reponse.length > 0) {
                reponse.forEach(function(jeu) {
                    tableJeux.push(jeu);
                    var imgLien = jeu.image_lien.replace('../', '');
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);                   
                })
            }
        }
    });
}

function sortByDate(a, b) {
    return a.date_de_sortie.localeCompare(b.date_de_sortie)
}

function sortByPrix(a, b) {
    return a.prix.localeCompare(b.prix)
}

function getJeuxRecents() {
    clearListe()
    addActive($("#jeuxRecents"));
    removeActive($("#jeuxAnciens"));
    removeActive($("#prixCroissant"));
    removeActive($("#prixDecroissant"));
    tableJeux.sort(sortByDate)
    tableJeux.reverse();
    tableJeux.forEach(getItems)
}

function getJeuxAnciens() {
    clearListe()
    removeActive($("#jeuxRecents"));
    addActive($("#jeuxAnciens"));
    removeActive($("#prixCroissant"));
    removeActive($("#prixDecroissant"));
    tableJeux.sort(sortByDate)
    tableJeux.forEach(getItems)
}

function getJeuxPrixCroissant() {
    clearListe()
    removeActive($("#jeuxRecents"));
    removeActive($("#jeuxAnciens"));
    addActive($("#prixCroissant"));
    removeActive($("#prixDecroissant"));
    tableJeux.sort(sortByPrix)
    tableJeux.forEach(getItems)
}

function getJeuxPrixDecroissant() {
    clearListe()
    removeActive($("#jeuxRecents"));
    removeActive($("#jeuxAnciens"));
    removeActive($("#prixCroissant"));
    addActive($("#prixDecroissant"));
    tableJeux.sort(sortByPrix)
    tableJeux.reverse();
    tableJeux.forEach(getItems)
}

function getItems(value) {
    var imgLien = value.image_lien.replace('../', '');
    var cardJeux = createCardJeu(imgLien, value.nom, value.prix, value.rabais);
    $("#cardDeck").append(cardJeux);
}