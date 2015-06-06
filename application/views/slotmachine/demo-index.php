<!--http://localhost/v1/game-slot-machine/game_1024x768/-->
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="./game-slot-machine/game_1024x768/css/reset.css" type="text/css">
        <link rel="stylesheet" href="./game-slot-machine/game_1024x768/css/main.css" type="text/css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
	<meta name="msapplication-tap-highlight" content="no"/>

        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/createjs-2013.12.12.min.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/ctl_utils.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/sprite_lib.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/settings.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CSlotSettings.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CLang.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CPreloader.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CMain.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CTextButton.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CGfxButton.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CToggle.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CBetBut.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CMenu.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CGame.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CReelColumn.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CInterface.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CPayTablePanel.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CStaticSymbolCell.js"></script>
        <script type="text/javascript" src="./game-slot-machine/game_1024x768/js/CTweenController.js"></script>
        
    </head>
    <body ondragstart="return false;" ondrop="return false;" >
	<div style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%"></div>
          <script>
            $(document).ready(function(){
                     var oMain = new CMain({
                                    min_reel_loop:2,          //NUMBER OF REEL LOOPS BEFORE SLOT STOPS  
                                    reel_delay: 6,            //NUMBER OF FRAMES TO DELAY THE REELS THAT START AFTER THE FIRST ONE
                                    time_show_win:2000,       //DURATION IN MILLISECONDS OF THE WINNING COMBO SHOWING
                                    time_show_all_wins: 2000, //DURATION IN MILLISECONDS OF ALL WINNING COMBO
                                    money:2000                //STARING CREDIT FOR THE USER
                                });

                     $(oMain).on("game_start", function(evt) {
                             //alert("game_start");
                     });

                     $(oMain).on("end_bet", function(evt,iMoney,iBetWin) {
                             //alert("iMoney: "+iMoney + " Win:"+iBetWin);
                     });

                     $(oMain).on("restart", function(evt) {
                             //alert("restart");
                     });
           });

        </script>
        <canvas id="canvas" class='ani_hack' width="1024" height="768"> </canvas>

    </body>
</html>