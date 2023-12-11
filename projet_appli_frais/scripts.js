function openModal() {
    var modal = document.getElementById('myModal');
    var modalContent = modal.querySelector('.modal-content');
    modal.style.display = 'flex';
    setTimeout(function () {
      modalContent.classList.add('show');
    }, 50); // Attendez un court instant pour permettre à la transition de s'appliquer correctement
  }
  
  function closeModal() {
    var modal = document.getElementById('myModal');
    var modalContent = modal.querySelector('.modal-content');
    modalContent.classList.remove('show');
    // Attendez la fin de l'animation avant de masquer la fenêtre modale
    modalContent.addEventListener('transitionend', function () {
      modal.style.display = 'none';
    }, { once: true });
  }
  