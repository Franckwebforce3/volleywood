/**********************************************
 * DECLARATION DES VARIABLES : 
*/
// Page d'un produit :
var btnAddCart = document.querySelector(".addCart");
var imgPrincipale = document.querySelector(".imgPrincipale");
var imgSecondaire = document.querySelectorAll(".imgSecondaire");
// Page des produits :
var btnAddCartGlobal = document.querySelectorAll(".addCartAll");
/**********************************************/

/*
 * Click sur le bouton addCart :
 */
if (btnAddCart != null)
{
    btnAddCart.addEventListener("click", function(event) {
        console.log("click");
    });
}
/*
 * Click sur les liens addCart :
 */
if (btnAddCartGlobal.length != 0)
{
    btnAddCartGlobal.forEach(function(btnAddCartAll) {
        btnAddCartAll.addEventListener("click", function(event) {
            console.log("click: "+event.target);
        });
    });  
}

/*
 * Controler le nombre de quantité de produit :
 */
var quantiteSaisieProduit = document.getElementById("nbProduit");
if (quantiteSaisieProduit != null)
{
    quantiteSaisieProduit.addEventListener("change", function(event) {
        // console.log(event.target.value);

        if ((event.target.value == "") || (event.target.value < 1 || event.target.value > 5))
        {
            btnAddCart.disabled     = true;
            btnAddCart.innerHTML    = '<span class="psuedo-text">Panier bloqué</span>';
            btnAddCart.classList.add("interdit");
        }
        else {
            btnAddCart.disabled     = false;
            btnAddCart.innerHTML    = '<span class="psuedo-text">Ajouter au panier</span>';
            btnAddCart.classList.remove("interdit");
        }
    });
}


/*
 * Gestion du clic sur les images secondaires :
 */
if (imgSecondaire != null)
{
    imgSecondaire.forEach(function(imgSecondaireTemp) {
        imgSecondaireTemp.addEventListener("click", function(event) {
            console.log(event.target.src);
            imgPrincipale.src = event.target.src;
        });
    });    
}