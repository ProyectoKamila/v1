<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo base_url(); ?>" />
        <title></title>
        <link rel="stylesheet" href="./games/game-roulette/game750x600/css/reset.css" type="text/css">
        <link rel="stylesheet" href="./games/game-roulette/game750x600/css/main.css" type="text/css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
	<meta name="msapplication-tap-highlight" content="no"/>

        <script type="text/javascript" src="./games/game-roulette/game750x600/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/createjs-2014.12.12.min.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/ctl_utils.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/sprite_lib.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/settings.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CRouletteSettings.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CFichesController.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CLang.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CPreloader.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CMain.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CTextButton.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CGfxButton.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CFicheBut.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CBetTableButton.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CBetTextButton.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CToggle.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CMenu.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CGame.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CInterface.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CMsgBox.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CTweenController.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CSeat.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CTableController.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CRouletteSettings.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CEnlight.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CWheelTopAnim.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CFiche.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CHistoryRow.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CWheelAnim.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CFinalBetPanel.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CNeighborsPanel.js"></script>
        <script type="text/javascript" src="./games/game-roulette/game750x600/js/CGameOver.js"></script>
        
    </head>
    <body ondragstart="return false;" ondrop="return false;" >
	<div style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%"></div>
          <script>
            $(document).ready(function(){
                     var oMain = new CMain({
                                            money: 1000,      //STARING CREDIT FOR THE USER
                                            min_bet: 0.1,     //MINIMUM BET
                                            max_bet: 100,     //MAXIMUM BET
                                            time_bet: 10000,  //TIME TO WAIT FOR A BET IN MILLISECONDS
                                            time_winner: 3000, //TIME FOR WINNER SHOWING IN MILLISECONDS    
                                            win_occurrence: 25, //Win occurrence percentage (100 = always win). 
                                                                //SET THIS VALUE TO -1 IF YOU WANT WIN OCCURRENCE STRICTLY RELATED TO PLAYER BET ( SEE DOCUMENTATION)
                                            casino_cash:4000    //The starting casino cash that is recharged by the money lost by the user
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
                     
                     $(oMain).on("recharge", function(evt) {
                             //alert("recharge");
                     });
           });

        </script>
        <canvas id="canvas" class='ani_hack' width="750" height="600"> </canvas>

    </body>
</html>