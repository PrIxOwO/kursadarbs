document.addEventListener("DOMContentLoaded", function() {
    $ = function(id) {
        return document.getElementById(id);
    }

    window.show = function(id) {
        $(id).style.display = 'block';
    }

    window.hide = function(id) {
        $(id).style.display = 'none';
    }

    // Add event listener to close the popup when the document is clicked
    document.addEventListener('click', function(event) {
        if (event.target.id !== 'popup1' && event.target.id !== 'kontakti-link') {
            hide('popup1');
        }
    });

    // Add event listener to the "KONTAKTI" link to show the popup
    document.getElementById('kontakti-link').addEventListener('click', function(event) {
        event.preventDefault();
        show('popup1');
    });

    console.log('popup.js loaded');
});