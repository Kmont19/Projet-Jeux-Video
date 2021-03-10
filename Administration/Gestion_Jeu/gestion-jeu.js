$(document).ready(function (){
    $("#sidebar-wrapper").load('Menu-Administration.html');
    $("#menu").load('menu.html');
    getNbrJeux();
    loadJeux();

    /* Rechercher le nombre de jeux au total dans la BD */
    document.getElementById("nombreJeux").innerHTML = "5";

    $("#fichierModal").change(function() {
        montrerImage(this);
    })

    // Get modal
    var modal = document.getElementById("myModal");

    // Get x button to close modal
    var closeBtn = document.getElementById("closeModal");

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // When the user clicks on <span> (x), close the modal
    closeBtn.onclick = function() {
        modal.style.display = "none";
    }


    $('#boutonConfirmation').click(function (e) {
        e.preventDefault()
        var currentId = $("#idJeu").val();
        var bouton = $("#boutonConfirmation").val();
        var nom = $("#nomJeu").val();
        var categorie = $("#categorie").val();
        var studio = $("#nomStudio").val();
        var editeur = $("#nomEditeur").val();
        var prix = $("#prixJeu").val();
        var rabais = $("#rabaisJeu").val();
        var date = $("#dateSortie").val();
        var new_image = $("#fichierModal").prop('files')[0];

        if (nom == "" || categorie == "" || studio == "" || editeur == "" || prix == "" || rabais == "" || date == "" || new_image == ""){
            alert("Veuillez choisir et remplir tous les champs");
        } else {
            var prixConvert = Math.round(prix * 100) /100;

            if (bouton == "Ajouter") {
                /* Création de l'ID */
                var id = nom.substring(0,3) + studio.substring(0,3) + (Math.floor(Math.random() * (9999 - 1111 + 1)) + 1111);
                var addJeu = new FormData();
                addJeu.append('id_jeu', id);
                addJeu.append('nom', nom);
                addJeu.append('categorie', categorie);
                addJeu.append('developpeur', studio);
                addJeu.append('editeur', editeur);
                addJeu.append('rating', '0');
                addJeu.append('rabais', rabais);
                addJeu.append('prix', prixConvert);
                addJeu.append('date_de_sortie', date);
                addJeu.append('new_image', new_image);

                $("#idJeu").val(id); 
                ajouterJeu(addJeu);
            } else {               

                var old_image = localStorage.getItem("oldImage");
                console.log(new_image)
                var modifJeu = new FormData();
                modifJeu.append('id_jeu', currentId);
                modifJeu.append('nom', nom);
                modifJeu.append('categorie', categorie);
                modifJeu.append('developpeur', studio);
                modifJeu.append('editeur', editeur);
                modifJeu.append('prix', prixConvert);
                modifJeu.append('rabais', rabais);
                modifJeu.append('date_de_sortie', date);
                modifJeu.append('new_image', new_image);
                modifJeu.append('old_image', old_image);
                updateJeu(modifJeu);
                localStorage.clear();
            }
        }

    });
});

/*Get nombre de jeux dans la BD*/
function getNbrJeux() {
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: "getNbrJeux",
        success: function (reponse) {
            $("#nombreJeux").html(reponse);
        },
        error: function (message, e) {
            console.log(message);
        }
    });
}

function createCardJeu(id, nom, categorie, developpeur, editeur, prix, rabais, date_de_sortie, image_lien) {
    var jeuCard;

    jeuCard = `<tr>
                <th scope="row" width="1%;">${id}</th>
                <th width="5%">
                    <img src="ImagesJeux/${image_lien}" style="width: 60px; height: 80px;"/>
                </th>
                <th width="20%">${nom}</th>
                <th width="10%">${categorie}</th>
                <th width="10%">${developpeur}</th>
                <th width="10%">${editeur}</th>
                <th>$${prix}</th>
                <th>${rabais} %</th>
                <th>${date_de_sortie}</th>
                <th width="5%">
                    <img src="Images/Modif.jpg" class="animationsBoutonsListe" onclick="ouvrirModalModif('ImagesJeux/${image_lien}','${id}','${nom}', '${categorie}', '${developpeur}', '${editeur}',${prix}, '${rabais}', '${date_de_sortie}')">
                </th>
                <th width="5%">
                    <img src="Images/supprimer.png" class="animationsBoutonsListe" onclick="supprimerJeu('${id}', '${image_lien}')">
                </th>
            </tr>`
    return jeuCard;
}

function clearListe() {
    $("#cardDeck").empty();
}

/*Load jeux dans la liste*/
function loadJeux() {
    clearListe();
    $.ajax({
        url: "Base_de_donnees/getJeux.php",
        type: "GET",
        dataType: "json",
        data: "getJeux",
        success: function(reponse) {
            if(reponse.length > 0) {
                reponse.forEach(function(jeu) {
                    var cardJeu = createCardJeu(jeu.id_jeu, jeu.nom, jeu.categorie, jeu.developpeur, jeu.editeur, jeu.prix, jeu.rabais, jeu.date_de_sortie, jeu.image_lien);    
                    $('#cardDeck').prepend(cardJeu);
                })
            } else {
                $('#cardDeck').append(createCardVide())
            }          
        }
    });
}

/* Ajout jeu dans la BD */
function ajouterJeu(jeu) {
        $.ajax({
            url: "Base_de_donnees/ajoutJeu.php",
            type: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            data: jeu,
            success: function () {
                alert("Le jeu a bien été ajouté");
                location.reload();
            },
            error: function (message, e) {
                console.log(message);
            }
        });
}

function updateJeu(jeu) {
    $.ajax({
        url: "Base_de_donnees/updateJeu.php",
        type: "POST",
        dataType: "json",
        processData: false,
        contentType: false,
        data: jeu,
        success: function () {
            alert("Le jeu a bien été modifié");
            location.reload();
        },
        error: function (message, e) {
            console.log(message, e);
        }
    });
}

//Pour la supression d'objets
function supprimerJeu(id, img){
    if (confirm("Voulez-vous vraiment supprimer cet objet?")){
        $.ajax({
            url: "Base_de_donnees/supprimerJeu.php",
            type: "POST",
            dataType: "json",
            data: {
                "id": id,
                "img": img
            },
            success: function () {
                alert("Le jeu a bien été supprimé");
                location.reload();
            },
            error: function (message, e) {
                console.log(message, e);
            }
        });
    } else {
        alert("nope");
    }
}

 // Fonction pour montre l'image du input[file]
 function montrerImage(image) {
     if(image.files && image.files[0]) {
         var reader = new FileReader();

         reader.onload = function (e) {
             $('#imageModal').attr('src',e.target.result);
         }
         reader.readAsDataURL(image.files[0]);
     }
 }

 // Ouvre le modal de création de jeux
 function ouvrirModalAjout(){
    $("#myModal").css("display", "block");
    document.getElementById("titreModal").innerHTML = "Ajouter un jeu";
    document.getElementById("boutonConfirmation").value ="Ajouter";
    document.getElementById("imageModal").src ="Images/inconnu.jpg";
    $("#idTitre").hide()
    $("#idJeu").hide()
    document.getElementById("nomJeu").value ="";
    document.getElementById("categorie").selectedIndex = "-1";
    document.getElementById("nomStudio").value = "";
    document.getElementById('nomEditeur').value = "";
    document.getElementById('prixJeu').value = "";
    document.getElementById('rabaisJeu').value = "";
    document.getElementById('dateSortie').value = "";

        // When the user clicks on <span> (x), close the modal
        $("#closeModal").click = function() {
            $("#myModal").css("display", "none");
        }
}

 function ouvrirModalModif(image, id, nom, categorie, studio, editeur, prix, rabais, date){
    $("#myModal").css("display", "block");
    $("#idTitre").show()
    $("#idJeu").show()
    document.getElementById("titreModal").innerHTML = "Modification de jeu";
    document.getElementById("boutonConfirmation").value ="Enregistrer les modifications";
    document.getElementById("imageModal").src ="Images/inconnu.jpg";
    document.getElementById("idJeu").value = id;
    document.getElementById("nomJeu").value = nom;
    document.getElementById("categorie").value = categorie;
    document.getElementById("nomStudio").value = studio;
    document.getElementById('nomEditeur').value = editeur;
    document.getElementById('prixJeu').value = prix;
    document.getElementById('rabaisJeu').value = rabais;
    document.getElementById('dateSortie').value = date;

    var imageLien = image.replace("ImagesJeux/", "")

    localStorage.setItem("oldImage", imageLien)
 }

 