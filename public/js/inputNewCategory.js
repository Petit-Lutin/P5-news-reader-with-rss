// mesNouvellesCategories[i].addEventListener("click", (e) => {
//     let message = e.currentTarget.getAttribute("data-message"); //affiche le message contenu dans l'attribut message du lien
//     if (!confirm(message)) {
//         e.preventDefault();
//         e.stopPropagation();
//     }

const mesNouvellesCategories = document.querySelectorAll(".newCategory");
const maSelection = document.querySelectorAll(".mySelect");


for (i = 0; i < mesNouvellesCategories.length; i++) {
    maSelection[i].addEventListener("click", (e) => {
            var isSelected = maSelection[i].selectedIndex;
            var valueOption = document.getElementsByTagName("option")[isSelected].value;
            // console.log(document.getElementsByTagName("option")[isSelected].value);
            if (valueOption == "-1") {// si "Nouvelle catégorie" est sélectionné dans la liste déroulante
                mesNouvellesCategories[i].style.display = "block"; //on affiche une zone de texte pour saisir cette nouvelle catégorie
                // document.getElementById("newCategoryLabel").style.display = "block"; //on affiche une zone de texte pour saisir cette nouvelle catégorie
            } else {
                mesNouvellesCategories[i].style.display = "none"; // et si on clique finalement sur le nom d'une catégorie, la zone de texte est masquée
                // document.getElementById("newCategoryLabel").style.display = "none"; // et si on clique finalement sur le nom d'une catégorie, la zone de texte est masquée
            }

        }
    )
}
}



