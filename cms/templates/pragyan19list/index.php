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
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-133654966-1');
        </script>   
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
    <link rel="stylesheet" type="text/css" href="<?php echo $TEMPLATEBROWSERPATH; ?>/css/inner.css">
    <style>

        html {
            display: -webkit-flex;
            display: flex;
            max-height: 100%;
            font-family: 'Montserrat', sans-serif !important;
        }

        body {
            font-family: 'Montserrat', sans-serif !important;
            background-color: #fff;
            margin: 0;
            position: relative;
            font-weight: 500;
            width: 100%;
            max-height: 100%;
            overflow-x: hidden;
            overflow-y:hidden;
            
        }

        .fade {
            opacity: 1;
        }

        #bgimg {
            position: absolute;
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
            widows: 95vw;
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

        .clustertitle{
            text-align:center; 
            color: white; 
            font-size: 3vw; 
            font-weight: bolder; 
            text-shadow: 3px 3px #888888;
        }

        .divider {
            display: inline-block;
            width: 0;
            height: 1em;
            border-left: 0.5px solid black;
            border-right: 0.5px solid black;
        }

        .tab-content{
            margin-top: 5vh;
            margin-bottom: 4vh;
            margin-left: 2vw;
            margin-right: 2vw;
            width: 70vw;
            margin: auto;
            padding: 20px;
        }

        select{
            width:100%;max-width:90%;
        }

        td {
            width: 100%;
        }

        table { 
            table-layout: fixed;
            width: 80vw; 
        }

        .nav{
            z-index: 1000;
        }

        .nav-tabs{
            border: none !important;
        }

        .tab-pane {
            min-height: 35vh;
            max-height: 35vh;
            overflow-y: scroll;    
        }

        .nav{
            margin-top: 4vh !important;
            margin-bottom: 10vh !important;
        }

        input[type="radio"] {
            width:inherit;
        }

        input{
            width: 35vw;
        }

        nav a:hover, a:active {
          transform: none;
        }

        .registrationform{
            height: auto;
            overflow: hidden;}

        @media screen and (max-width: 767px) {
            .tab-pane,.tab-content{
                width: 60vw;
            }
            .tab-pane{
                margin-top: 15vh;
                font-size: 10px;
            }

            .footer{
                bottom: -2vh;
            }

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
            form {
                max-height: 60vh;
            }
        }

        @media screen and (min-width: 768px) {
            .tab-pane,.tab-content{
                width: 50vw;
            }
            .tab-pane{
                margin-top: 12vh; 
            }

            #social{
                font-size: 25px;
                position: absolute;
                right: 30px;
                bottom: 10px;
            }
            
            #iconlist a{
                display:block;
                margin:5px;
            }
        }

        td, th {
            padding: 15px 5px;
            display: table-cell;
            text-align: left;
            vertical-align: middle;
            border-radius: 2px;
        }

        form{
            height: 70vh;
            overflow-x: hidden;
            overflow-y: scroll;
        }

    </style>

</head>

<body>
    <div class="fade">
        
        <div class="top">
            <nav  style="background-color: transparent !important; position: absolute; width: 100vw; z-index: 1000;" class="navbar navbar-expand-lg navbar-light bg-light">
                <a style="margin:0px;" class="navbar-brand" href="<?php echo $urlRequestRoot?>/home"><img id="navlogo" src="<?php echo $TEMPLATEBROWSERPATH; ?>/../common/images/logo.png"></a>
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
            <div class="page-container" style="height: 70%;overflow-y:auto;">
                <?php echo $INFOSTRING; ?>
				<?php echo $WARNINGSTRING;?>
                <?php echo $ERRORSTRING; ?>
                <?php echo $CONTENT; ?>
            </div>
        </div>

        <div class="footer" style="color: black;">
        <div id="social">
                <div id="iconlist" style="list-style-type:none;">
                    <a href="https://www.facebook.com/pragyan.nitt/" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://twitter.com/nitt_pragyan" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/pragyan_nitt/" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.youtube.com/c/pragyannittrichy" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="https://medium.com/pragyan-blog" target="_blank"><i class="fab fa-medium"></i></a>
                    <a href="https://in.linkedin.com/company/pragyan.nitt" target="_blank"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <p>Made with ♥ by <a href="https://delta.nitt.edu" target="_blank">DeltaForce</a> and <a href="https://behance.net/pragyan_nitt"target="_blank">Design team</a> </p>
        </div>
        
    </div>

</body>
</html>
