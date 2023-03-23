$(document).ready(function () {
   
    // Modify URL
    var newUrl = window.location.pathname.replace(/\/{2,}/g, '/').replace(/\/+$/, '');
    if(newUrl != window.location.pathname){
        window.history.replaceState({}, '', newUrl);
        location.reload();
    }

});