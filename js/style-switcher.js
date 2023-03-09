
// Red Style
if('styles-red.css' == getUrlParam('style') ) {
    $('link[href="css/styles.css"]').attr('href','css/styles-red.css');
    $('.brand h1 a img').attr('src', 'img/logo-red.gif');
    $('.navbar-brand img').attr('src', 'img/logo-red.gif');
}

// Green Style
if('styles-green.css' == getUrlParam('style') ) {
    $('link[href="css/styles.css"]').attr('href','css/styles-green.css');
    $('.brand h1 a img').attr('src', 'img/logo-green.gif');
    $('.navbar-brand img').attr('src', 'img/logo-green.gif');
}



function getUrlParam(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
        return null;
    }
    else{
        return results[1] || 0;
    }
}