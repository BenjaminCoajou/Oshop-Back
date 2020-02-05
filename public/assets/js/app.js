
var app = {
    // initialisation du module
    init: function(){

        // cibler le formulaire
        var formElement = document.querySelector('#home-categories-form');
        // écouter la soumission => déclencher un handler
        formElement.addEventListener('submit', app.submitHandler);
    },

    submitHandler: function(event){
        

        // parcourir tous les select du form
        var selectFieldList = document.querySelectorAll('#home-categories-form select');
        
        // on stocke les valeurs déjà parcourues
        var previousValues = [];

        // on stocke les erreurs rencontrées
        var errors = [];
       
        // la fonction anonyme passée à forEach récupère l'élement courant dans un paramètre
        selectFieldList.forEach(function(selectElement){
            // récupérer la valeur contenue dans ce select
            var currentValue = selectElement.value;

            
            // si pas de valeur (ou vide)
            if (currentValue === ""){
                // déclencher une erreur
                console.error('Saisie obligatoire');
                errors.push('Saisie obligatoire');
            } else {
                console.log('saisie ok');
            }

            // vérifier qu'aucune autre catégories n'est sais plus d'une fois
            if (previousValues.indexOf(currentValue) !== -1) {
                // la valeur est déjà présente
                console.error('!!! Doublon');
                errors.push('!!! Doublon');
            } else {
                // la valeur n' jamais étét ajoutée à previousValues
                
                // ajouter cette valeur aux valeurs précédentes
                previousValues.push(currentValue);
                console.log('valeur ok');
            }         
        });

        if (errors > 0) {
            // on empeche la soumission du formulaire
            event.preventDefault();
        }


    }
}

document.addEventListener('DOMcontentLoaded', app.init);
