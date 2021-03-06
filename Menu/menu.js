function getCategorie (cat) {
    categorie = cat.innerHTML;
    localStorage.setItem("categorie", categorie);
}
function getPromotions() {
    localStorage.setItem("promotions", true)
}
function getBestSellers() {
    localStorage.setItem("bestSellers", true)
}
function getPrecommandes() {
    localStorage.setItem("precommandes", true)
}
function checkPage() {
    if(window.location.href.indexOf("index.html") > -1) {
        $("#menuAccueil").addClass('active');
    } else if(window.location.href.indexOf("panier.html") > -1) {
        $("#menuAccueil").removeClass('active');
        $("#menuPanier").addClass('active');
    } else {
        $("#menuAccueil").removeClass('active');
    }
}
function addActive(id) {
    id.addClass('active')
}
function removeActive(id) {
    id.removeClass('active')
}

function verifRedirection(){

    if (sessionStorage.getItem("email") == null){
        document.getElementById('connexionModal').style.display='block'
    }
    else{
        if (sessionStorage.getItem("email") == "admin"){
            if (confirm("Voulez-vous entrer dans la gestion de jeu?")){
                window.location.href = "Gestion-Jeu.html";
            }
            else if (confirm("Voulez-vous vous déconnecter?")){
                sessionStorage.removeItem("email");
                window.location.replace("index.html");
            }
        }
        else{
            if (confirm("Voulez-vous entrer voir votre liste de jeux à vous?")){
                openNav();
            }
            else if (confirm("Voulez-vous vous déconnecter?")){
                sessionStorage.removeItem("email");
                window.location.href="index.html"
            }
        }
    }
}

function redirectionFicheJeu(id, nom, developpeur, editeur, rating, nbrPersonnes, prix, rabais, date_de_sortie, image_lien, categorie){
    sessionStorage.setItem('id', id);
    sessionStorage.setItem('nom',nom);
    sessionStorage.setItem('nom_image', image_lien);
    sessionStorage.setItem('categorie',categorie);
    sessionStorage.setItem('date',date_de_sortie);
    sessionStorage.setItem('prix',prix);
    sessionStorage.setItem('studio',developpeur);
    sessionStorage.setItem('editeur',editeur);
    sessionStorage.setItem('rating', rating);
    sessionStorage.setItem('nombrePersonne', nbrPersonnes);
    window.location.href = "Fiche-Jeu.html";
}