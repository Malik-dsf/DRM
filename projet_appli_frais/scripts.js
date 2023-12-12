var divContent = {};

function loadContent(divId, filePath) {
    return fetch(filePath)
        .then(response => response.text())
        .then(data => {
            divContent[divId] = { content: data, loaded: true };
        })
        .catch(error => {
            console.error('Erreur lors du chargement du contenu :', error);
            divContent[divId] = { content: '', loaded: false };
        });
}

function showContent(divId) {
    var targetDiv = document.getElementById('AccRapNav');

    // Vérifier si le contenu du div est déjà chargé
    if (!divContent[divId] || !divContent[divId].loaded) {
        // Charger le contenu et attendre que le chargement soit terminé
        loadContent(divId, 'Backend_AppliFrais/rapid-nav/' + divId + '.html')
            .then(() => displayContent(divId, targetDiv));
    } else {
        displayContent(divId, targetDiv);
    }
}

function displayContent(divId, targetDiv) {
    // Masquer tous les divs
    var animatedDivs = targetDiv.getElementsByClassName('animated-content');
    Array.from(animatedDivs).forEach(div => {
        div.classList.remove('animate__backInLeft'); // Remove the previous animation class
        div.style.display = 'none';
    });

    // Afficher le contenu du div survolé s'il est défini
    if (divContent[divId] && divContent[divId].content !== undefined) {
        targetDiv.innerHTML = divContent[divId].content;
        var currentDiv = document.getElementById(divId);
        currentDiv.style.display = 'block';

        // Ajouter la classe pour déclencher l'animation uniquement si le contenu est chargé et l'animation n'a pas été appliquée
        if (divContent[divId].loaded && !currentDiv.classList.contains('animate__backInLeft')) {
            // Use 'animate__backInLeft' as the animation class
            currentDiv.classList.add('animate__backInLeft');
        }
    }

    // Masquer l'élément avec l'id "img_main"
    var imgMain = document.getElementById('img_main');
    if (imgMain) {
        imgMain.style.display = 'none';
    }
}