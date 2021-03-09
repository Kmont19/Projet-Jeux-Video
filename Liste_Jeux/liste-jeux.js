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

function createCardVide() {
    tableJeux = [];
    var cardVide = `<h2 style="text-align: center;">Aucun jeu trouvé<br>Veuillez préciser votre recherche!</h2>`;
    return cardVide;
}

function getJeux() { 
    tableJeux = [];
    clearListe();
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: "getJeux",
        success: function(reponse) {
            if(reponse.length > 0) {
                reponse.forEach(function(jeu) {
                    tableJeux.push(jeu);
                    var imgLien = "http://cours.cegep3r.info/H2021/420617RI/Equipe_1/ImagesJeux/" + jeu.image_lien;   
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);
                })
            } else {
                $('#cardDeck').append(createCardVide())
            }          
        }
    });
}

function getJeuxByNom(nom) {
    tableJeux = [];
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: {nom: nom},
        success: function(reponse) {
            if(reponse.length > 0) {
                reponse.forEach(function(jeu) {
                    tableJeux.push(jeu);
                    var imgLien = "http://cours.cegep3r.info/H2021/420617RI/Equipe_1/ImagesJeux/" + jeu.image_lien; 
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);
                })
            } else {
                $('#cardDeck').append(createCardVide())
            }  
        }
    });
}


function getJeuxByCategorie(categorie) {
    tableJeux = [];
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
                    var imgLien = "http://cours.cegep3r.info/H2021/420617RI/Equipe_1/ImagesJeux/" + jeu.image_lien; 
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);
                })
            } else {
                $('#cardDeck').append(createCardVide())
            }  
        }
    });
}

function getJeuxByPrix(prixMin, prixMax) {
    tableJeux = [];
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
                    var imgLien = "http://cours.cegep3r.info/H2021/420617RI/Equipe_1/ImagesJeux/" + jeu.image_lien;
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);
                })
            } else {
                console.log("hello")
                $('#cardDeck').append(createCardVide())
            }  
        }
    });
}

function getJeuxByRating(rating) {
    tableJeux = [];
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
                    var imgLien = "http://cours.cegep3r.info/H2021/420617RI/Equipe_1/ImagesJeux/" + jeu.image_lien;   
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);
                })
            } else {
                $('#cardDeck').append(createCardVide())
            }  
        }
    });
}

function getJeuxByPromotions() {
    tableJeux = [];
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: "promotions",
        success: function(reponse) {
            if(reponse.length > 0) {
                reponse.forEach(function(jeu) {
                    tableJeux.push(jeu);
                    var imgLien = "http://cours.cegep3r.info/H2021/420617RI/Equipe_1/ImagesJeux/" + jeu.image_lien; 
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);
                })
            } else {
                $('#cardDeck').append(createCardVide())
            }  
        }
    });
}

function getBestSellers() {
    tableJeux = [];
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: "bestSellers",
        success: function(reponse) {
            if(reponse.length > 0) {
                reponse.forEach(function(jeu) {
                    tableJeux.push(jeu);
                    var imgLien = "http://cours.cegep3r.info/H2021/420617RI/Equipe_1/ImagesJeux/" + jeu.image_lien;
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);
                })
            } else {
                $('#cardDeck').append(createCardVide())
            }  
        }
    });
}

function getJeuxByPrecommandes() {
    tableJeux = [];
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: "precommandes",
        success: function(reponse) {
            if(reponse.length > 0) {
                reponse.forEach(function(jeu) {
                    tableJeux.push(jeu);
                    var imgLien = "http://cours.cegep3r.info/H2021/420617RI/Equipe_1/ImagesJeux/" + jeu.image_lien;  
                    var cardJeu = createCardJeu(imgLien, jeu.nom, jeu.prix, jeu.rabais);    
                    $('#cardDeck').prepend(cardJeu);
                })
            } else {
                $('#cardDeck').append(createCardVide())
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
    if(tableJeux.length > 0) {
        clearListe()
        addActive($("#jeuxRecents"));
        removeActive($("#jeuxAnciens"));
        removeActive($("#prixCroissant"));
        removeActive($("#prixDecroissant"));
        tableJeux.sort(sortByDate)
        tableJeux.reverse();
        tableJeux.forEach(getJeuxTable)
    } else {
        createCardVide();
    }
    
}

function getJeuxAnciens() {
    if(tableJeux.length > 0) {
        clearListe()
        removeActive($("#jeuxRecents"));
        addActive($("#jeuxAnciens"));
        removeActive($("#prixCroissant"));
        removeActive($("#prixDecroissant"));
        tableJeux.sort(sortByDate)
        tableJeux.forEach(getJeuxTable)
    } else {
        createCardVide();
    }
}

function getJeuxPrixCroissant() {
    if(tableJeux.length > 0) {
        clearListe()
        removeActive($("#jeuxRecents"));
        removeActive($("#jeuxAnciens"));
        addActive($("#prixCroissant"));
        removeActive($("#prixDecroissant"));
        tableJeux.sort(sortByPrix)
        tableJeux.forEach(getJeuxTable)
    } else {
        createCardVide();
    }
}

function getJeuxPrixDecroissant() {
    if(tableJeux.length > 0) {
        clearListe()
        removeActive($("#jeuxRecents"));
        removeActive($("#jeuxAnciens"));
        removeActive($("#prixCroissant"));
        addActive($("#prixDecroissant"));
        tableJeux.sort(sortByPrix)
        tableJeux.reverse();
        tableJeux.forEach(getJeuxTable)
    } else {
        createCardVide();
    }
}

function getJeuxTable(value) {
    var imgLien = "http://cours.cegep3r.info/H2021/420617RI/Equipe_1/ImagesJeux/" + value.image_lien;
    var cardJeux = createCardJeu(imgLien, value.nom, value.prix, value.rabais);
    $("#cardDeck").append(cardJeux);
}