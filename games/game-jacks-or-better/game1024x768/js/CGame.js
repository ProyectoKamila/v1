function CGame(oData){
    var _bBlock;
    var _iMoney;
    var _iState;
    var _iCurBet;
    var _iCurWin;
    var _iCurBetIndex;
    var _iCurCreditIndex;
    var _iCurIndexDeck;
    var _iCurState;
    var _aCurHand;
    var _aCurHandValue; //evaluar mano
    var _aCardDeck;
    var _oGameSettings;
    var _oHandEvaluator;
    var _aCurHandValueDraw;
    var indexreturn;
    var handholded;
    var z;
    var iNumHold;
    z = 0;
    var _oBg;
    var _oInterface;
    var _oPayTable;
    var _oGameOverPanel;
    var _oCardAttach;
        /*funcion para setar dinero*/
    this.moneyref = function(money){
       

        TOTAL_MONEY= money;
        _iMoney= money;
        
    };

    this._init = function(){

        s_oPayTableSettings = new CPayTableSettings();
        _iMoney  = TOTAL_MONEY;

        _oBg = createBitmap(s_oSpriteLibrary.getSprite('bg_game'));
        s_oStage.addChild(_oBg);

        _oCardAttach = new createjs.Container();
        _oCardAttach.x = 150;
        _oCardAttach.y = 530;
        s_oStage.addChild(_oCardAttach);
        
        _oPayTable = new CPayTable(120,149);

        _bBlock = false;
        _iCurBetIndex = 0;
        _iCurCreditIndex = 0;
        _iCurWin = 0;
        _iCurBet = parseFloat(BET_TYPE[_iCurBetIndex] * (_iCurCreditIndex+1));

        _oPayTable.setCreditColumn(_iCurCreditIndex);
        
        _iCurState = STATE_GAME_WAITING_FOR_BET;

        _oInterface = new CInterface(_iMoney,BET_TYPE[_iCurBetIndex]);
	    _oGameOverPanel = new CGameOver();
        
        _oGameSettings=new CGameSettings();
        _oHandEvaluator = new CHandEvaluator();
        
        _iCurIndexDeck = 0;
        _aCardDeck = new Array();
        _aCardDeck = _oGameSettings.getShuffledCardDeck();


        this.placeFakeCardForStarting();
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            s_oSoundTrack.setVolume(0.5);
        }

        var enviar= {

            //_aCurHandE : _aCurHand,
            //_aCurHandValueE : _aCurHandValue,
            //_aCardDeckE : _aCardDeck,// deberia estar en el node
            //_oCardAttachE : _oCardAttach,
            //_iCurIndexDeckE : _iCurIndexDeck,
        }
         //createcards_node(enviar); 
    };
    
    this.unload = function(){
        _oInterface.unload();
	_oGameOverPanel.unload();
        s_oStage.removeAllChildren();
    };
    
    this.resetHand = function(){
        _iCurWin = 0;
        //SHUFFLE CARD DECK EVERYTIME A NEW HAND STARTS
        _iCurIndexDeck = 0;
        _aCardDeck = new Array();
        _aCardDeck = _oGameSettings.getShuffledCardDeck();
        
        for(var i=0;i<_aCurHand.length;i++){
            _aCurHand[i].reset();
            //console.log('valor de carta'+ _aCardDeck[i].rank);
        }
        _oInterface.resetHand();
        _oPayTable.resetHand();
        
        this.checkMoney();

        
        _bBlock = false;
        _iCurState = STATE_GAME_WAITING_FOR_BET;
        
        
    };
    
     this.resetHandInit = function(){
        _iCurWin = 0;
        //SHUFFLE CARD DECK EVERYTIME A NEW HAND STARTS
        _iCurIndexDeck = 0;
        _aCardDeck = new Array();
        _aCardDeck = _oGameSettings.getShuffledCardDeck();
        
        for(var i=0;i<_aCurHand.length;i++){
            _aCurHand[i].reset();
        }
        //_oInterface.resetHand();
        //_oPayTable.resetHand();
        
        //this.checkMoney();
        
        _bBlock = false;
        _iCurState = STATE_GAME_WAITING_FOR_BET;
        
        
    };
    
    this.checkMoney = function(){
        //console.log('checkMoney');
        if(_iMoney < _iCurBet){
            //NOT ENOUGH MONEY
            _iCurBetIndex = 0;
            _iCurCreditIndex = 0;
            _iCurBet = parseFloat(BET_TYPE[_iCurBetIndex] * (_iCurCreditIndex+1));
            
            if(_iMoney < _iCurBet){
                this._gameOver();
            }else{
                _oInterface.refreshMoney(_iMoney,_iCurBet);
                _oInterface.refreshBet(BET_TYPE[_iCurBetIndex]);
            }
            
        }
    };
    
    this.changeState = function(iState){
        _iState=iState;

        switch(_iState){
            case STATE_GAME_DEALING:{
                
                break;
            }
        }
    };
    
    this.placeFakeCardForStarting = function(){
        var oSprite = s_oSpriteLibrary.getSprite('card_spritesheet');
        var oData = {   // image to use
                        images: [oSprite], 
                        // width, height & registration point of each sprite
                        frames: {width: CARD_WIDTH, height: CARD_HEIGHT, regX: CARD_WIDTH/2, regY: CARD_HEIGHT/2}, 
                        animations: {  card_1_1: [0],card_1_2:[1],card_1_3:[2],card_1_4:[3],card_1_5:[4],card_1_6:[5],card_1_7:[6],card_1_8:[7],
                                       card_1_9:[8],card_1_10:[9],card_1_J:[10],card_1_Q:[11],card_1_K:[12],
                                       card_2_1: [13],card_2_2:[14],card_2_3:[15],card_2_4:[16],card_2_5:[17],card_2_6:[18],card_2_7:[19],
                                       card_2_8:[20], card_2_9:[21],card_2_10:[22],card_2_J:[23],card_2_Q:[24],card_2_K:[25],
                                       card_3_1: [26],card_3_2:[27],card_3_3:[28],card_3_4:[29],card_3_5:[30],card_3_6:[31],card_3_7:[32],
                                       card_3_8:[33], card_3_9:[34],card_3_10:[35],card_3_J:[36],card_3_Q:[37],card_3_K:[38],
                                       card_4_1: [39],card_4_2:[40],card_4_3:[41],card_4_4:[42],card_4_5:[43],card_4_6:[44],card_4_7:[45],
                                       card_4_8:[46], card_4_9:[47],card_4_10:[48],card_4_J:[49],card_4_Q:[50],card_4_K:[51],back:[52]}
                        
        };
        
        var iX = 0;
        var iY = 0;
        for(var i=0;i<5;i++){
            var oSpriteSheet = new createjs.SpriteSheet(oData);
            var oBackCard = createSprite(oSpriteSheet,"back",CARD_WIDTH/2,CARD_HEIGHT/2,CARD_WIDTH,CARD_HEIGHT);
            oBackCard.x = iX;
            oBackCard.y = iY;
            oBackCard.shadow = new createjs.Shadow("#000000", 5, 5, 5);
            _oCardAttach.addChild(oBackCard);

            
            iX += 180;
        }
        //console.log('objeto:',_oCardAttach);
    };
    
    ////regresa del node
    this.indexnodereturn = function(indexnode){
        indexreturn = indexnode;
    };
    this.handnodereturn = function(handnode){
        var _iCurIndexDeck = 0;
        var iX = 0;
        var iY = 0;
        _aCurHand = new Array();
        _aCurHandValue = new Array(); //arreglo para evaluar mano
            for(var i=0;i<5;i++){
                _iCurIndexDeck = indexreturn[i];
                //console.log('valor primer indice'+ _iCurIndexDeck);
                //console.log('valor row 1 '+handnode[i]);
                var oCard = new CCard(iX,iY,_oCardAttach,handnode[i][0],handnode[i][1],handnode[i][2]);
                _aCurHand.push(oCard);
                //console.log('rango recivido' + _aCurHand.rank);
                //_iCurIndexDeck++;
                iX += 180;
                oCard.addEventListener(ON_CARD_SHOWN,this._onCardShown);
                oCard.addEventListener(ON_CARD_HIDE,this._onCardHide);
                //_aCurHandValue.push(oCard);
                //_iCurIndexDeck++;
                //iX += 180;
                oCard.showCard();
            }
            this.checkassignWin(_aCurHand);  
             //DECREASE MONEY
        _iMoney -= _iCurBet;
        _iMoney = parseFloat(_iMoney.toFixed(2));
        _oInterface.refreshMoney(_iMoney,_iCurBet);
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            createjs.Sound.play("card");
        }
        
        _iCurState = STATE_GAME_DEAL;
    };
    this.drawnodereturn = function(drawnode){
          var handholded = new Array();
          _aCurHandValueDraw = new Array();
            for(var p=0;p<5;p++){//ojo aqui se maneja la carta
                //var opCard = new CCard(0,0,_oCardAttach,drawnode[p][0],drawnode[p][1],drawnode[p][2]);
               // _aCurHandValueDraw.push(opCard);
                //console.log('is hold'+ _aCurHand[p].isHold());
                 //console.log('acurhandrank'+_aCurHand[p].rank);

                if(_aCurHand[p].isHold() === false){
                   //console.log(_aCurHand[p].getFotogram()+ '_aCurHand[p].getFotogram()');
                   //console.log(drawnode[p][0] + 'drawnode[p][0]');
                    _aCurHand[p].changeInfo(drawnode[p][0],drawnode[p][1],drawnode[p][2]);
                    _aCurHand[p].showCard();
                    _iCurIndexDeck++;              
                }else{
                   _aCurHand[p].setHold(false);
                }           
            }
           /* var enviar = {handholdedE:handholded,}
            console.log('handholded'+handholded);
            cambiarinfo_node(enviar);
        //}*/
        _checkiCurWinAD = s_oPayTableSettings.getWin(_iCurCreditIndex,_oHandEvaluator.evaluate(_aCurHand)) * _iCurBet;
         //console.log('checkiwin '+_checkiCurWinAD);
        //console.log('testeo sale del while' + _oHandEvaluator.evaluate(_aCurHandValueDraw));
        /////////fin testeo
        _iCurState = STATE_GAME_DRAW;
        //_aCurHand = _aCurHandValueDraw;

        /*for(var i=0;i<5;i++){//ojo aqui se maneja la carta
            if(_aCurHand[i].isHold() === false){
                //_aCurHand[i].changeInfo(_aCardDeck[_iCurIndexDeck].fotogram,_aCardDeck[_iCurIndexDeck].rank,_aCardDeck[_iCurIndexDeck].suit);
                _aCurHand[i].showCard();
                //_iCurIndexDeck++;              
            }else{
                _aCurHand[i].setHold(false);
            }           
        }*/
        
        //console.log('despues de reacomodar lamano'+_oHandEvaluator.evaluate(_aCurHand));           
        //_checkiCurWinAD = s_oPayTableSettings.getWin(_iCurCreditIndex,_oHandEvaluator.evaluate(_aCurHand)) * _iCurBet;
        //console.log('checkiwin'+_checkiCurWinAD);
        
    };
    ////fin regresa del node 
    this.dealCards = function(){

        if(_bBlock){
            return;
        }
        if(_iMoney <= 0){
            return;
        }
        
        _bBlock = true;
        
        _oCardAttach.removeAllChildren();
      
        var enviar= {
            bet_typeE : BET_TYPE,
            combo_prizesE : COMBO_PRIZES ,
            total_moneyE : TOTAL_MONEY,
            automatic_rechargeE : AUTOMATIC_RECHARGE,
            _iCurCreditIndexE : _iCurCreditIndex,
            _iCurBetE : _iCurBet,


            //_aCurHandValueE : _aCurHandValue,
            //_aCardDeckE : _aCardDeck,// deberia estar en el node
            //_oCardAttachE : _oCardAttach,
            //_iCurIndexDeckE : _iCurIndexDeck,
        }
        checkhandeal_node(enviar);
        /*this.cehckhandeal();
        //do{
            console.log(_oHandEvaluator.evaluate(_aCurHandValue));
            console.log(JACKS_OR_BETTER);
        while(_oHandEvaluator.evaluate(_aCurHandValue) !== JACKS_OR_BETTER){
            
            console.log("resethand deal cards");
            _oCardAttach.removeAllChildren();
            this.resetHandInit();
            this.cehckhandeal();
        }
                //_oHandEvaluator.evaluate(_aCurHandValue);
         var enviar= {
            bet_typeE : BET_TYPE,
            combo_prizesE : COMBO_PRIZES ,
            total_moneyE : TOTAL_MONEY,
            automatic_rechargeE : AUTOMATIC_RECHARGE,
            _iCurCreditIndexE : _iCurCreditIndex,
            _iCurBetE : _iCurBet,


            //_aCurHandValueE : _aCurHandValue,
            //_aCardDeckE : _aCardDeck,// deberia estar en el node
            //_oCardAttachE : _oCardAttach,
            //_iCurIndexDeckE : _iCurIndexDeck,
        }
        checkhandeal_node(enviar);
        
        console.log("sale del while");
           /////
        //var iX = 0;
        //var iY = 0;
        _aCurHand = new Array();
        //_aCurHandValue = new Array(); //arreglo para evaluar mano
            for(var n=0;n<5;n++){
                var oCard = _aCurHandValue[n];
                oCard.addEventListener(ON_CARD_SHOWN,this._onCardShown);
                oCard.addEventListener(ON_CARD_HIDE,this._onCardHide);
                //_aCurHandValue.push(oCard);
                _aCurHand.push(oCard);
                //_iCurIndexDeck++;
                //iX += 180;
                oCard.showCard();
                //console.log('acardfotogram'+_aCardDeck[_iCurIndexDeck].fotogram+ ' - '+ 'acardked'+_aCardDeck[_iCurIndexDeck].rank);
            }
        
        //DECREASE MONEY
        _iMoney -= _iCurBet;
        _iMoney = parseFloat(_iMoney.toFixed(2));
        _oInterface.refreshMoney(_iMoney,_iCurBet);
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            createjs.Sound.play("card");
        }
        
        _iCurState = STATE_GAME_DEAL;*/
    };
    /*this.cehckhandeal = function(){//al node
        var iX = 0;
        var iY = 0;
        _aCurHand = new Array();
        _aCurHandValue = new Array(); //arreglo para evaluar mano
            for(var i=0;i<5;i++){
                var oCard = new CCard(iX,iY,_oCardAttach,_aCardDeck[_iCurIndexDeck].fotogram,_aCardDeck[_iCurIndexDeck].rank,_aCardDeck[_iCurIndexDeck].suit);
                _aCurHandValue.push(oCard);
                _iCurIndexDeck++;
                iX += 180;
            }

        this.checkassignWin(_aCurHandValue);        
    };*/
    this.drawCards = function(){
        z=0;
        if(_bBlock){
            return;
        }
        
        _bBlock = true;
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            createjs.Sound.play("card");
        }
        
         iNumHold = _aCurHand.length;
        for(var i=0;i<_aCurHand.length;i++){
            if(_aCurHand[i].isHold() === false){
                _aCurHand[i].hideCard();
                iNumHold--;
            }
        }
        
        if(iNumHold === _aCurHand.length){
            _iCurState = STATE_GAME_DRAW;
            this._onCardShown();
        } 
    };
    
     this.assignWin = function(iRet){
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
                createjs.Sound.play("win");
        }

        var aSortedHand = _oHandEvaluator.getSortedHand();
        for(var i=0;i<_aCurHand.length;i++){
            for(var j=0;j<aSortedHand.length;j++){
                if(aSortedHand[j].rank === _aCurHand[i].getRank() && aSortedHand[j].suit === _aCurHand[i].getSuit()){
                    _aCurHand[i].highlight();
                    break;
                }
            }
        }
        //console.log('_iCurCreditIndex'+_iCurCreditIndex);
        //console.log('iRet'+iRet);
        //console.log('_iCurBet'+_iCurBet);
        _oPayTable.showWinAnim(_iCurCreditIndex,iRet);
        _iCurWin = s_oPayTableSettings.getWin(_iCurCreditIndex,iRet) * _iCurBet;
        
        //console.log('iwin antes de sumar'+_iCurWin);
        //console.log('_iMoney antes de sumar'+_iMoney);
       // console.log('suma igual'+ (_iCurWin +_iMoney) )
        
        _iMoney += _iCurWin;
        _iMoney = parseFloat(_iMoney.toFixed(2));
        _oInterface.refreshWin(_iCurWin);
        _oInterface.refreshMoney(_iMoney,_iCurBet);
     };

     
    this.recharge = function(){
        _iMoney = TOTAL_MONEY;
        _oPayTable.setCreditColumn(_iCurCreditIndex);
        
        
        this.checkMoney();
        _oInterface.refreshMoney(_iMoney,_iCurBet);
        _oInterface.refreshBet(BET_TYPE[_iCurBetIndex]);
        
        _oGameOverPanel.hide(); 
    };
     
    this._gameOver = function(){
        _oGameOverPanel.show();
    };
    
    this.onCardSelected = function(oCard){
        if(_iCurState !== STATE_GAME_CHOOSE_HOLD){
            return;
        }
        
        oCard.toggleHold();
    };
    
    this._onCardShown = function(){
        if(_iCurState === STATE_GAME_CHOOSE_HOLD){
            return;
        }
        
        switch(_iCurState){
            case STATE_GAME_DEAL:{
                    _iCurState = STATE_GAME_CHOOSE_HOLD;
                    _oInterface.setState(_iCurState);
                    break;
            }
            case STATE_GAME_DRAW:{
                    var iRet = _oHandEvaluator.evaluate(_aCurHand);
                    _oInterface.setState(_iCurState);
                    if(iRet !== HIGH_CARD){
                        s_oGame.assignWin(iRet);
                    }else{
                        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
                                createjs.Sound.play("lose");
                        }
                        _oInterface.showLosePanel();
                    }
                    
                    $(s_oMain).trigger("end_hand",[_iMoney,_iCurWin]);
                    
                    _iCurState = STATE_GAME_EVALUATE;
                    break;
            } 
            case STATE_GAME_EVALUATE:{
                _oInterface.setState(_iCurState);
                break;
            }
        }
        
        _bBlock = false;
    };
    
    this._onCardHide = function(){
         z++;
        if(_iCurState === STATE_GAME_DRAW){
            return;
        }
        
        //console.log('oncardhide');
        _aCurHandValueDraw = _aCurHand;

        /////////testeo no deja llamar funciones afuera
        //console.log('testeo init' + _oHandEvaluator.evaluate(_aCurHandValueDraw));
        _checkiCurWinAD = s_oPayTableSettings.getWin(_iCurCreditIndex,_oHandEvaluator.evaluate(_aCurHand)) * _iCurBet;
        // console.log('checkiwin antes del while'+_checkiCurWinAD);
        //console.log('testeo antes del while 2 pares' + TWO_PAIR );

        //while(_oHandEvaluator.evaluate(_aCurHandValueDraw)!==TWO_PAIR){//aqui chequear el iwin 

        //_checkiCurWinAD = s_oPayTableSettings.getWin(_iCurCreditIndex,_oHandEvaluator.evaluate(_aCurHand)) * _iCurBet;
         //console.log('checkiwin dentro del while'+_checkiCurWinAD);
         var handholded = new Array();
            for(var p=0;p<5;p++){//ojo aqui se maneja la carta
                //console.log('is hold'+ _aCurHand[p].isHold());
                // console.log('acurhandrank'+_aCurHand[p].getRank());
                //  console.log('acurhandrank'+_aCurHand[p].getFotogram());
                //   console.log('acurhandrank'+_aCurHand[p].getSuit());

                if(_aCurHand[p].isHold() === false){
                    var enviar={
                        fotogramE:_aCurHand[p].getFotogram(),
                        rankE:_aCurHand[p].getRank(),
                        suitE:_aCurHand[p].getSuit(),
                    }
                    handholded.push(enviar);
                    //_aCurHand[p].changeInfo(_aCardDeck[_iCurIndexDeck].fotogram,_aCardDeck[_iCurIndexDeck].rank,_aCardDeck[_iCurIndexDeck].suit);
                    //_aCurHand[p].showCard();
                    //_iCurIndexDeck++;              
                }//else{
                 //  _aCurHand[p].setHold(false);
                //}           
            }
            //console.log('---z---'+z+'--iNumHold-- '+iNumHold);
        if(z==5-iNumHold){
            var enviar = {handholdedE:handholded,_iCurBetE : _iCurBet,_iCurIndexDeckE:_iCurIndexDeck,}
           // console.log('handholded'+handholded);
            cambiarinfo_node(enviar);

        }
        //}
       /* _checkiCurWinAD = s_oPayTableSettings.getWin(_iCurCreditIndex,_oHandEvaluator.evaluate(_aCurHand)) * _iCurBet;
         console.log('checkiwin despues del while'+_checkiCurWinAD);
        console.log('testeo sale del while' + _oHandEvaluator.evaluate(_aCurHandValueDraw));
        /////////fin testeo
        _iCurState = STATE_GAME_DRAW;
        _aCurHand = _aCurHandValueDraw;

        /*for(var i=0;i<5;i++){//ojo aqui se maneja la carta
            if(_aCurHand[i].isHold() === false){
                //_aCurHand[i].changeInfo(_aCardDeck[_iCurIndexDeck].fotogram,_aCardDeck[_iCurIndexDeck].rank,_aCardDeck[_iCurIndexDeck].suit);
                _aCurHand[i].showCard();
                //_iCurIndexDeck++;              
            }else{
                _aCurHand[i].setHold(false);
            }           
        }*/
        
        /*console.log('despues de reacomodar lamano'+_oHandEvaluator.evaluate(_aCurHand));           
        _checkiCurWinAD = s_oPayTableSettings.getWin(_iCurCreditIndex,_oHandEvaluator.evaluate(_aCurHand)) * _iCurBet;
        console.log('checkiwin'+_checkiCurWinAD);*/
        
    };
/////
    this.hola =function(){
      //  console.log('hola');
    };
    /*this._CardHideDrawValue = function(){
       _aCurHandValueDraw = new Array();
        _aCurHandValueDraw = _aCurHand;

        for(var i=0;i<5;i++){//ojo aqui se maneja la carta
            if(_aCurHandValueDraw[i].isHold() === false){
                _aCurHandValueDraw[i].changeInfo(_aCardDeck[_iCurIndexDeck].fotogram,_aCardDeck[_iCurIndexDeck].rank,_aCardDeck[_iCurIndexDeck].suit);
                _aCurHandValueDraw[i].showCard();
                _iCurIndexDeck++;              
            }else{
                _aCurHandValueDraw[i].setHold(false);
            }           
        }

        console.log('despues de reacomodar lamano test'+_oHandEvaluator.evaluate(_aCurHandValueDraw));
        _checkiCurWinAD = s_oPayTableSettings.getWin(_iCurCreditIndex,_oHandEvaluator.evaluate(_aCurHandValueDraw)) * _iCurBet;
        
        console.log('checkiwin test'+_checkiCurWinAD);
        
    };*/
/////

     //////////////
       this.checkassignWin = function(hand){
       // console.log('verifico q tiene' + hand);
        //console.log('el indice'+_iCurIndexDeck);
       // console.log('cur credit index'+ _iCurCreditIndex);
       // console.log(_oHandEvaluator.evaluate(hand));
        _checkiCurWin=0;
        _checkiCurWin = s_oPayTableSettings.getWin(_iCurCreditIndex,_oHandEvaluator.evaluate(hand)) * _iCurBet;
        
        //console.log('checkiwin'+_checkiCurWin);
          
     };
     //////////////
    this._onButDealRelease = function(){
        switch(_iCurState){
            case STATE_GAME_WAITING_FOR_BET:{
                    this.dealCards();
                    break;
            }
            case STATE_GAME_CHOOSE_HOLD:{
                    this.drawCards();
                    break;
            }
            case STATE_GAME_EVALUATE:{
                    this.resetHand();
                    this.dealCards();
                    break;
            }
        }
    };
    
    this._onButLeftRelease = function(){
        if(_iCurBetIndex === 0 || _bBlock){
            return;
        }
        
        _iCurBetIndex--;
        var iNewBet= parseFloat(BET_TYPE[_iCurBetIndex] * (_iCurCreditIndex+1));
        if(_iMoney < iNewBet){
            return;
        }
        
        _iCurBet = iNewBet;
        _oInterface.refreshMoney(_iMoney,_iCurBet);
        _oInterface.refreshBet(BET_TYPE[_iCurBetIndex]);
    };
    
    this._onButRightRelease = function(){
        if(_iCurBetIndex === BET_TYPE.length-1 || _bBlock){
            return;
        }
        
        _iCurBetIndex++;
        var iNewBet= parseFloat(BET_TYPE[_iCurBetIndex] * (_iCurCreditIndex+1));
        if(_iMoney < iNewBet){
            return;
        }
        
        _iCurBet = iNewBet;
        _oInterface.refreshMoney(_iMoney,_iCurBet);
        _oInterface.refreshBet(BET_TYPE[_iCurBetIndex]);
    };
    
    this._onButBetOneRelease = function(){
        if(_bBlock){
            return;
        }
        
        _iCurCreditIndex++;
        if(_iCurCreditIndex === NUM_BETS){
            _iCurCreditIndex = 0;
        }
        
        var iNewBet= parseFloat(BET_TYPE[_iCurBetIndex] * (_iCurCreditIndex+1));
        if(_iMoney < iNewBet){
            return;
        }
        
        _iCurBet = iNewBet;
        _oInterface.refreshMoney(_iMoney,_iCurBet);
        
        _oPayTable.setCreditColumn(_iCurCreditIndex);
    };
    
    this._onButBetMaxRelease = function(){
        if(_bBlock || _iCurState !== STATE_GAME_EVALUATE){
            return;
        }
	_bBlock = true;
		
        _iCurCreditIndex = NUM_BETS-1;
        var iNewBet= parseFloat(BET_TYPE[_iCurBetIndex] * (_iCurCreditIndex+1));
        if(_iMoney < iNewBet){
            this._gameOver();
            return;
        }
        
        _iCurBet = iNewBet;
        _oInterface.refreshMoney(_iMoney,_iCurBet);
        _oPayTable.setCreditColumn(_iCurCreditIndex);
        
	    this.resetHand();
        this.dealCards();
    };
    
    this.onExit = function(){
        this.unload();

        s_oMain.gotoMenu();
        $(s_oMain).trigger("restart");
    };
    
    
    
    this.update = function(){

    };

    s_oGame = this;
    
    BET_TYPE = oData.bets;
    COMBO_PRIZES = oData.combo_prizes;
    TOTAL_MONEY = oData.money;
    AUTOMATIC_RECHARGE = oData.recharge;
    
    this._init();
}

var s_oGame;
 var s_oPayTableSettings;