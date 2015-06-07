<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="./games/game-jacks-or-better/game1024x768/css/reset.css" type="text/css">
        <link rel="stylesheet" href="./games/game-jacks-or-better/game1024x768/css/main.css" type="text/css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
	<meta name="msapplication-tap-highlight" content="no"/>

        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/createjs-2013.12.12.min.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/ctl_utils.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/sprite_lib.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/settings.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CLang.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CPreloader.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CMain.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CTextButton.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CGfxButton.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CToggle.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CMenu.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CGame.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CInterface.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CGameSettings.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CCard.js"></script>
	    <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CGameOver.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CPayTable.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CPayTableSettings.js"></script>
        <script type="text/javascript" src="./games/game-jacks-or-better/game1024x768/js/CHandEvaluator.js"></script>
        
    </head>
    <body ondragstart="return false;" ondrop="return false;" >
    <?php include('./interface/header.php');?>
	<div style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%"></div>
          <script>
            $(document).ready(function(){
                     var oMain = new CMain({
                                    bets: [0.2,0.3,0.5,1,2,3,5],           //ALL THE AVAILABLE BETS FOR THE PLAYER
                                    combo_prizes: [250,50,25,9,6,4,3,2,1], //WINS FOR FIRST COLUMN
                                    money: 1000                          ,  //STARING CREDIT FOR THE USER
                                    recharge:true                           //RECHARGE WHEN MONEY IS ZERO. SET THIS TO FALSE TO AVOID AUTOMATIC RECHARGE
                                });

                     $(oMain).on("game_start", function(evt) {
                             //alert("game_start");
                     });

                     $(oMain).on("end_hand", function(evt,iMoney,iWin) {
                             //alert("iMoney: "+iMoney +" WIN: "+iWin);
                     });

                     $(oMain).on("restart", function(evt) {
                             //alert("restart");
                     });
					 
                    $(oMain).on("recharge", function(evt) {
                             //alert("recharge");
                     });
           });

        </script>
    <div class="container-fluid sin-padding">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sin-padding">
                <div class="content-canvas">
                    <canvas id="canvas" class='ani_hack' width="1024" height="768"> </canvas>
                </div>  
            </div>
        </div>
    </div>
    <?php include('./interface/footer.php');?>
    
    </body>
</html>