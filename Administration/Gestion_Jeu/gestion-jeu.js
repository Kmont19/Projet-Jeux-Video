$(document).ready(function (){
    $("#sidebar-wrapper").load('Menu-Administration.html')
    $("#menu").load('menu.html')

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
        var bouton = $("#boutonConfirmation").val();
        var nom = $("#nomJeu").val();
        var categorie = $("#categorie").val();
        var studio = $("#nomStudio").val();
        var editeur = $("#nomEditeur").val();
        var prix = $("#prixJeu").val();
        var rabais = $("#rabaisJeu").val();
        var date = $("#dateSortie").val();
        var image_lien = $("#fichierModal").prop('files')[0];

        if (nom == "" || categorie == "" || studio == "" || editeur == "" || prix == "" || rabais == "" || date == "" || image_lien == ""){
            alert("Veuillez choisir et remplir tous les champs");
        } else {
            if (bouton == "Ajouter") {
                /* Création de l'ID */
                var id = nom.substring(0,3) + studio.substring(0,3) + (Math.floor(Math.random() * (9999 - 1111 + 1)) + 1111);
                $("#idJeu").val(id);

                var jeu = new FormData();
                jeu.append('id_jeu', id);
                jeu.append('nom', nom);
                jeu.append('categorie', categorie);
                jeu.append('developpeur', studio);
                jeu.append('editeur', editeur);
                jeu.append('rating', '0');
                jeu.append('rabais', rabais);
                jeu.append('prix', prix);
                jeu.append('date_de_sortie', date);
                jeu.append('image_lien', image_lien);
                
                ajouterJeu(jeu);
            } else {
                alert("Le jeu a bien été modifié");
                location.reload();
            }
        }

    });
});


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
                window.reload();
            },
            error: function (message, e) {
                console.log(message);
            }
        });
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
    document.getElementById("imageModal").src ="Images/" + image;
    document.getElementById("idJeu").value = id;
    document.getElementById("nomJeu").value = nom;
    document.getElementById("categorie").value = categorie;
    document.getElementById("nomStudio").value = studio;
    document.getElementById('nomEditeur').value = editeur;
    document.getElementById('prixJeu').value = prix;
    document.getElementById('rabaisJeu').value = rabais;
    document.getElementById('dateSortie').value = date;
 }

 //Pour la supression d'objets
 function supprimerObjetListe(id){
     if (confirm("Voulez-vous vraiment supprimer cet objet?")){
         alert("Oui");
         alert(id);
         location.reload();
     } else {
         alert("nope");
     }
 }