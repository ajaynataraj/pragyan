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
    <link rel="stylesheet" type="text/css" href="<?php echo $TEMPLATEBROWSERPATH; ?>/css/clusters.css">
    <style>

        html {
            display: -webkit-flex;
            display: flex;
            height: 100%;
            font-family: 'Montserrat', sans-serif !important;
            overflow: hidden !important;
        }

        body {
            font-family: 'Montserrat', sans-serif !important;
            background-color: #fff;
            margin: 0;
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden !important;
        }

        .fade {
            opacity: 1;
        }

        .logo {
            background-image: url(img/logo.png);
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            height: 5vw;
            left: 10px;
            position: absolute;
            top: 0px;
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
            -webkit-animation: flip-horizontal-bottom 0.4s cubic-bezier(0.455, 0.030, 0.515, 0.955) both;
            animation: flip-horizontal-bottom 0.4s cubic-bezier(0.455, 0.030, 0.515, 0.955) both;
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
            -webkit-justify-content: space-between;
            justify-content: center;
        }

        .icon {
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
        }

        .icon>img:hover{
            transform: scale(1.3);
        }

        .icon>img{
            display: block;
            height: 56px;
            width: 56px;
        }

        a{
            color: black !important;
        }

        td{
            width: 18vw;
            height: 40px;
        }

        td a:hover{
            font-weight: bold;
        }

        nav a:hover, a:active {
            transform: none;
        }
        
    </style>

</head>

<body>
    <div class="fade">
        
        <div class="top">
        <nav  style="background-color: transparent !important; position: absolute; width: 100vw; z-index: 1000;" class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo $urlRequestRoot?>/home"><img id="navlogo" src="<?php echo $TEMPLATEBROWSERPATH; ?>/../common/images/logo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $urlRequestRoot?>/home">Home</a>
                        </li>

                        <li class="nav-item" style="cursor:pointer">
                                <a class="nav-link" onclick="window.history.back()">Back</a>
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
            <img id="bgimg" src="<?php echo $TEMPLATEBROWSERPATH; ?>/images/rsz_paint3.png">
            <div style="width:100%" class="row">
                <div class="col-md-12">
                    <div class="vertical-tab" role="tabpanel">
                        <!-- Nav tabs -->
                        <ul id="widetab" style="display:none" class="nav nav-tabs" role="tablist">
                            <li id="byte_hoc" class="cluster" role="presentation"><a href="#section_byte_hoc" aria-controls="home" role="tab" data-toggle="tab">Bytehoc</a></li>
                            <li id="trivia" class="cluster" role="presentation"><a href="#section_trivia" aria-controls="profile" role="tab" data-toggle="tab">Trivia</a></li>
                            <li id="phronesis" class="cluster" role="presentation"><a href="#section_phronesis" aria-controls="messages" role="tab" data-toggle="tab">Phronesis</a></li>
                            <li id="concreate" class="cluster" role="presentation"><a href="#section_concreate" aria-controls="profile" role="tab" data-toggle="tab">Concreate</a></li>
                            <li id="robo_rex" class="cluster" role="presentation"><a href="#section_robo_rex" aria-controls="messages" role="tab" data-toggle="tab">Roborex</a></li>
                            <li id="conception" class="cluster" role="presentation"><a href="#section_conception" aria-controls="messages" role="tab" data-toggle="tab">Conception</a></li>
                            <li id="manigma" class="cluster" role="presentation"><a href="#section_manigma" aria-controls="profile" role="tab" data-toggle="tab">Manigma</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabs">
                            <div role="tabpanel" class="tab-pane fade" id="section_byte_hoc">
                                <p class="clustertitle">BYTEHOC</p>
                                <table style="margin:auto;">
                                <tr style="text-align: center;" id="events">
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/byte_hoc/capture_the_flag">Capture The Flag</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/byte_hoc/code_character">Code Character</a></td>
                                </tr>
                                <tr style="text-align: center;" id="events">
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/byte_hoc/pragyan_ml_challenge">Pragyan ML Challenge</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/byte_hoc/code_venati">Code Venatic</a></td>
                                </tr> 
                                </table> 
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="section_trivia">
                                <p class="clustertitle">TRIVIA</p>
                                <table style="margin:auto;">
                                <tr style="text-align: center;" id="events">
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/trivia/biz_quiz/">BIZ Quiz</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/trivia/pragyan_main_quiz/">Pragyan main quiz</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/trivia/memory_challenge/">Memory challenge</a></td>
                                </tr>
                                <tr style="text-align: center;" id="events">
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/trivia/how_stuff_works/">How stuff works</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/trivia/fundamental/">Fundamental</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/trivia/pragyan_cube_opens/">Pragyan Cube Opens</a></td>
                                </tr> 
                                </table> 
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="section_phronesis">
                                <p class="clustertitle">PHRONESIS</p>
                                <table style="margin:auto;">
                                <tr style="text-align: center;" id="events">
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/phronesis/labyrinth/">Labyrinth</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/phronesis/m_decoder/">M-Decoder</a></td>
                                </tr>
                                <tr style="text-align: center;" id="events">
                                    <td colspan=2><a href="<?php echo $urlRequestRoot?>/home/events/phronesis/sherlock_ed/">Sherlock-ed</a></td>
                                </tr> 
                                </table> 
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="section_concreate">
                                <p class="clustertitle">CONCREATE</p>
                                <table style="margin:auto;">
                                <tr style="text-align: center;" id="events">
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/concreate/aakriti/">Aakriti</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/concreate/mortar_master/">Mortar Master</a></td>
                                </tr>
                                <tr style="text-align: center;" id="events">
                                    <td colspan=2><a href="<?php echo $urlRequestRoot?>/home/events/concreate/town_tracing/">Town Tracing</a></td>
                                </tr> 
                                </table> 
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="section_robo_rex">
                                <p class="clustertitle">ROBOREX</p>
                                <table style="margin:auto;">
                                <tr style="text-align: center;" id="events">
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/robo_rex/jalyaan/">Jalyaan</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/robo_rex/submerge/">Submerge</a></td>
                                </tr>
                                <tr style="text-align: center;" id="events">
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/robo_rex/robowars/">Robowars</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/robo_rex/hoverone/">Hoverone</a></td>
                                </tr>
                                <tr style="text-align: center;" id="events">
                                    <td colspan=2><a href="<?php echo $urlRequestRoot?>/home/events/robo_rex/quadcombat/">Quadcombat</a></td>
                                </tr> 
                                </table> 
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="section_conception">
                                <p class="clustertitle">CONCEPTION</p>
                                <table style="margin:auto;">
                                <tr style="text-align: center;" id="events">
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/conception/circuitrix/">Circuitrix</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/conception/pdc/">PDC</a></td>
                                </tr>
                                <tr style="text-align: center;" id="events">
                                    <td colspan=2><a href="<?php echo $urlRequestRoot?>/home/events/conception/water_rocket/">Water Rocket</a></td>
                                </tr> 
                                </table> 
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="section_manigma">
                                <p class="clustertitle">MANIGMA</p>
                                <table style="margin:auto;">
                                <tr style="text-align: center;" id="events">
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/manigma/beer_factory/">Beer Factory</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/manigma/pragyan_premier_league/">Pragyan Premier League</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/manigma/dalal_street/">Dalal Street</a></td>
                                </tr>
                                <tr style="text-align: center;" id="events">
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/manigma/the_ultimate_manager/">The Ultimate Manager</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/manigma/marketing_hub/">Marketing Hub</a></td>
                                    <td><a href="<?php echo $urlRequestRoot?>/home/events/manigma/startup_arena/">Startup Arena</a></td>
                                </tr> 
                                </table>   
                            </div>
                            <div role="tabpanel" class="tab-pane fade in active" id="section_main">
                                <p class="clustertitle">EVENTS</p>  
                                <br/><br/>                             
                            </div>
                        </div>

                        <ul id=mobiletab style="display: none;" class="nav nav-tabs" role="tablist">
                        <li id="byte_hoc" class="cluster" role="presentation"><a href="#section_byte_hoc" aria-controls="home" role="tab" data-toggle="tab">Bytehoc</a></li>
                            <li id="trivia" class="cluster" role="presentation"><a href="#section_trivia" aria-controls="profile" role="tab" data-toggle="tab">Trivia</a></li>
                            <li id="phronesis" class="cluster" role="presentation"><a href="#section_phronesis" aria-controls="messages" role="tab" data-toggle="tab">Phronesis</a></li>
                            <li id="concreate" class="cluster" role="presentation"><a href="#section_concreate" aria-controls="profile" role="tab" data-toggle="tab">Concreate</a></li>
                            <li id="robo_rex" class="cluster" role="presentation"><a href="#section_robo_rex" aria-controls="messages" role="tab" data-toggle="tab">Roborex</a></li>
                            <li id="conception" class="cluster" role="presentation"><a href="#section_conception" aria-controls="messages" role="tab" data-toggle="tab">Conception</a></li>
                            <li id="manigma" class="cluster" role="presentation"><a href="#section_manigma" aria-controls="profile" role="tab" data-toggle="tab">Manigma</a></li>
                        </ul>


                    </div>
                </div>
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
            <p>Made with ♥ by <a href="https://delta.nitt.edu" target="_blank">DeltaForce</a> and <a href="https://behance.net/pragyan_nitt"target="_blank">Design team</a> </p>
        </div>
        
    </div>
    <script src="<?php echo $TEMPLATEBROWSERPATH; ?>/scripts/main.js?v=1.0.1"></script>

</body>
</html>
