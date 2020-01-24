/**********************************************
 * DECLARATION DES VARIABLES : 
*/
// Page d'un produit :
var btnAddCart              = document.querySelector(".addCart");
var selectTaille            = document.getElementById("taille-select");
var imgPrincipale           = document.querySelector(".imgPrincipale");
// var imgSecondaireGlobal     = document.querySelectorAll(".imgSecondaire");
// Page des produits :
var btnAddCartGlobal        = document.querySelectorAll(".addCartAll");
var quantiteSaisieProduit   = document.getElementById("nbProduit");


var btnchargerProduit       = document.querySelectorAll(".chargerProduit");
/**********************************************/

/*
 * Click sur les liens addCart :
 */
if (btnAddCartGlobal.length != 0)
{
    btnAddCartGlobal.forEach(function(btnAddCartAll) {
        btnAddCartAll.addEventListener("click", function(event) {
            //console.log("click: "+event.target);
        });
    });  
}

if (selectTaille != null)
{
    selectTaille.addEventListener("change", function(event) {
        if (event.target.value == "")
        {
            btnAddCart.disabled     = true;
            btnAddCart.innerHTML    = '<span class="psuedo-text">Panier bloqué</span>';
            btnAddCart.classList.add("interdit");
        } else {
            btnAddCart.disabled     = false;
            btnAddCart.innerHTML    = '<span class="psuedo-text">Ajouter au panier</span>';
            btnAddCart.classList.remove("interdit");
        }
    });
}

/*
 * Controler le nombre de quantité de produit :
 */

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
 * Click sur le bouton addCart :
 */
if (btnAddCart != null)
{
    //console.log("ok");
    // btnAddCart.onclick = function() { 
    //     // alert('hello'); 
    //     // btnAddCart.setAttribute("onclick", "window.location.href = '{{ path('cart_add', {'id': produit.id}) }}';");
    // };


    // btnAddCart.addEventListener("click", function(event) {
        // var id = event.target.dataset.id;
        // var url = event.target.dataset.url;

        // console.log(url);

        // if (selectTaille == null)
        // {
        //     if ( (quantiteSaisieProduit.value == "") || (quantiteSaisieProduit.value < 1 || quantiteSaisieProduit.value > 5) )
        //     {
        //         console.log("1");
        //         event.preventDefault();
        //         btnAddCart.disabled     = true;
        //         btnAddCart.innerHTML    = '<span class="psuedo-text">Panier bloqué</span>';
        //         btnAddCart.classList.add("interdit");
        //     }
        //     else {
        //         console.log("2");
        //         btnAddCart.disabled     = false;
        //         btnAddCart.innerHTML    = '<span class="psuedo-text">Ajouter au panier</span>';
        //         btnAddCart.classList.remove("interdit");

        //         window.location.href = url;
        //         console.log(url);
        //     }
        // }
        // else if ( (selectTaille.value == "choix") || ((quantiteSaisieProduit.value == "") || (quantiteSaisieProduit.value < 1 || quantiteSaisieProduit.value > 5)) )
        // {
        //     console.log("3");
            
        //     btnAddCart.disabled     = true;
        //     btnAddCart.innerHTML    = '<span class="psuedo-text">Panier bloqué</span>';
        //     btnAddCart.classList.add("interdit");
        // }
        // else {
        //     console.log("4");
        //     btnAddCart.disabled     = false;
        //     btnAddCart.innerHTML    = '<span class="psuedo-text">Ajouter au panier</span>';
        //     btnAddCart.classList.remove("interdit");

        //     location.href = "{{ path('cart_add', {'id': 8})|escape('js') }}";

        //     // var route = "{{ path('blog_show', {'slug': 'my-blog-post'})|escape('js') }}";
        //     console.log(url);
        // }
    // });
}

/*
 * Gestion du clic sur les images secondaires :
 */
// if (imgSecondaireGlobal.length != 0)
// {
//     console.log("click");
//     imgSecondaireGlobal.forEach(function(imgSecondaireTemp) {
//         imgSecondaireTemp.addEventListener("click", function(event) {
//             console.log(event.target.src);
//             imgPrincipale.src = event.target.src;
//         });
//     });    
// }

/*
 * Gestion des boutons AddCart de la modal :
 */
if (btnchargerProduit.length != 0)
{
    btnchargerProduit.forEach(function(btnchargerProduitAll) {
        btnchargerProduitAll.addEventListener("click", function(event) {

            /* Rendre les boutons visibles invisibles */
            var nbElement = document.querySelectorAll(".buttonAffic");
            // console.log(nbElement);
            nbElement.forEach(function(nbElementAll) {
                //console.log(nbElementAll);
                nbElementAll.classList.remove("buttonAffic");
                nbElementAll.classList.add("buttonCachee");
            });

            var id          = btnchargerProduitAll.getAttribute("data-id");
            var btnProduit  = document.getElementById("boutonCart"+id);

            btnProduit.classList.remove("buttonCachee");
            btnProduit.classList.add("buttonAffic");
        });
    });  
}