$(document).ready(function() {
    var end = 0;
    var x = document.title;
    var array = ['фильмы', 'Фильмы', 'Кино', 'кино', 'фильм', 'Фильм', 'просмотр', 'смотреть', 'онлайн'];
    if (array.some(v => x.includes(v))) {
        $("iframe").each(function(i, el) {
            if (el.allowFullscreen === true && end === 0) {
                var src = $(this).attr('src');
                $(this).parent().prepend('<div id="jivo_element" style="position: absolute;width: 100%;height: 100vh;z-index: 999;">' +
                    // ' <video id="jivo_video" style="width:100%" src="https://html5book.ru/examples/media/martynko.webm"></video>'+
                    '<iframe src="https://jivoplayer.ru//public/"  frameborder="0" allow="autoplay; encrypted-media" style="border:0px #ffffff none;" name="myiFrame" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="400px" width="600px" allowfullscreen></iframe>'
                    +'<span style="font-size: 24px;position: absolute;right: 25px;">JIVO</span></div>'
                    +'<div style="width: 180px;z-index: 99999;position: absolute;background: black;color: white;padding: 10px 10px;" id="countdown"></div>');
                end++;
            }
        });
        //chrome://settings/content/sound
        var timeleft = 15;
        var downloadTimer = setInterval(function(){
            if(timeleft <= 0){
                clearInterval(downloadTimer);
                document.getElementById("countdown").innerHTML = "";
                $('#countdown').append('Press to skip');
            } else {
                document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
            }
            timeleft -= 1;
        }, 1000);
        $('#countdown').click(function() {
            if ($(this).text() === 'Press to skip') {
                $('#jivo_element').remove();
                $(this).remove();
            }
        });
    }
});