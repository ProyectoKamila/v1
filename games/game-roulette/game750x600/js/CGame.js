function CGame(oData){
    var _bUpdate = false;
    var _bWinAssigned;
    var _iState;
    var _iBetMult;
    var _iTimeElaps;
    var _iFactor;
    var _iFrameToStop;
    var _iNumberExtracted;
    var _iCasinoCash;
    var _aBetMultHistory;
    var _aNumExtractedHistory;
    var _aEnlights;
    var _aFichesToMove;
    var _oWheelSfx;
        
    var _oBg;
    var _oMySeat;
    var _oPlaceHolder;
    var _oInterface;
    var _oTableController;
    var _oAttachFiches;
    var _oMsgBox;
    var _oWheelTopAnim;
    var _oWheelAnim;
    var _oFinalBet;
    var _oNeighborsPanel;
    var _oGameOverPanel;
	var _oBlock;
    
    this._init = function(){
        s_oTweenController = new CTweenController();
        s_oGameSettings = new CRouletteSettings();
        
        _oBg = createBitmap(s_oSpriteLibrary.getSprite('bg_game'));
        s_oStage.addChild(_oBg);
        
        this._initEnlights();
        
        _oAttachFiches = new createjs.Container();
        _oAttachFiches.x = 261;
        _oAttachFiches.y = 264;
        s_oStage.addChild(_oAttachFiches);
        
        _oTableController = new CTableController();
        _oTableController.addEventListener(ON_SHOW_ENLIGHT,this._onShowEnlight);
        _oTableController.addEventListener(ON_HIDE_ENLIGHT,this._onHideEnlight);
        _oTableController.addEventListener(ON_SHOW_BET_ON_TABLE,this._onShowBetOnTable);
        
        _iState=-1;
        _iBetMult=37;
        _aBetMultHistory=new Array();

        _oMySeat = new CSeat();

        _oWheelTopAnim = new CWheelTopAnim(493,6);
        _oWheelAnim = new CWheelAnim(0,0);
        _oInterface = new CInterface();
        
        _oFinalBet = new CFinalBetPanel(160,569);
        
        _oNeighborsPanel  = new CNeighborsPanel(_oMySeat.getCredit());
        
        _oGameOverPanel = new CGameOver();
        
        _oMsgBox = new CMsgBox();
		
        var oGraphics = new createjs.Graphics().beginFill("rgba(0,0,0,0.01)").drawRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
        _oBlock = new createjs.Shape(oGraphics);
        _oBlock.on("click",function(){});
        _oBlock.visible= false;
        s_oStage.addChild(_oBlock);
		
        _aNumExtractedHistory=new Array();

        _iTimeElaps=0;
        this._onSitDown();
	
        _bUpdate = true;
    };
    
    this.unload = function(){
        createjs.Sound.stop();

        _oInterface.unload();
		_oTableController.unload();
		_oMsgBox.unload();
		_oFinalBet.unload();
		_oNeighborsPanel.unload();
		_oGameOverPanel.unload();
	
		s_oStage.removeAllChildren();
    };
    
    this._initEnlights = function(){
        var oBmp;
        _aEnlights = new Array();
        
        /*********************NUMBER ENLIGHT*****************/
        oBmp = new CEnlight(288,175,s_oSpriteLibrary.getSprite('enlight_bet0'),s_oStage);
        _aEnlights["oEnlight_0"] = oBmp;
        
        oBmp = new CEnlight(318,244,s_oSpriteLibrary.getSprite('enlight_number1'),s_oStage);
        _aEnlights["oEnlight_1"] = oBmp;
        
        oBmp = new CEnlight(342,220,s_oSpriteLibrary.getSprite('enlight_number1'),s_oStage);
        _aEnlights["oEnlight_2"] = oBmp;
        
        oBmp = new CEnlight(368,198,s_oSpriteLibrary.getSprite('enlight_number3'),s_oStage);
        _aEnlights["oEnlight_3"] = oBmp;
        
        oBmp = new CEnlight(341,262,s_oSpriteLibrary.getSprite('enlight_number4'),s_oStage);
        _aEnlights["oEnlight_4"] = oBmp;
        
        oBmp = new CEnlight(367,238,s_oSpriteLibrary.getSprite('enlight_number1'),s_oStage);
        _aEnlights["oEnlight_5"] = oBmp;
        
        oBmp = new CEnlight(392,214,s_oSpriteLibrary.getSprite('enlight_number3'),s_oStage);
        _aEnlights["oEnlight_6"] = oBmp;
        
        oBmp = new CEnlight(366,279,s_oSpriteLibrary.getSprite('enlight_number4'),s_oStage);
        _aEnlights["oEnlight_7"] = oBmp;
        
        oBmp = new CEnlight(391,255,s_oSpriteLibrary.getSprite('enlight_number1'),s_oStage);
        _aEnlights["oEnlight_8"] = oBmp;
        
        oBmp = new CEnlight(416,231,s_oSpriteLibrary.getSprite('enlight_number3'),s_oStage);
        _aEnlights["oEnlight_9"] = oBmp;
        
        oBmp = new CEnlight(390,297,s_oSpriteLibrary.getSprite('enlight_number4'),s_oStage);
        _aEnlights["oEnlight_10"] = oBmp;
        
        oBmp = new CEnlight(415,273,s_oSpriteLibrary.getSprite('enlight_number1'),s_oStage);
        _aEnlights["oEnlight_11"] = oBmp;
        
        oBmp = new CEnlight(439,249,s_oSpriteLibrary.getSprite('enlight_number12'),s_oStage);
        _aEnlights["oEnlight_12"] = oBmp;
        
        oBmp = new CEnlight(414,315,s_oSpriteLibrary.getSprite('enlight_number4'),s_oStage);
        _aEnlights["oEnlight_13"] = oBmp;
        
        oBmp = new CEnlight(439,291,s_oSpriteLibrary.getSprite('enlight_number1'),s_oStage);
        _aEnlights["oEnlight_14"] = oBmp;
        
        oBmp = new CEnlight(464,266,s_oSpriteLibrary.getSprite('enlight_number12'),s_oStage);
        _aEnlights["oEnlight_15"] = oBmp;
        
        oBmp = new CEnlight(439,333,s_oSpriteLibrary.getSprite('enlight_number16'),s_oStage);
        _aEnlights["oEnlight_16"] = oBmp;
        
        oBmp = new CEnlight(464,308,s_oSpriteLibrary.getSprite('enlight_number16'),s_oStage);
        _aEnlights["oEnlight_17"] = oBmp;
        
        oBmp = new CEnlight(488,283,s_oSpriteLibrary.getSprite('enlight_number1'),s_oStage);
        _aEnlights["oEnlight_18"] = oBmp;
        
        oBmp = new CEnlight(466,351,s_oSpriteLibrary.getSprite('enlight_number16'),s_oStage);
        _aEnlights["oEnlight_19"] = oBmp;
        
        oBmp = new CEnlight(489,326,s_oSpriteLibrary.getSprite('enlight_number16'),s_oStage);
        _aEnlights["oEnlight_20"] = oBmp;
        
        oBmp = new CEnlight(513,301,s_oSpriteLibrary.getSprite('enlight_number16'),s_oStage);
        _aEnlights["oEnlight_21"] = oBmp;
        
        oBmp = new CEnlight(491,371,s_oSpriteLibrary.getSprite('enlight_number16'),s_oStage);
        _aEnlights["oEnlight_22"] = oBmp;
        
        oBmp = new CEnlight(515,344,s_oSpriteLibrary.getSprite('enlight_number16'),s_oStage);
        _aEnlights["oEnlight_23"] = oBmp;
        
        oBmp = new CEnlight(539,319,s_oSpriteLibrary.getSprite('enlight_number16'),s_oStage);
        _aEnlights["oEnlight_24"] = oBmp;
        
        oBmp = new CEnlight(516,389,s_oSpriteLibrary.getSprite('enlight_number25'),s_oStage);
        _aEnlights["oEnlight_25"] = oBmp;
        
        oBmp = new CEnlight(540,363,s_oSpriteLibrary.getSprite('enlight_number25'),s_oStage);
        _aEnlights["oEnlight_26"] = oBmp;
        
        oBmp = new CEnlight(564,338,s_oSpriteLibrary.getSprite('enlight_number16'),s_oStage);
        _aEnlights["oEnlight_27"] = oBmp;
        
        oBmp = new CEnlight(542,408,s_oSpriteLibrary.getSprite('enlight_number25'),s_oStage);
        _aEnlights["oEnlight_28"] = oBmp;
        
        oBmp = new CEnlight(566,381,s_oSpriteLibrary.getSprite('enlight_number25'),s_oStage);
        _aEnlights["oEnlight_29"] = oBmp;
        
        oBmp = new CEnlight(590,356,s_oSpriteLibrary.getSprite('enlight_number30'),s_oStage);
        _aEnlights["oEnlight_30"] = oBmp;
        
        oBmp = new CEnlight(568,428,s_oSpriteLibrary.getSprite('enlight_number25'),s_oStage);
        _aEnlights["oEnlight_31"] = oBmp;
        
        oBmp = new CEnlight(593,401,s_oSpriteLibrary.getSprite('enlight_number25'),s_oStage);
        _aEnlights["oEnlight_32"] = oBmp;
        
        oBmp = new CEnlight(617,376,s_oSpriteLibrary.getSprite('enlight_number30'),s_oStage);
        _aEnlights["oEnlight_33"] = oBmp;
        
        oBmp = new CEnlight(596,448,s_oSpriteLibrary.getSprite('enlight_number25'),s_oStage);
        _aEnlights["oEnlight_34"] = oBmp;
        
        oBmp = new CEnlight(619,421,s_oSpriteLibrary.getSprite('enlight_number25'),s_oStage);
        _aEnlights["oEnlight_35"] = oBmp;
        
        oBmp = new CEnlight(644,395,s_oSpriteLibrary.getSprite('enlight_number30'),s_oStage);
        _aEnlights["oEnlight_36"] = oBmp;
        
        /*********************OTHER ENLIGHTS*****************/
        oBmp = new CEnlight(624,470,s_oSpriteLibrary.getSprite('enlight_col'),s_oStage);
        _aEnlights["oEnlight_col1"] = oBmp;
        
        oBmp = new CEnlight(649,442,s_oSpriteLibrary.getSprite('enlight_col'),s_oStage);
        _aEnlights["oEnlight_col2"] = oBmp;
        
        oBmp = new CEnlight(672,415,s_oSpriteLibrary.getSprite('enlight_col'),s_oStage);
        _aEnlights["oEnlight_col3"] = oBmp;
        
        oBmp = new CEnlight(280,268,s_oSpriteLibrary.getSprite('enlight_first_twelve'),s_oStage);
        _aEnlights["oEnlight_first12"] = oBmp;
        
        oBmp = new CEnlight(377,340,s_oSpriteLibrary.getSprite('enlight_second_twelve'),s_oStage);
        _aEnlights["oEnlight_second12"] = oBmp;
        
        oBmp = new CEnlight(477,416,s_oSpriteLibrary.getSprite('enlight_third_twelve'),s_oStage);
        _aEnlights["oEnlight_third12"] = oBmp;
        
        oBmp = new CEnlight(241,305,s_oSpriteLibrary.getSprite('enlight_first18'),s_oStage);
        _aEnlights["oEnlight_first18"] = oBmp;
        
        oBmp = new CEnlight(288,343,s_oSpriteLibrary.getSprite('enlight_first18'),s_oStage);
        _aEnlights["oEnlight_even"] = oBmp;
        
        oBmp = new CEnlight(338,380,s_oSpriteLibrary.getSprite('enlight_black'),s_oStage);
        _aEnlights["oEnlight_black"] = oBmp;
        
        oBmp = new CEnlight(389,419,s_oSpriteLibrary.getSprite('enlight_red'),s_oStage);
        _aEnlights["oEnlight_red"] = oBmp;
        
        oBmp = new CEnlight(439,456,s_oSpriteLibrary.getSprite('enlight_odd'),s_oStage);
        _aEnlights["oEnlight_odd"] = oBmp;
        
        oBmp = new CEnlight(492,498,s_oSpriteLibrary.getSprite('enlight_second18'),s_oStage);
        _aEnlights["oEnlight_second18"] = oBmp;
    };
    
    this._setState = function(iState){
        _iState=iState;

        switch(iState){
            case STATE_GAME_WAITING_FOR_BET:{
                _oInterface.enableBetFiches();
				_oBlock.visible= false;
                break;
            }
        }
    };
    
    this._resetTable = function(){
        _iTimeElaps = 0;
        _iBetMult=37;
        _aBetMultHistory=new Array();

        if(_oPlaceHolder !== null){
            s_oStage.removeChild(_oPlaceHolder);
            _oPlaceHolder = null;
        }

        _oMySeat.reset();
        _oNeighborsPanel.reset();

        if (_oMySeat.getCredit() < 0.1) {
            _iState = -1;
            _oBlock.visible= false;
            _oGameOverPanel.show();
        }else{
            this._setState(STATE_GAME_WAITING_FOR_BET);
        }
    };
    
    this._startRouletteAnim = function(){
        _oInterface.disableBetFiches();

        _iNumberExtracted = this._generateWinLoss();

        _aNumExtractedHistory.push(_iNumberExtracted);

        _iTimeElaps = 0;
        _iFactor = 0;
        _iFrameToStop = s_oGameSettings.getFrameForNumber(_iNumberExtracted);
    };
    
    this._startWheelTopAnim = function(){
        _oWheelTopAnim.playToFrame(_iFrameToStop);
        
    };
    
    this._startBallSpinAnim = function(){
        var iRand = Math.floor(Math.random() * 3);
        
        _oWheelAnim.startSpin(iRand,s_oGameSettings.getFrameForBallSpin(iRand,_iNumberExtracted));
    };
    
    this._generateWinLoss = function(){
        var iRandIndex;
        var aNumbersBetted = _oMySeat.getNumbersBetted();
        var aTmpNumbers = _oMySeat.getNumberSelected();
        var iWin = aNumbersBetted[aTmpNumbers[0]].win;
        var iWinOccurence;
		var iRand;
        if(_iCasinoCash < iWin){
            iWinOccurence = 0;
			iRand = Math.floor(Math.random() * (100));
        }else if(WIN_OCCURRENCE === -1){
            iWinOccurence = 37-_iBetMult;
			iRand = Math.floor(Math.random() * (38));
        }else{
            iWinOccurence = WIN_OCCURRENCE;
			iRand = Math.floor(Math.random() * (100));
        }

        if (iRand >= iWinOccurence) {
            _bWinAssigned = false;
        }else {
            _bWinAssigned = true;
        }

        if(_bWinAssigned){
            do{
                iRandIndex=Math.floor(Math.random() * aNumbersBetted.length);
                iWin = aNumbersBetted[iRandIndex].win;
            }while(iWin === 0);

            _iNumberExtracted=iRandIndex;
        }else{
            var aTmpNumbers=new Array();
            for(var k=0;k<37;k++){
                    aTmpNumbers.push(k);
            }
            do{
                if(aTmpNumbers.length === 0){
                    iRandIndex=Math.floor(Math.random() * aNumbersBetted.length);
                    break;
                }
                iRandIndex=Math.floor(Math.random() * aTmpNumbers.length);
                iWin = aNumbersBetted[iRandIndex].win;

                aTmpNumbers.splice(iRandIndex,1);
            }while(iWin>0);

            _iNumberExtracted = iRandIndex;
        }

        return _iNumberExtracted;
    };
    
    this._rouletteAnimEnded = function(){
        _iTimeElaps = 0;
        _oWheelTopAnim.showBall();
        this._setState(STATE_GAME_SHOW_WINNER);

        _oWheelSfx.stop();
        

        var aNumbersBetted=_oMySeat.getNumbersBetted();
        var oWins=aNumbersBetted[_iNumberExtracted];
        var iWin=roundDecimal(oWins.win,2);
        _aFichesToMove = new Array();

        for(var j=0;j<aNumbersBetted.length;j++){
                var oRes=aNumbersBetted[j];
                if(oRes.win>0){
                    for(var k=0;k<oRes.mc.length;k++){
                        _aFichesToMove.push(oRes.mc[k]);
                        var oEndPos = s_oGameSettings.getAttachOffset("oDealerWin");
                        oRes.mc[k].setEndPoint(oEndPos.x,oEndPos.y);
                    }
                }
        }

        if(oWins.mc){
            for(var i=0;i<oWins.mc.length;i++){
                var oEndPos = s_oGameSettings.getAttachOffset("oReceiveWin");
                oWins.mc[i].setEndPoint(oEndPos.x,oEndPos.y);
            }

            _oInterface.showWin(iWin);
        }else{
            _oInterface.showLose();
        }
        _oInterface.refreshNumExtracted(_aNumExtractedHistory);

        //ATTACH PLACEHOLDER THAT SHOW THE NUMBER EXTRACTED
        _oPlaceHolder = createBitmap(s_oSpriteLibrary.getSprite('placeholder'));
        if(_iNumberExtracted === 0){
                _oPlaceHolder.x = _aEnlights["oEnlight_"+_iNumberExtracted].getX() +27;
                _oPlaceHolder.y = _aEnlights["oEnlight_"+_iNumberExtracted].getY() + 22;
        }else{
                _oPlaceHolder.x = _aEnlights["oEnlight_"+_iNumberExtracted].getX();
                _oPlaceHolder.y = _aEnlights["oEnlight_"+_iNumberExtracted].getY();
        }
        
        _oPlaceHolder.regX = 6;
        _oPlaceHolder.regY = 20;
        s_oStage.addChild(_oPlaceHolder);

        _oMySeat.showWin(iWin);
        if(iWin > 0){
            _iCasinoCash -= _oMySeat.getCurBet();
        }else{
            _iCasinoCash += _oMySeat.getCurBet();
        }
                
	$(s_oMain).trigger("end_bet",[_oMySeat.getCredit(),iWin]);

        _oInterface.refreshMoney(_oMySeat.getCredit());
    };
    
    this.showMsgBox = function(szText){
        _oMsgBox.show(szText);
    };
    
    this.onRecharge = function() {
        _oMySeat.recharge(TOTAL_MONEY);
        _oInterface.refreshMoney(_oMySeat.getCredit());

        this._setState(STATE_GAME_WAITING_FOR_BET);
        
        _oGameOverPanel.hide();
        
        $(s_oMain).trigger("recharge");
    };
    
    this.onSpin = function(){
        if (_oMySeat.getCurBet() === 0) {
                return;
        }
		
		if(_oBlock.visible){
			return;
		}
		
		_oBlock.visible= true;
		
        _oWheelTopAnim.hideBall();
        _oNeighborsPanel.hide();
        _oFinalBet.hide();
        _oInterface.enableSpin(false);
        _oInterface.displayAction(TEXT_SPINNING);

        this._startRouletteAnim();
        this._startWheelTopAnim();
        this._startBallSpinAnim();

        this._setState(STATE_GAME_SPINNING);

        _oWheelSfx = createjs.Sound.play("wheel_sound");
    };
    
    this._onSitDown = function(){
        this._setState(STATE_GAME_WAITING_FOR_BET);
        _oMySeat.setInfo(TOTAL_MONEY, _oAttachFiches);
        _oInterface.refreshMoney(TOTAL_MONEY);
    };
    
    this._onShowBetOnTable = function(oParams){
        var szBut = oParams.button;
        var aNumbers = oParams.numbers;
        _iBetMult -= oParams.bet_mult;
        _aBetMultHistory.push(oParams.bet_mult);

        var iBetWin = oParams.bet_win;
        var iNumFiches = oParams.num_fiches;

        var iIndexFicheSelected = _oInterface.getCurFicheSelected();
        var iFicheValue=s_oGameSettings.getFicheValues(iIndexFicheSelected);
        var iCurBet=_oMySeat.getCurBet();

        if( (iFicheValue * iNumFiches) > _oMySeat.getCredit() ){
            //SHOW MSG BOX
            _oMsgBox.show(TEXT_ERROR_NO_MONEY_MSG);
            _oNeighborsPanel.reset();
            return;
        }

        if( (iCurBet+iFicheValue) > MAX_BET ){
            _oMsgBox.show(TEXT_ERROR_MAX_BET_REACHED);
            _oNeighborsPanel.reset();
            return;
        }

        switch(szBut){
                case "oBetVoisinsZero":{
                        _oMySeat.createPileForVoisinZero(iFicheValue,iIndexFicheSelected,aNumbers,iBetWin,iNumFiches);
                        break;
                }
                case "oBetTier":{
                        _oMySeat.createPileForTier(iFicheValue,iIndexFicheSelected,aNumbers,iBetWin,iNumFiches);
                        break;
                }
                case "oBetOrphelins":{
                        _oMySeat.createPileForOrphelins(iFicheValue,iIndexFicheSelected,aNumbers,iBetWin,iNumFiches);
                        break;
                }
                case "oBetFinalsBet":{
                        _oMySeat.createPileForMultipleNumbers(iFicheValue,iIndexFicheSelected,aNumbers,iBetWin,iNumFiches);
                        break;
                }
                default:{
                        _oMySeat.addFicheOnTable(iFicheValue,iIndexFicheSelected,aNumbers,iBetWin,szBut);
                }
        }
        _oInterface.refreshMoney(_oMySeat.getCredit());
        _oInterface.enableSpin(true);

        createjs.Sound.play("chip");
    };
    
    this._onShowBetOnTableFromNeighbors = function(oParams){
        var aNumbers = oParams.numbers;
        _iBetMult -= oParams.bet_mult;
        _aBetMultHistory.push(oParams.bet_mult);

        var iBetWin = oParams.bet_win;
        var iNumFiches = oParams.num_fiches;
        
        var iFicheValue=s_oGameSettings.getFicheValues(oParams.value);

        var iCurBet=_oMySeat.getCurBet();

        if( (iFicheValue * iNumFiches)>_oMySeat.getCredit() ){
            //SHOW MSG BOX
            _oMsgBox.show(TEXT_ERROR_NO_MONEY_MSG);
            _oNeighborsPanel.reset();
            return;
        }

        if( (iCurBet + (iFicheValue * iNumFiches)) > MAX_BET ){
            _oMsgBox.show(TEXT_ERROR_MAX_BET_REACHED);
            _oNeighborsPanel.reset();
            return;
        }
        _oMySeat.createPileForMultipleNumbers(iFicheValue,oParams.value,aNumbers,iBetWin,iNumFiches);
        
        _oInterface.refreshMoney(_oMySeat.getCredit());
        _oInterface.enableSpin(true);

        createjs.Sound.play("chip");
    };
    
    this._onShowEnlight = function(oParams){
        var aBets = oParams.numbers;
        
        for(var i=0;i<aBets.length;i++){
            _aEnlights["oEnlight_"+aBets[i]].show();
        }

        var szEnlight=oParams.enlight;
        if(szEnlight){
            _aEnlights["oEnlight_"+szEnlight].show();
        }
    };
    
    this._onHideEnlight = function(oParams){
        var aBets=oParams.numbers;
        for(var i=0;i<aBets.length;i++){
                _aEnlights["oEnlight_"+aBets[i]].hide();
        }

        var szEnlight=oParams.enlight;
        if(szEnlight){
            _aEnlights["oEnlight_"+szEnlight].hide();
        }
    };
    
    this.onClearLastBet = function(){
        if(_aBetMultHistory.length>0){
                var iBetMultToRemove = _aBetMultHistory.pop();
                _iBetMult += iBetMultToRemove;
        }
		
        if(_aBetMultHistory.length === 0){
                _oInterface.enableSpin(false);
        }
		
        _oMySeat.clearLastBet();
        _oInterface.refreshMoney(_oMySeat.getCredit());
    };
    
    this.onClearAllBets = function(){
        _oMySeat.clearAllBets();
        _oInterface.refreshMoney(_oMySeat.getCredit());
        _oInterface.enableSpin(false);
        _oNeighborsPanel.reset();
        _iBetMult=37;
    };
    
    this.onFinalBetShown = function(){
        if(_oFinalBet.visible){
            _oFinalBet.hide();
        }else{
            _oFinalBet.show();	
        }
    };
    
    this.onOpenNeighbors = function(){
        _oFinalBet.hide();
        _oNeighborsPanel.showPanel(_oInterface.getCurFicheSelected(),_oMySeat.getCredit());
    };
   
    this.onExit = function(){
        this.unload();
        s_oMain.gotoMenu();
        $(s_oMain).trigger("restart");
    };
    
    this._updateWaitingBet = function(){
        _iTimeElaps += s_iTimeElaps;

        if(_iTimeElaps>TIME_WAITING_BET){
                _iTimeElaps = 0;
                this.onSpin();
        }else{
                var iCountDown=Math.floor((TIME_WAITING_BET-_iTimeElaps)/1000);

                _oInterface.displayAction(TEXT_MIN_BET+": "+MIN_BET+"\n"+TEXT_MAX_BET+": "+MAX_BET,
                                                                                TEXT_DISPLAY_MSG_WAITING_BET+" "+iCountDown);
        }
    };
    
    this._updateSpinning = function(){
        _iTimeElaps += s_iTimeElaps;
        
        if (  _oWheelTopAnim.getCurrentFrame() === (NUM_WHEEL_TOP_FRAMES-1)) {
            _oWheelTopAnim.playToFrame(1);
        }else{
            _oWheelTopAnim.nextFrame();
        }
        
        if (_iTimeElaps > TIME_SPINNING) {
            if ( _oWheelTopAnim.getCurrentFrame() === _iFrameToStop) {
                this._rouletteAnimEnded();
            }
        }
    };
    
    this._updateShowWinner = function(){
        _iTimeElaps+=s_iTimeElaps;
        if(_iTimeElaps>TIME_SHOW_WINNER){
            _iTimeElaps=0;
            this._setState(STATE_DISTRIBUTE_FICHES);
        }
    };
    
    this._updateDistributeFiches = function(){
        _iTimeElaps += s_iTimeElaps;
        if(_iTimeElaps > TIME_FICHES_MOV){
            _iTimeElaps = 0;
            createjs.Sound.play("fiche_collect");
            this._resetTable();
        }else{
            var fLerp = easeInOutCubic( _iTimeElaps, 0, 1, TIME_FICHES_MOV);
            for(var i=0;i<_aFichesToMove.length;i++){
                _aFichesToMove[i].updatePos(fLerp);
            }
        }
    };
    
    this.update = function(){
        if(_bUpdate === false){
            return;
        }
        
        switch(_iState){
            case STATE_GAME_WAITING_FOR_BET:{
                    this._updateWaitingBet();
                    break;
            }
            case STATE_GAME_SPINNING:{
                    this._updateSpinning();
                    break;
            }
            case STATE_GAME_SHOW_WINNER:{
                    this._updateShowWinner();
                    break;
            }
            case STATE_DISTRIBUTE_FICHES:{
                    this._updateDistributeFiches();
                    break;
            }
        }
        
        _oWheelAnim.update();
    };
    
    s_oGame = this;
    
    TOTAL_MONEY = oData.money;
    MIN_BET = oData.min_bet;
    MAX_BET = oData.max_bet;
    TIME_WAITING_BET = oData.time_bet;
    TIME_SHOW_WINNER = oData.time_winner;
    WIN_OCCURRENCE = oData.win_occurrence;
    _iCasinoCash = oData.casino_cash;
    
    this._init();
}

var s_oGame;
var s_oTweenController;
var s_oGameSettings;