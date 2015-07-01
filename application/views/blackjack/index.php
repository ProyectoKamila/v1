<!DOCTYPE html>
<html>
    <head>
        <title></title>
    <?php $this->load->view('page/header');?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="msapplication-tap-highlight" content="no"/>

        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/createjs-2013.12.12.min.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/ctl_utils.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/sprite_lib.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/settings.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CLang.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CPreloader.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CMain.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CTextButton.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CGfxButton.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CToggle.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CMenu.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CGame.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CInterface.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CTweenController.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CSeat.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CFichesController.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CVector2.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CGameSettings.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CEasing.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CHandController.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CCard.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CInsurancePanel.js"></script>
        <script type="text/javascript" src="./games/game-blackjack/game1024x768/js/CGameOver.js"></script>
        
    </head>
    <body ondragstart="return false;" ondrop="return false;" style="background: #207346;" >
        <?php $this->load->view('page/navegation/header');?>
        <?php $this->load->view('page/navegation/notification');?>
    </div>
        <script>
            $(document).ready(function () {
                var oMain = new CMain({
                    min_bet: 0.1, //MIN BET PLAYABLE BY USER
                    max_bet: 300, //MAX BET PLAYABLE BY USER
                    bet_time: 10000, //WAITING TIME FOR PLAYER BETTING
                    money: 2000, //STARING CREDIT FOR THE USER
                    blackjack_payout: 1.5        //PAYOUT WHEN USER WINS WITH BLACKJACK (DEFAULT IS 3 TO 2)
                });

                $(oMain).on("game_start", function (evt) {
                    //alert("game_start");
                });

                $(oMain).on("end_hand", function (evt, iMoney) {
                    //alert("iMoney: "+iMoney );
                });

                $(oMain).on("restart", function (evt) {
                    //alert("restart");
                });

                $(oMain).on("recharge", function (evt) {
                    alert("recharge");
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
        <?php $this->load->view('page/footer'); ?>
    </body>
   <!--     <canvas id="canvas" class='ani_hack' width="1024" height="768"> </canvas>

    </body>-->
</html>