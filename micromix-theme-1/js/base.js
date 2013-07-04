/* highlight plugin */
$.fn.extend({
    highlight: function(search, insensitive, hls_class){
        var regex = new RegExp("(<[^>]*>)|(\\b"+ search.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1") +")", insensitive ? "ig" : "g");
        return this.html(this.html().replace(regex, function(a, b, c){
            return (a.charAt(0) == "<") ? a : "<span class=\""+ hls_class +"\">" + c + "</span>";
        }));
    }
});


var $ = jQuery;
var $window = $(window);
var $body = $('body');
var micromix = {};
$(document).ready(function() {
    /* If search, call highlight */
    if(typeof(hls_query) != 'undefined'){
        $(".result").highlight(hls_query, 1, "hilite");
    }

    micromix.managethisawesomemicromixsound = new Managethesound();
    micromix.managethisawesomemicromixsound.initsound();

    var Inactivity = function(options){
        var debug = true;
        var events = options.events;

        var isactiv = false;
        var TIMEOUTactivity = 0;

        var getstatus = function () {
            if (debug)console.info('getstatus');

            return isactiv;

        };

        var _setinactiv = function () {
            if (debug)console.info('_setinactiv');
            isactiv = false;
        };
        var _bindevents = function () {
//            if (debug)console.info('_bindevents');

            clearTimeout(TIMEOUTactivity);
            isactiv = true;
            TIMEOUTactivity = setTimeout(_setinactiv, 10*1000*60); // 10 minutes

        };
        $window.on(events, _bindevents);

        this.isactiv = getstatus;

    };

    var activity = new Inactivity({events:'mousemove keydown click touchend'});

	var stachts = {}; // object
    jQuery('.bt-player a').bind('mousedown',function(){
        var postId = jQuery(this).parents('.bt-player')[0].id;

        if (typeof stachts[postId] == 'undefined') {
           
            stachts[postId] = true;
            
            jQuery.ajax({
                type:'POST',
                data: 'postId='+postId,
                url: '/wp-content/themes/micromix-theme-1/ajax.php',
                success : function(obj) {
                    //console.info('success');
                    //console.info(obj);
                },
                error : function(obj) {
                    //console.error('faiiiiil');
                    //console.error(obj);
                }
            });
        }
    });

    /* -- INIT TAG WALL --  */
    var initTagWall = function(){

        var sketcher = null;
        var $canvas = $("#tagwall");
        var context = $canvas[0].getContext('2d');
        var brush = new Image();

        // fix cursor on canvas
        $canvas.on('hover mousedown onselectstart', function(e){
            e.preventDefault();
            e.stopPropagation();
            e.target.style.cursor = 'url("'+theme_path+'/img/spraycan.png"), auto';
        });

        //init sketcher
        var initSketcker = function(){
            brush.src = theme_path+'/img/spray-red.png';
            brush.onload = function(){
                sketcher = new Sketcher("tagwall", brush );
            };
        };

        // clear Canvas
        var clearCanvas = function(){
            sketcher.clear();
            localStorage.removeItem('savedcanvas');
        };

        // save Canvas
        var saveCanvas = function(){
            var imgBase64 = sketcher.toDataURL();
            localStorage.setItem("savedcanvas",imgBase64);
        };

        // load Saved Canvas
        var loadSavedCanvas = function(){
            var imgBase64 = localStorage.getItem("savedcanvas");
            if (imgBase64){
                var imageObj = new Image();
                imageObj.src = imgBase64;
                imageObj.onload = function() {
                    context.drawImage(this, 0, 0);
                };
            }
        };

        // spray sound
        var spraySound = function(){
            var $tagwall = $('#tagwall');
            var spraysound = document.getElementById('spraysound');

            // looping
            spraysound.addEventListener('ended', function(){
                this.currentTime = 0;
                this.play();
            });

            $tagwall.on('mousedown',function(){
                spraysound.play();
            });

            $tagwall.on('mouseup',function(){
                spraysound.currentTime = 0;
                spraysound.pause();
            });
        };

        // change Brush Color
        var changeBrushColor = function(){
            $('.spray-colors li').each(function(i,o){
                $(o).on('click',function(){
                    var id = $(o).attr('id');
                    brush.src = theme_path+'/img/'+id+'.png';

                    if (id === 'spray-erase'){
                        // erase mode
                        context.globalCompositeOperation = 'destination-out';
                    }else{
                        context.globalCompositeOperation = 'source-over';
                    }
                })
            });
        };

        loadSavedCanvas();
        initSketcker();
        spraySound();
        changeBrushColor();

        $('#save-canvas').on('click',saveCanvas);
        $('#clear-canvas').on('click',clearCanvas);

    };
    initTagWall();
});

/* STICK GHETTOBLASTER TO BOTTOM */
var $ghetto = $();
var fixed = true;
var stickGhettoToBottom = function(){
    if($ghetto.length < 1){
        $ghetto = $('.ghettoblaster');
    }

    var windowheight = $window.height();
    var scrollTop = $window.scrollTop();
    var bottomLimit = $body.height() - 214;
    var isLimitReached = windowheight + scrollTop >= bottomLimit;

    if (isLimitReached && fixed){
        $ghetto.addClass('positionabsolute');
        fixed = false;
    }
    else if(!isLimitReached && !fixed) {
        $ghetto.removeClass('positionabsolute');
        fixed = true;
    }
};