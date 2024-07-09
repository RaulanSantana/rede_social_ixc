
function showModal(message, redirect) {
    var modalMessage = document.getElementById("modalMessage");

    modalMessage.innerText = message;
    $('#myModal').modal('show');

   
    setTimeout(function() {
        $('#myModal').modal('hide');
        if (redirect) {
            window.location.href = redirect;
        }
    }, 3000);
}


$(document).ready(function() {
    $('#myModal').on('hidden.bs.modal', function () {
        var redirect = new URLSearchParams(window.location.search).get('redirect');
        if (redirect) {
            window.location.href = redirect;
        }
    });
});
