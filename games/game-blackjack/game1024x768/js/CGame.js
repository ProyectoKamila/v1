function CGame(oData){
    var _bUpdate = false;
    var _bPlayerTurn;
    var _bSplitActive;
    var _bDoubleForPlayer;
    var _iInsuranceBet;
    var _iTimeElaps;
    var _iMaxBet;
    var _iMinBet;
    var _iMoney;
    var _iState;
    var _iCardIndexToDeal;
    var _iDealerValueCard;
    var _iCardDealedToDealer;
    var _iAcesForDealer;
    var _iCurFichesToWait;
    var _iNextCardForPlayer;
    var _iNextCardForDealer;
    
    var _aCardsDealing;
    var _aCardsInCurHandForDealer;
    var _aDealerCards;
    var _aCardDeck;
    var _aCardsInCurHandForPlayer;
    var _aCurActiveCardOffset;
    var _oStartingCardOffset;
    var _oDealerCardOffset;
    var _oReceiveWinOffset;
    var _oFichesDealerOffset;
    var _oRemoveCardsOffset;
    var _oCardContainer;
    
    var _oBg;
    var _oInterface;
    var _oSeat;
	var _oGameOverPanel;
    
    this._init = function(){
        _iMoney  = TOTAL_MONEY;
        _iMaxBet = MAX_BET;
        _iMinBet = MIN_BET;
        _iState = -1;
        _iTimeElaps = 0;

        s_oTweenController = new CTweenController();
        
        var iRandBg = Math.floor(Math.random() * 4) + 1;
        _oBg = createBitmap(s_oSpriteLibrary.getSprite('bg_game_'+iRandBg));
        s_oStage.addChild(_oBg);

        _oSeat = new CSeat();
        _oSeat.setCredit(TOTAL_MONEY);
        _oSeat.addEventListener(SIT_DOWN,this._onSitDown,this);
        _oSeat.addEventListener(RESTORE_ACTION,this._onSetPlayerActions);
        _oSeat.addEventListener(PASS_TURN,this._passTurnToDealer);
        _oSeat.addEventListener(END_HAND,this._onEndHand);
        _oSeat.addEventListener(PLAYER_LOSE,this._playerLose);
        
        _oCardContainer = new createjs.Container();
        _oCardContainer.x = 0;
        _oCardContainer.y = 0;
        s_oStage.addChild(_oCardContainer);
        
        _oInterface = new CInterface(_iMoney);
        _oInterface.displayMsg(TEXT_DISPLAY_MSG_SIT_DOWN);

        this.reset();
        
        _oStartingCardOffset = new CVector2();
        _oStartingCardOffset.set(876,228);
        
        _oDealerCardOffset = new CVector2();
        _oDealerCardOffset.set(450,180);
        
        _oReceiveWinOffset = new CVector2();
        _oReceiveWinOffset.set(80,820);
        
        _oFichesDealerOffset = new CVector2();
        _oFichesDealerOffset.set(CANVAS_WIDTH/2,-100);
        
        _oRemoveCardsOffset = new CVector2(116,216);
        
        _aCurActiveCardOffset=new Array(_oSeat.getCardOffset(),_oDealerCardOffset);
        
        _oInterface.disableBetFiches();
		_oGameOverPanel = new CGameOver();
		
        _bUpdate = true;
    };
    
    this.unload = function(){
		_bUpdate = false;
        createjs.Sound.stop();

        for(var i=0;i<_aCardsDealing.length;i++){
            _aCardsDealing[i].unload();
        }
        
        var aCards=_oSeat.getPlayerCards();
        for(var k=0;k<aCards.length;k++){
                aCards[k].unload();
        }
        
		_oInterface.unload();
		_oGameOverPanel.unload();
        s_oStage.removeAllChildren();
    };
    
    this.reset = function(){
        _bPlayerTurn=true;
        _bSplitActive=false;
        _bDoubleForPlayer=false;
        _iInsuranceBet=0;
        _iTimeElaps=0;
        _iCardIndexToDeal=0;

        _iDealerValueCard=0;
        _iCardDealedToDealer=0;
        _iAcesForDealer=0;
        _iCurFichesToWait=0;
        _oSeat.reset();

        _aCardsDealing=new Array();
        _aCardsDealing.splice(0);

        _aDealerCards=new Array();
        _aDealerCards.splice(0);

        _oInterface.reset();
        _oInterface.enableBetFiches();

        _aCardDeck=new Array();
        _aCardDeck=s_oGameSettings.getShuffledCardDeck();
        
        _aCardsInCurHandForPlayer=new Array();
        _aCardsInCurHandForDealer=new Array();
        for(var k=0;k<_aCardDeck.length;k++){
            if(k%2 === 0){
                    _aCardsInCurHandForPlayer.push(_aCardDeck[k]);
            }else{
                    _aCardsInCurHandForDealer.push(_aCardDeck[k]);
            }
        }


        _iNextCardForPlayer=0;
        _iNextCardForDealer=0;
    };
    
    this.changeState = function(iState){
        _iState=iState;

        switch(_iState){
            case STATE_GAME_DEALING:{
                _oInterface.disableButtons();
                _oInterface.displayMsg(TEXT_DISPLAY_MSG_DEALING);
                this._dealing();
                break;
            }
        }
    };
    
    this.attachCardToDeal = function(pStartingPoint,pEndingPoint,bDealer,iCardCount){
            var oCard = new CCard(_oStartingCardOffset.getX(),_oStartingCardOffset.getY(),_oCardContainer);
            
            if(bDealer){
                oCard.setInfo(pStartingPoint,pEndingPoint,_aCardsInCurHandForDealer[_iNextCardForDealer],
                                                s_oGameSettings.getCardValue(_aCardsInCurHandForDealer[_iNextCardForDealer]),bDealer,iCardCount);

                _iNextCardForDealer++;
            }else{
                    oCard.setInfo(pStartingPoint,pEndingPoint,_aCardsInCurHandForPlayer[_iNextCardForPlayer],
                                            s_oGameSettings.getCardValue(_aCardsInCurHandForPlayer[_iNextCardForPlayer]),bDealer,iCardCount);

                    _iNextCardForPlayer++;
            }


            oCard.addEventListener(ON_CARD_ANIMATION_ENDING,this.cardFromDealerArrived);

            _aCardsDealing.push(oCard);
            
            if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
                createjs.Sound.play("card");
            }
    };
    
    this.cardFromDealerArrived = function(oCard,bDealerCard,iCount){
        for(var i=0;i<_aCardsDealing.length;i++){
                if(_aCardsDealing[i] === oCard){
                        _aCardsDealing.splice(i,1);
                        break;
                }
        }

        if(bDealerCard === false){
            _oSeat.addCardToHand(oCard);
            _oSeat.increaseHandValue(oCard.getValue());
            _oSeat.refreshCardValue();
        }else{
            _iDealerValueCard += oCard.getValue();
            if(_iCardDealedToDealer > 2){
                    _oInterface.refreshDealerCardValue(_iDealerValueCard);
            }
            if(oCard.getValue() === 11){
                _iAcesForDealer++;
            }

            _aDealerCards.push(oCard);
        }


        if(iCount<3){
                s_oGame._dealing();
        }else{
                s_oGame._checkHand();
                if( bDealerCard === false && _bDoubleForPlayer){
                        s_oGame._onStandPlayer();
                }
        }
    };
    
    this._onStandPlayer = function(){
        _oSeat.stand();
    };
    
    this._checkHand = function(){
        var i;

        if(_bPlayerTurn){
                _oSeat.checkHand();
        }else{
            _oInterface.refreshDealerCardValue(_iDealerValueCard);
            if(_iDealerValueCard === 21){
                if(_iInsuranceBet > 0 && _aDealerCards.length === 2){
                    _oSeat.increaseCredit((_iInsuranceBet*2));
                    _oInterface.refreshCredit(_oSeat.getCredit());
                }
				
				
				for(i=0;i<_oSeat.getNumHands();i++){
					if(_oSeat.getHandValue(i) === 21){
						if(_aDealerCards.length === 2 && _oSeat.getNumCardsForHand(i) === 2){
							//STANDOFF
							this.playerStandOff(i);
						}else if(_aDealerCards.length > 2 && _oSeat.getNumCardsForHand(i) === 2){
							//PLAYER WINS
							this._playerWin(i);
						}else if(_aDealerCards.length === 2 && _oSeat.getNumCardsForHand(i) > 2){
							//PLAYER LOSES
							this._playerLose(i);
						}else{
							//STANDOFF
							this.playerStandOff(i);
						}
					}else{
						this._playerLose(i);
					}
				}
                
            }else if(_iDealerValueCard>21){
                    if(_iAcesForDealer>0){
                            _iAcesForDealer--;
                            _iDealerValueCard -= 10;
                            _oInterface.refreshDealerCardValue(_iDealerValueCard);
                            if(_iDealerValueCard<17){
                                this.hitDealer();
                            }else{
                                this._checkWinner();
                            }
                    }else{
                        this._checkWinner();
                    }
            }else if(_iDealerValueCard<17){
                    this.hitDealer();
            }else{
                    this._checkWinner();
            }
        }
    };
    
    this._playerWin = function(iHand){
        var iMult = 1;
        if(_oSeat.getHandValue(iHand) === 21 && _oSeat.getNumCardsForHand(iHand) === 2){
            iMult =  BLACKJACK_PAYOUT;
        }
        
        var iTotalWin = _oSeat.getBetForHand(iHand) + parseFloat((_oSeat.getBetForHand(iHand) * iMult).toFixed(2));
		trace("iTotalWin: "+iTotalWin);
        _oSeat.increaseCredit(iTotalWin);
        _oSeat.showWinner(iHand,TEXT_SHOW_WIN_PLAYER,iTotalWin);
        _oInterface.displayMsg(TEXT_DISPLAY_MSG_PLAYER_WIN);

        _oSeat.initMovement(iHand,_oReceiveWinOffset.getX(),_oReceiveWinOffset.getY());

        if(_iDealerValueCard === 21){
            _oSeat.initInsuranceMov(_oReceiveWinOffset.getX(),_oReceiveWinOffset.getY());
        }else{
            _oSeat.initInsuranceMov(_oFichesDealerOffset.getX(),_oFichesDealerOffset.getY());
        }
    };

    this._playerLose = function(iHand){
        _oSeat.showWinner(iHand,TEXT_SHOW_LOSE_PLAYER,0);
        _oInterface.displayMsg(TEXT_DISPLAY_MSG_PLAYER_LOSE);

        _oSeat.initMovement(iHand,_oFichesDealerOffset.getX(),_oFichesDealerOffset.getY());

        if(_iDealerValueCard === 21){
            _oSeat.initInsuranceMov(_oReceiveWinOffset.getX(),_oReceiveWinOffset.getY());
        }else{
            _oSeat.initInsuranceMov(_oFichesDealerOffset.getX(),_oFichesDealerOffset.getY());
        }
    };
	
	this.playerStandOff = function(iHand){
        _oSeat.increaseCredit(_oSeat.getBetForHand(iHand));
        
         _oSeat.showWinner(iHand,TEXT_SHOW_STANDOFF,0);
         _oInterface.displayMsg(TEXT_DISPLAY_MSG_PLAYER_STANDOFF);
         
        _oSeat.initMovement(iHand,_oReceiveWinOffset.getX(),_oReceiveWinOffset.getY()); 
        
        if(_iDealerValueCard === 21){
            _oSeat.initInsuranceMov(_oReceiveWinOffset.getX(),_oReceiveWinOffset.getY());
        }else{
            _oSeat.initInsuranceMov(_oFichesDealerOffset.getX(),_oFichesDealerOffset.getY());
        }
    };
    
    this._dealing = function(){

        if(_iCardIndexToDeal<_aCurActiveCardOffset.length*2){
                var oCard = new CCard(_oStartingCardOffset.getX(),_oStartingCardOffset.getY(),_oCardContainer);

                var pStartingPoint = new CVector2(_oStartingCardOffset.getX(),_oStartingCardOffset.getY());
                var pEndingPoint;

                //THIS CARD IS FOR THE DEALER
                if((_iCardIndexToDeal%_aCurActiveCardOffset.length) === 1){
                    _iCardDealedToDealer++;
                    pEndingPoint=new CVector2(_oDealerCardOffset.getX()+(CARD_WIDTH+2)*(_iCardIndexToDeal > 1?1:0),_oDealerCardOffset.getY());

                    oCard.setInfo(pStartingPoint,pEndingPoint,_aCardsInCurHandForDealer[_iNextCardForDealer],
                                            s_oGameSettings.getCardValue(_aCardsInCurHandForDealer[_iNextCardForDealer]),
                                                            true,_iCardDealedToDealer);

                    _iNextCardForDealer++;
                    if(_iCardDealedToDealer === 2){
                            oCard.addEventListener(ON_CARD_SHOWN,this._onCardShown);
                    }
                }else{
                    oCard.setInfo(pStartingPoint,_oSeat.getAttachCardOffset(),_aCardsInCurHandForPlayer[_iNextCardForPlayer],
                                                    s_oGameSettings.getCardValue(_aCardsInCurHandForPlayer[_iNextCardForPlayer]),
                                                                    false,_oSeat.newCardDealed());
                    _iNextCardForPlayer++;	
                }

                _aCardsDealing.push(oCard);
                _iCardIndexToDeal++;


                oCard.addEventListener(ON_CARD_ANIMATION_ENDING,this.cardFromDealerArrived);
                oCard.addEventListener(ON_CARD_TO_REMOVE,this._onRemoveCard);
                
                if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
                    createjs.Sound.play("card");
                }
        }else{
                this._checkAvailableActionForPlayer();
        }
    };
                
    this.hitDealer = function(){
        var pStartingPoint=new CVector2(_oStartingCardOffset.getX(),_oStartingCardOffset.getY());
        var pEndingPoint=new CVector2(_oDealerCardOffset.getX()+((CARD_WIDTH+3)*_iCardDealedToDealer),_oDealerCardOffset.getY());
        _iCardDealedToDealer++;

        this.attachCardToDeal(pStartingPoint,pEndingPoint,true,_iCardDealedToDealer);

        this.changeState(STATE_GAME_HITTING);
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            createjs.Sound.play("card");
        }
    };

    this._checkWinner = function(){
        for(var i=0;i<_oSeat.getNumHands();i++){
            if(_oSeat.getHandValue(i)>21){
                    this._playerLose(i);
            }else if(_iDealerValueCard>21){
                    this._playerWin(i);
            }else if(_oSeat.getHandValue(i)<22 && _oSeat.getHandValue(i)>_iDealerValueCard){
                    this._playerWin(i);
            }else if(_oSeat.getHandValue(i) === _iDealerValueCard){
                    this.playerStandOff(i);
            }else{
                this._playerLose(i);
            }
        }
    };
    
    this._onEndHand = function(){
        var pRemoveOffset=new CVector2(_oRemoveCardsOffset.getX(),_oRemoveCardsOffset.getY());
        
        for(var i=0;i<_aDealerCards.length;i++){
            _aDealerCards[i].initRemoving(pRemoveOffset);
            _aDealerCards[i].hideCard();
        }


        var aCards=_oSeat.getPlayerCards();
        for(var k=0;k<aCards.length;k++){
                aCards[k].initRemoving(pRemoveOffset);
                aCards[k].hideCard();
        }

        _oSeat.clearText();
        _oInterface.clearDealerText();
        _iTimeElaps=0;
        s_oGame.changeState(STATE_GAME_SHOW_WINNER);
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            createjs.Sound.play("fiche_collect");
        }
		
		$(s_oMain).trigger("end_hand",[_oSeat.getCredit()]);
    };
    
    this.ficheSelected = function(iFicheValue,iFicheIndex){
        var iCurBet=_oSeat.getCurBet();

        if( (iCurBet+iFicheValue) <= _iMaxBet && iFicheValue <= _oSeat.getCredit() ){
            iCurBet+=iFicheValue;
            iCurBet=Number(iCurBet.toFixed(1));

            _oSeat.decreaseCredit(iFicheValue);
            _oSeat.changeBet(iCurBet);
            _oSeat.refreshFiches(iFicheValue,iFicheIndex,0,0);

            _oSeat.bet(iCurBet,false);
            _oInterface.enable(true,false,false,false,false);
            _oInterface.refreshCredit(_oSeat.getCredit());
        }
    };
    
    this._checkAvailableActionForPlayer = function(){	
            this.changeState(-1);

            var iPlayerValueCard =_oSeat.getHandValue(0);
            //PLAYER HAVE 21 WITH FIRST 2 CARDS
            if(iPlayerValueCard === 21){
                    this._passTurnToDealer();
                    return;
            }

            var bActivateSplit = false;
            
            if(_oSeat.isSplitAvailable() && _iMoney >= _oSeat.getCurBet()*1.5){
                    bActivateSplit=true;
            }
            _oInterface.displayMsg(TEXT_DISPLAY_MSG_YOUR_ACTION);
            
            var bActivateDouble=false;
            if(_oSeat.getHandValue(0) > 8 && _oSeat.getHandValue(0) < 16 && _iMoney >= _oSeat.getCurBet()*1.5){
                    bActivateDouble=true;
            }
            _oInterface.enable(false,true,true,bActivateDouble,bActivateSplit);

            //SHOW INSURANCE PANEL
            if(_aDealerCards[0].getValue() === 11){
                _iInsuranceBet=Math.floor(_oSeat.getCurBet()/2);
                _oInterface.showInsurancePanel();
            }
    };
    
    this._passTurnToDealer = function(){
        _bPlayerTurn=false;
        _oInterface.disableButtons();
        _aDealerCards[1].showCard();
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            createjs.Sound.play("card");
        }
        
        _oInterface.displayMsg(TEXT_DISPLAY_MSG_DEALER_TURN);
        _oSeat.refreshCardValue();
    };
    
    this._gameOver = function(){
        _oGameOverPanel.show();
    };
    
    this.onFicheSelected = function(iFicheIndex,iFicheValue){
        this.ficheSelected(iFicheValue,iFicheIndex);
    };
    
    this._onSetPlayerActions = function(bDeal,bHit,bStand,bDouble,bSplit){
        _oInterface.enable(bDeal,bHit,bStand,bDouble,bSplit);
	_oSeat.refreshCardValue();
    };
    
    this._onSitDown = function(){
        this.changeState(STATE_GAME_WAITING_FOR_BET);
        _oInterface.enableBetFiches();
    };
    
    this.onDeal = function(){
        this.changeState(STATE_GAME_DEALING);
    };
    
    this.onHit = function(){
        var pStartingPoint=new CVector2(_oStartingCardOffset.getX(),_oStartingCardOffset.getY());
			
        var pEndingPoint=new CVector2(_oSeat.getAttachCardOffset().getX(),_oSeat.getAttachCardOffset().getY());

        this.attachCardToDeal(pStartingPoint,pEndingPoint,false,_oSeat.newCardDealed());

        this.changeState(STATE_GAME_HITTING);
    };
    
    this.onStand= function(){
        _oSeat.stand();
    };
    
    this.onDouble = function(){
        var iDoubleBet=_oSeat.getCurBet();
			
        var iCurBet = iDoubleBet;
        iCurBet += iDoubleBet;

        _oSeat.doubleAction(iCurBet);
        _oSeat.changeBet(iCurBet);
        _oSeat.decreaseCredit(iDoubleBet);

        _oSeat.bet(iCurBet);
        _oInterface.refreshCredit(_oSeat.getCredit());

        this.onHit();

        _bDoubleForPlayer=true;
    };
    
    this.onSplit = function(){
        _oSeat.split();

        this.changeState(STATE_GAME_SPLIT);
    };
    
    this._onSplitCardEndAnim = function(){
        var iCurBet = _oSeat.getCurBet();
        var iSplitBet = iCurBet;
        iCurBet += iSplitBet;
        _oSeat.bet(iCurBet,true);

        _bSplitActive=true;

        _oInterface.enable(false,true,true,false,false);

        _oSeat.setSplitHand();
        _oSeat.refreshCardValue();

        _oSeat.changeBet(iCurBet-iSplitBet);
        _oSeat.decreaseCredit(iSplitBet);
        _oInterface.refreshCredit(_oSeat.getCredit());
    };
    
    this.clearBets = function(){
        var iCurBet = _oSeat.getStartingBet();
        if(iCurBet>0){
            _oSeat.clearBet();
            _oSeat.increaseCredit(iCurBet);
            _oInterface.refreshCredit(_oSeat.getCredit());
        }
    };
    
    this.onBuyInsurance = function(){
        var iCurBet=_oSeat.getCurBet();
        iCurBet += _iInsuranceBet;
        _oSeat.insurance(iCurBet,-_iInsuranceBet,_iInsuranceBet);

        _oInterface.refreshCredit(_oSeat.getCredit());	
    };
    
    this._onCardShown = function(){
        s_oGame._checkHand();
    };
                
    this._onRemoveCard = function(oCard){	
        oCard.unload();
    };
    
    this.onExit = function(){
        this.unload();

        s_oMain.gotoMenu();
        $(s_oMain).trigger("restart");
    };
    
    this.getState = function(){
        return _iState;
    };
    
    this._updateWaitingBet = function(){
        _iTimeElaps += s_iTimeElaps;
        if(_iTimeElaps>BET_TIME){
            _iTimeElaps=0;
            if(_oSeat.getCurBet() === 0){
                this.ficheSelected(s_oGameSettings.getFichesValueAt(0),s_oGameSettings.getIndexForFiches(s_oGameSettings.getFichesValueAt(0)));
            }
            _oInterface.disableBetFiches();
            _oInterface.enable(true,false,false,false,false);
            this.changeState(STATE_GAME_DEALING);
        }else{
            var iCountDown=Math.floor((BET_TIME-_iTimeElaps)/1000);
            _oInterface.displayMsg(TEXT_MIN_BET+":"+_iMinBet+"\n"+TEXT_MAX_BET+":"+_iMaxBet,TEXT_DISPLAY_MSG_WAITING_BET+" "+iCountDown);
        }
    };
    
    this._updateDealing = function(){
        for(var i=0;i<_aCardsDealing.length;i++){
            _aCardsDealing[i].update();
        }
    };
    
    this._updateHitting = function(){		
        for(var i=0;i<_aCardsDealing.length;i++){
            _aCardsDealing[i].update();
        }
    };

    this._updateSplit = function(){
        _oSeat.updateSplit();
    };
    
    this._updateShowWinner = function(){
        _oSeat.updateFichesController(s_iTimeElaps);

        var aCards=_oSeat.getPlayerCards();
        for(var k=0;k<aCards.length;k++){
                aCards[k].update();
        }

        for(var j=0;j<_aDealerCards.length;j++){
                _aDealerCards[j].update();
        }

        _iTimeElaps+=s_iTimeElaps;
        if(_iTimeElaps>TIME_END_HAND){
            _iTimeElaps=0;
            this.reset();
            _oInterface.reset();

            if(_oSeat.getCredit()<s_oGameSettings.getFichesValueAt(0)){
                    this._gameOver();
                    this.changeState(-1);
            }else{
                    this.changeState(STATE_GAME_WAITING_FOR_BET);
            }

            _oInterface.refreshCredit(_oSeat.getCredit());
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
            case STATE_GAME_DEALING:{
                    this._updateDealing();
                    break;
            }
            case STATE_GAME_HITTING:{
                    this._updateHitting();
                    break;
            }
            case STATE_GAME_SPLIT:{
                    this._updateSplit();
                    break;
            }
            case STATE_GAME_SHOW_WINNER:{
                    this._updateShowWinner();
                    break;
            }
        }
        
	
    };
    
    s_oGame = this;

    TOTAL_MONEY      = oData.money;
    MIN_BET          = oData.min_bet;
    MAX_BET          = oData.max_bet;
    BET_TIME         = oData.bet_time;
    BLACKJACK_PAYOUT = oData.blackjack_payout;
    
    this._init();
}

var s_oGame;
var s_oTweenController;