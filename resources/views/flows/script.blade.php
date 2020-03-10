<script>
    function displayNewCategory() {
        var isSelected = document.getElementById("mySelect").selectedIndex;
        var valueOption = document.getElementsByTagName("option")[isSelected].value;
        // console.log(document.getElementsByTagName("option")[isSelected].value);
        if (valueOption == "-1") {// si "Nouvelle catégorie" est sélectionné dans la liste déroulante
            document.getElementById("newCategory").style.display = "block"; //on affiche une zone de texte pour saisir cette nouvelle catégorie
            document.getElementById("newCategoryLabel").style.display = "block"; //label pour accessibilité
        } else {
            document.getElementById("newCategory").style.display = "none"; // et si on clique finalement sur le nom d'une catégorie, la zone de texte est masquée
            document.getElementById("newCategoryLabel").style.display = "none"; //label pour accessibilité
        }
    }
</script>
