require('./bootstrap');
$(document).ready(function(e) {
    $('#video').change(function() {

        let reader = new FileReader();

        reader.onload = (e) => {

            $('#preview-video').attr('src', e.target.result);
            $('#preview-video').removeClass( "d-none" );
        }

        reader.readAsDataURL(this.files[0]);

    });

    $('#image').change(function() {

        let reader = new FileReader();

        reader.onload = (e) => {

            $('#preview-image').attr('src', e.target.result);
            $('#preview-image').removeClass( "d-none" );
        }

        reader.readAsDataURL(this.files[0]);

    });
    //se verifica la ruta para saber que estamos en la pag de ver video, 
    // optiene el elemento video-show y le quita le muted y lo reproduce
    if (window.location.pathname.substring(0,8) == '/videos/') {
        var video= document.getElementById('video-show');
        video.muted = false;
        video.play()
    }
});
