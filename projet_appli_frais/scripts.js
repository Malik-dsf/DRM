function openModal() {
    document.getElementById('myModal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('myModal').style.display = 'none';
  }

  // Fermer la fenêtre modale si l'utilisateur clique en dehors du contenu
  window.onclick = function(event) {
    var modal = document.getElementById('myModal');
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  }