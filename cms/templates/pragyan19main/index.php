<?php
if(!defined('__PRAGYAN_CMS'))
{
	header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
	echo "<h1>403 Forbidden<h1><h4>You are not authorized to access the page.</h4>";
	echo '<hr/>'.$_SERVER['SERVER_SIGNATURE'];
	exit(1);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
    <head>  
        <title><?php $cmstitle=$TITLE;echo $cmstitle; ?></title>
        <link rel="icon" href="<?php echo $TEMPLATEBROWSERPATH; ?>/../common/site/images/favicon.ico" >
		<meta name="description" content="<?php echo $SITEDESCRIPTION ?>" />
		<meta name="keywords" content="<?php echo $SITEKEYWORDS.', '.$PAGEKEYWORDS ?>" />
        <meta name="google" content="notranslate">
        <?php global $urlRequestRoot;	global $PAGELASTUPDATED;
		if($PAGELASTUPDATED!="")
		echo '<meta http-equiv="Last-Update" content="'.substr($PAGELASTUPDATED,0,10).'" />'."\n";
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="<?php echo $TEMPLATEBROWSERPATH; ?>/js/three.js"></script>
        <script src="<?php echo $TEMPLATEBROWSERPATH; ?>/js/Aquarelle.js"></script>
        <script src="<?php echo $TEMPLATEBROWSERPATH; ?>/js/EffectComposer.js"></script>
        <script src="<?php echo $TEMPLATEBROWSERPATH; ?>/js/ClearPass.js"></script>
        <script src="<?php echo $TEMPLATEBROWSERPATH; ?>/js/AquarellePass.js"></script>
        <script src="<?php echo $TEMPLATEBROWSERPATH; ?>/js/ShaderPass.js"></script>
        <script src="<?php echo $TEMPLATEBROWSERPATH; ?>/js/CopyShader.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:500,600" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.9"></script>
        <script
        src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
        crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <body onload="<?php echo $STARTSCRIPTS; ?>">

        <style>
            html {
                display: -webkit-flex;
                display: hidden;
                height: 100%;
                overflow-x: hidden;
            }

            body {
                font-family: 'Montserrat', sans-serif;
                background-color: #fff;
                margin: 0;
                position: relative;
                width: 100%;
                height: 100%;
                overflow-x: hidden;
                overflow-y:hidden;
            }

            .fade {
                opacity: 0;
            }

            canvas {
                background-color:transparent;
                left: 50%;
                max-height: 100%;
                max-width: 100%;
                position: absolute;
                top: 50%;
            }

            .logo {
                background-image: url(<?php echo $TEMPLATEBROWSERPATH; ?>/../common/images/logo.png);
                background-position: center;
                background-repeat: no-repeat;
                background-size: contain;
                height: 5vw;
                left: 10px;
                position: absolute;
                top: 0;
                width: 10vw;
            }

            .menu {
                position: absolute;
                right: 36px;
                top: 34px;
            }

            .footer {
                position: absolute;
                bottom: 2vh;
                text-align: center;
                left: 0;
                right: 0;
            }

            .title {
                position: absolute;
                color: white;
            }

            #titletext{
                font-weight: bolder;
                font-size: 5em;
            }

            .desc {
                position: absolute;
                font-weight: bolder;
                color: white;
            }

            #container{
                height: 100vh; 
                display: flex; 
                align-items: center; 
                justify-content: center;
            }

            .buttons {
                display: -webkit-flex;
                display: flex;
                justify-content: center;
                margin: 10px;
            }

            .icon {
            
            }

            .icon>img:hover{
                transform: scale(1.3);
            }

            .icon>img{
                display: block;
                height: 50px;
                width: 50px;
                border-radius: 38px;
                background-color: rgba(0,0,0,0.5);
                padding: 10px;
                margin: 10px;
            }

            a{
                color: black !important;
            }

            #navlogo{
                width: 100px;
            }

            .nav-link{
                text-align: right;
            }

            a{
            outline:none;
            }

            @media screen and (min-width: 768px) {

                #social{
                    font-size: 25px;
                    position: absolute;
                    right: 30px;
                    bottom: 10px;
                }
            }

            @media screen and (max-width: 767px) {
                ul#iconlist li {
                    display:inline;
                    margin: 5px;
                    font-size: 15px;
                }

                ul#iconlist {
                    margin-block-start: 0;
                    margin-block-end: 0;
                    padding-inline-start: 0;
                }
            }



            @media screen and (max-width: 768px) {
            
                .icon>img{
                    display: block;
                    height: 35px;
                    width: 35px;
                    border-radius: 38px;
                    background-color: rgba(0,0,0,0.5);
                    padding: 5px;
                    margin: 5px;
                }
            
                canvas {
                    background-color:transparent;
                    left: 50%;
                    max-height: 250%;
                    max-width: 250%;
                    position: absolute;
                    top: 50%;
                }
            
                .footer{
                    font-size: 12px;
                }
            
            
                #datetext{
                    text-align: center !important;
                }
            
                #titlelogo{
                    width:40vw; 
                    margin-left: calc(50% - 20vw);
                }

            }

            @media screen and (min-width: 601px) {
            
                #datetext{
                    text-align:right;
                }
            
                #titlelogo{
                    width:30vw; 
                    margin-left: calc(50% - 15vw);
                }
            
                #navlogo{
                    width: 150px;
                }
            
                .nav-item{
                    margin: 20px;
                }
            
            }

            @media screen and (min-width: 767px) and (max-width: 1365px) {
            
                .icon>img{
                    display: block;
                    height: 50px;
                    width: 50px;
                    border-radius: 38px;
                    background-color: rgba(0,0,0,0.5);
                    padding: 10px;
                    margin: 10px;
                }
            
            
            
                canvas {
                    background-color: transparent;
                    left: 50%;
                    max-height: 150%;
                    max-width: 150%;
                    position: absolute;
                    top: 50%;
                }
            
            }

            #bgimg{
                left: 50%;
                max-height: 275%;
                max-width: 275%;
                position: absolute;
                top: 50%;
            }

        </style>

    </head>

    <body>
        <div class="fade">
            <img id="bgimg" style="display: none;" src="<?php echo $TEMPLATEBROWSERPATH; ?>/images/paint4.png">
                <div class="top">
        <nav style="background-color: transparent !important; position: absolute; width: 100vw;" class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo $urlRequestRoot?>/home"><img id="navlogo" src="<?php echo $TEMPLATEBROWSERPATH; ?>/../common/images/logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-right">
                <li class="nav-item">
                <a class="nav-link" href="<?php echo $urlRequestRoot?>/sponsors">Sponsors</a>
                </li>

                <li class="nav-item">
                <a class="nav-link" href="<?php echo $urlRequestRoot?>/contacts">Contacts</a>
                </li>
            <li style="z-index:1000;" class="nav-item dropdown">
                <?php
                    if(isset($_SESSION['userId'])){
                        $logout =  <<<LOGIN
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                My Account
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="./+profile">Profile</a> 
                                <a class="dropdown-item" href="./+logout">Logout</a>
                            </div>              
LOGIN;
                        echo $logout;            
                        echo '<div style="display:none" id="hidden_actionbar">'.$ACTIONBARPAGE."</div>";
                    } else {
                        $login_str =  <<<LOGIN
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sign up / Log in
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="./+login">Log in</a>
                                <a class="dropdown-item" href="./+login&subaction=register">Sign up</a>
                            </div>
LOGIN;
                    echo $login_str;
                    }
                ?>
            </li>
            </ul>
        </div>
    </nav>
</div>

<div id="container">
    <div class="title">
        <!-- <div id="titletext" style="text-align:center;">
            PRAGYAN
        </div> -->
        <img id="titlelogo" style="display: block !important;" src="<?php echo $TEMPLATEBROWSERPATH; ?>/images/rsz_title.png"/>
        
        <div id="datetext"  style="font-weight: bold;">14<sup>TH</sup> - 17<sup>TH</sup> MARCH 2019</div>
        
        <div class="buttons row">
            <a href="<?php echo $urlRequestRoot?>/events"><div onmouseover="change_desc('EVENTS')" onmouseout="clear_text()" class="icon" ><img src="<?php echo $TEMPLATEBROWSERPATH; ?>/images/Events.svg"></div></a>
            <a href="<?php echo $urlRequestRoot?>/workshops"><div onmouseover="change_desc('WORKSHOPS')" onmouseout="clear_text()" class="icon" ><img src="<?php echo $TEMPLATEBROWSERPATH; ?>/images/Workshops.svg"></div></a>
            <a href="<?php echo $urlRequestRoot?>/guest_lectures"><div onmouseover="change_desc('GUEST LECTURES')" onmouseout="clear_text()" class="icon" ><img src="<?php echo $TEMPLATEBROWSERPATH; ?>/images/GL.svg"></div></a>
            <a href="<?php echo $urlRequestRoot?>/infotainment"><div onmouseover="change_desc('INFOTAINMENT')" onmouseout="clear_text()" class="icon" ><img src="<?php echo $TEMPLATEBROWSERPATH; ?>/images/Info.svg"></div></a>
            <a href="<?php echo $urlRequestRoot?>/exhibitions"><div onmouseover="change_desc('EXHIBITIONS')" onmouseout="clear_text()" class="icon" ><img src="<?php echo $TEMPLATEBROWSERPATH; ?>/images/Exhibitions.svg"></div></a>
            <a href="<?php echo $urlRequestRoot?>/about"><div onmouseover="change_desc('MORE')" onmouseout="clear_text()" class="icon" ><img src="<?php echo $TEMPLATEBROWSERPATH; ?>/images/Plus.svg"></div></a>
        </div>
        <div id="icondesc" style="text-align: center; font-weight: bold"></div>
    </div>   
</div>

<div class="footer" style="color: black;">
    <div id="social">
        <ul id="iconlist" style="list-style-type:none;">
            <li><a href="https://www.facebook.com/pragyan.nitt/" target="_blank"><i class="fab fa-facebook"></i></a></li>
            <li><a href="https://twitter.com/nitt_pragyan" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/pragyan_nitt/" target="_blank"><i class="fab fa-instagram"></i></a></li>
            <li><a href="https://www.youtube.com/c/pragyannittrichy" target="_blank"><i class="fab fa-youtube"></i></a></li>
            <li><a href="https://medium.com/pragyan-blog" target="_blank"><i class="fab fa-medium"></i></a></li>
            <li><a href="https://in.linkedin.com/company/pragyan.nitt" target="_blank"><i class="fab fa-linkedin"></i></a></li>
        </ul>
    </div>
    <div id="typed-strings">
        <p>Made with ♥ by <a href="https://delta.nitt.edu" target="_blank">DeltaForce</a> and <a href="https://behance.net/pragyan_nitt" target="_blank">Design team</a> </p>
        <p>Let's Celebrate Technology</p>
    </div>
    <span id="typed"></span>
</div>

</div>

<script>

var fade = document.querySelector('.fade');
var topNav = document.querySelector('.top');
var title = document.querySelector('.title');
var logo = document.querySelector('#titlelogo');
var desc = document.querySelector('#icondesc');
var datetext = document.querySelector('#datetext');
var icons = Array.prototype.slice.call(document.querySelectorAll('.icon'));

var image = document.getElementsByTagName('img')[0];

$("#icondesc").html("&nbsp;");

console.log($( window ).width());

if($( window ).width() > 767){

    var aquarelle = new Aquarelle(image, '<?php echo $TEMPLATEBROWSERPATH; ?>/images/mask3.png', {
        autoplay: true,
        loop: false,
        duration: 6000,
        
    });

    aquarelle.addEventListener('created', function() {
        var canvas = this.getCanvas();
        canvas.removeAttribute('style');
        image.parentNode.insertBefore(canvas, image.nextSibling);
        image.parentNode.removeChild(image);
    });

    aquarelle.addEventListener('changed', function(event) {

        var canvas = this.getCanvas();

        fade.style.opacity = this.transitionInRange(1, 1, 2500, 4000);

        // topNav.style.opacity = this.transitionInRange(0, 1, 4330, 5660);

        // canvas.style.webkitFilter = 'blur(' + this.transitionInRange(0, 3, 3000) + 'px)';
        canvas.style.webkitTransform = canvas.style.transform = 'translate(-50%, -50%) scale(' + this.transitionInRange(0.5, 1) + ')';

        title.style.opacity = this.transitionInRange(0, 1, 0, 1008);
        // title.style.webkitTransform = title.style.transform = 'scale(' + this.transitionInRange(.8, 1, 0, 5883) + ')';

        icons.forEach(function(icon) {
            icon.style.webkitFilter = 'blur(' + event.target.transitionInRange(4, 0, 3433, 4149) + 'px)';
            icon.style.opacity = event.target.transitionInRange(0, 1, 3433, 4266);
            icon.style.webkitTransform = icon.style.transform = 'scale(' + event.target.transitionInRange(1.3, 1, 1716, 2200) + ')';
        });

        // logo.style.webkitTransform = logo.style.transform = 'scale(' + event.target.transitionInRange(1.3, 1, 3433, 4400) + ')';
        desc.style.webkitFilter = 'blur(' + event.target.transitionInRange(4, 0, 3433, 4149) + 'px)';
        desc.style.opacity = event.target.transitionInRange(0, 1, 1716, 2133);
        desc.style.webkitTransform = desc.style.transform = 'scale(' + event.target.transitionInRange(1.3, 1, 3433, 4400) + ')';
        datetext.style.opacity = event.target.transitionInRange(0, 1, 1716, 2133);
    });

}
else{
    fade.style.opacity = 1;

    title.style.opacity = 1;

    icons.forEach(function(icon) {
        icon.style.opacity = 1;
    });

    desc.style.opacity = 1; 

    datetext.style.opacity = 1;

    $("#bgimg").show();

    $('#bgimg').css({"transform":"translate(-50%,-50%)"});

}

var typed = new Typed('#typed', {
    stringsElement: '#typed-strings',
    showCursor: false,
    loop: true,
    backDelay: 4000,
});


function change_desc(desc){
    $("#icondesc").text(desc);
}

function clear_text(){
    $("#icondesc").html("&nbsp;");
}

</script>

</body>
</html>
