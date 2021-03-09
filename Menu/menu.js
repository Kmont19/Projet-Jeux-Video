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