function CInterface(iCurBet,iTotBet,iMoney){
    var _aLinesBut;
    var _aPayline;
    var _oButExit;
    var _oSpinBut;
    var _oInfoBut;
    var _oAddLineBut;
    var _oAudioToggle;
    var _oBetCoinBut;
    var _oMaxBetBut;
    
    var _oTimeTextBack;
    var _oTimeText;
    var _oCoinText;
    var _oMoneyText;
    var _oTotalBetText;
    var _oNumLinesText;
    var _oWinText;
    
    this._init = function(iCurBet,iTotBet,iMoney){
        
        var oSprite = s_oSpriteLibrary.getSprite('but_exit');
        _oButExit = new CGfxButton(CANVAS_WIDTH - (oSprite.width/2) - 20,(oSprite.height/2) + 20,oSprite,true);
        _oButExit.addEventListener(ON_MOUSE_UP, this._onExit, this);
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            _oAudioToggle = new CToggle(_oButExit.getX() - oSprite.width,(oSprite.height/2) + 20,s_oSpriteLibrary.getSprite('audio_icon'));
            _oAudioToggle.addEventListener(ON_MOUSE_UP, this._onAudioToggle, this);
        }
        
        oSprite = s_oSpriteLibrary.getSprite('spin_but');
        _oSpinBut = new CTextButton(806 + (oSprite.width/2),642 + (oSprite.height/2),oSprite,TEXT_SPIN,"Arial","#ffffff",30);  
        _oSpinBut.addEventListener(ON_MOUSE_UP, this._onSpin, this);
        
        oSprite = s_oSpriteLibrary.getSprite('info_but');
        _oInfoBut = new CTextButton(28 + (oSprite.width/2),642 + (oSprite.height/2),oSprite,TEXT_INFO,"Arial","#ffffff",30);        
        _oInfoBut.addEventListener(ON_MOUSE_UP, this._onInfo, this);
        
        oSprite = s_oSpriteLibrary.getSprite('but_lines_bg');
        _oAddLineBut = new CTextButton(188 + (oSprite.width/2),642 + (oSprite.height/2),oSprite,TEXT_LINES,"Arial","#ffffff",30);
        _oAddLineBut.addEventListener(ON_MOUSE_UP, this._onAddLine, this);
        
        oSprite = s_oSpriteLibrary.getSprite('coin_but');
        _oBetCoinBut = new CTextButton(380 + (oSprite.width/2),642 + (oSprite.height/2),oSprite,TEXT_COIN,"Arial","#ffffff",30);
        _oBetCoinBut.addEventListener(ON_MOUSE_UP, this._onBet, this);
        
        oSprite = s_oSpriteLibrary.getSprite('but_maxbet_bg');
        _oMaxBetBut = new CTextButton(572 + (oSprite.width/2),642 + (oSprite.height/2),oSprite,TEXT_MAX_BET,"Arial","#ffffff",30);
        _oMaxBetBut.addEventListener(ON_MOUSE_UP, this._onMaxBet, this);

        _oTimeTextBack = new createjs.Text("","bold 20px Arial", "#000000");
        _oTimeTextBack.x = (CANVAS_WIDTH - 90);
        _oTimeTextBack.y = CANVAS_HEIGHT - 24;
        _oTimeTextBack.textAlign = "center";
        s_oStage.addChild(_oTimeTextBack);
        
        _oTimeText = new createjs.Text("","bold 20px Arial", "#ffffff");
        _oTimeText.x = (CANVAS_WIDTH - 89);
        _oTimeText.y = CANVAS_HEIGHT - 25;
        _oTimeText.textAlign = "center";
        s_oStage.addChild(_oTimeText);
		
	_oMoneyText = new createjs.Text(TEXT_MONEY +"\n"+iMoney.toFixed(2),"bold 30px Arial", "#ffde00");
        _oMoneyText.x = 140;
        _oMoneyText.y = 50;
        _oMoneyText.textAlign = "center";
        s_oStage.addChild(_oMoneyText);
        
        _oNumLinesText = new createjs.Text(NUM_PAYLINES ,"bold 30px Arial", "#ffffff");
        _oNumLinesText.x =  284;
        _oNumLinesText.y = CANVAS_HEIGHT - 130;
        _oNumLinesText.textAlign = "center";
        _oNumLinesText.textBaseline = "alphabetic";
        s_oStage.addChild(_oNumLinesText);
        
        _oCoinText = new createjs.Text(iCurBet.toFixed(2) ,"bold 30px Arial", "#ffffff");
        _oCoinText.x =  480;
        _oCoinText.y = CANVAS_HEIGHT - 130;
        _oCoinText.textAlign = "center";
        _oCoinText.textBaseline = "alphabetic";
        s_oStage.addChild(_oCoinText);

        _oTotalBetText = new createjs.Text(TEXT_BET +" "+iTotBet.toFixed(2),"bold 30px Arial", "#ffffff");
        _oTotalBetText.x = 690;
        _oTotalBetText.y = CANVAS_HEIGHT - 130;
        _oTotalBetText.textAlign = "center";
        _oTotalBetText.textBaseline = "alphabetic";
        s_oStage.addChild(_oTotalBetText);
        
        _oWinText = new createjs.Text("","bold 26px Arial", "#ffde00");
        _oWinText.x = 900;
        _oWinText.y = CANVAS_HEIGHT - 133;
        _oWinText.textAlign = "center";
        _oWinText.textBaseline = "alphabetic";
        s_oStage.addChild(_oWinText);
        
        oSprite = s_oSpriteLibrary.getSprite('bet_but');
        _aLinesBut = new Array();
        
        var iHalfButHeight = oSprite.height/2;
        var iPadding = 11;
        var iSpriteHeight = 32;
        var iYOffset = 148 + iHalfButHeight;
        
        
        //LINE 4
        var oBut = new CBetBut( 81 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,4);
        _aLinesBut[3] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
                
        //LINE 2
        oBut = new CBetBut( 81 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,2);
        _aLinesBut[1] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
        
        //LINE 20
        oBut = new CBetBut( 81 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,20);
        _aLinesBut[19] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
        
        //LINE 16
        oBut = new CBetBut( 81 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,16);
        _aLinesBut[15] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
        
        //LINE 10
        oBut = new CBetBut( 81 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,10);
        _aLinesBut[9] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
        
        //LINE 1
        oBut = new CBetBut( 81 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,1);
        _aLinesBut[0] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding +1;
        
        //LINE 11
        oBut = new CBetBut( 81 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,11);
        _aLinesBut[10] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding ;
        
        //LINE 17
        oBut = new CBetBut( 81 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,17);
        _aLinesBut[16] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
        
        //LINE 3
        oBut = new CBetBut( 81 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,3);
        _aLinesBut[2] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
        
        //LINE 5
        oBut = new CBetBut( 81 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,5);
        _aLinesBut[4] = oBut;
        
        iYOffset = 148 + iHalfButHeight;
        
        //LINE 14
        var oBut = new CBetBut( 892 + oSprite.width/2, iYOffset,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,14);
        _aLinesBut[13] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
        
        //LINE 12
        oBut = new CBetBut( 892 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,12);
        _aLinesBut[11] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
        
        //LINE 9
        oBut = new CBetBut( 892 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,9);
        _aLinesBut[8] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
        
        //LINE 18
        oBut = new CBetBut( 892 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,18);
        _aLinesBut[17] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
        
        //LINE 6;
        oBut = new CBetBut( 892 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,6);
        _aLinesBut[5] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding+1;
        
        //LINE 7;
        oBut = new CBetBut( 892 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,7);
        _aLinesBut[6] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
        
        //LINE 19;
        oBut = new CBetBut( 892 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,19);
        _aLinesBut[18] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
        
        //LINE 8
        oBut = new CBetBut( 892 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,8);
        _aLinesBut[7] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
        
        //LINE 13
        oBut = new CBetBut( 892 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,13);
        _aLinesBut[12] = oBut;
        
        iYOffset+= iSpriteHeight + iPadding;
        
        //LINE 15
        oBut = new CBetBut( 892 + oSprite.width/2, iYOffset,oSprite,true);
        oBut.addEventListenerWithParams(ON_MOUSE_UP, this._onBetLineClicked, this,15);
        _aLinesBut[14] = oBut;
        
        _aPayline = new Array();
        for(var k = 0;k<NUM_PAYLINES;k++){
            var oBmp = createBitmap(s_oSpriteLibrary.getSprite('payline_'+(k+1) ));
            oBmp.x = 0;
            oBmp.y = 0;
            oBmp.visible = false;
            s_oStage.addChild(oBmp);
            _aPayline[k] = oBmp;
        }
        
        
    };
    
    this.unload = function(){
        _oButExit.unload();
        _oButExit = null;
        _oSpinBut.unload();
        _oSpinBut = null;
        _oInfoBut.unload();
        _oInfoBut = null;
        _oAddLineBut.unload();
        _oAddLineBut = null;
        _oBetCoinBut.unload();
        _oBetCoinBut = null;
        _oMaxBetBut.unload();
        _oMaxBetBut = null;
        
        if(DISABLE_SOUND_MOBILE === false){
            _oAudioToggle.unload();
            _oAudioToggle = null;
        }
        
        s_oStage.removeChild(_oTimeText);
        s_oStage.removeChild(_oTimeTextBack);
        s_oStage.removeChild(_oTotalBetText);
        s_oStage.removeChild(_oNumLinesText);
        s_oStage.removeChild(_oMoneyText);
        s_oStage.removeChild(_oCoinText);
        s_oStage.removeChild(_oWinText);

        for(var i=0;i<NUM_PAYLINES;i++){
            _aLinesBut[i].unload();
            s_oStage.removeChild(_aPayline[i]);
        }
    };
    
    this.refreshTime = function(iTime){
        var szTime = formatTime(iTime);
        _oTimeText.text =  szTime;
        _oTimeTextBack.text = szTime;
    };

    this.refreshMoney = function(iMoney){

        console.log('refresca la moneda'+ ' ' +iMoney);
        _oMoneyText.text = TEXT_MONEY +"\n"+iMoney.toFixed(2);
    };
    
    this.refreshBet = function(iBet){
        _oCoinText.text = iBet.toFixed(2);
    };
    
    this.refreshTotalBet = function(iTotBet){
        _oTotalBetText.text = TEXT_BET +" "+iTotBet.toFixed(2);
    };
    
    this.refreshNumLines = function(iLines){
        _oNumLinesText.text = iLines;
        
        for(var i=0;i<NUM_PAYLINES;i++){
            if(i<iLines){
                _aLinesBut[i].setOn();
                _aPayline[i].visible = true;
            }else{
                _aLinesBut[i].setOff();
            }
        }
        
        setTimeout(function(){for(var i=0;i<NUM_PAYLINES;i++){
            _aPayline[i].visible = false;
        }},1000);
    };
    
    this.resetWin = function(){
        _oWinText.text = " ";
    };
    
    this.refreshWinText = function(iWin){
        _oWinText.text = TEXT_WIN + " "+iWin.toFixed(2);
    };
    
    this.showLine = function(iLine){
        _aPayline[iLine-1].visible = true;
    };
    
    this.hideLine = function(iLine){
        _aPayline[iLine-1].visible = false;
    };
    
    this.hideAllLines = function(){
        for(var i=0;i<NUM_PAYLINES;i++){
            _aPayline[i].visible = false;
        }
    };
    
    this.disableBetBut = function(bDisable){
        for(var i=0;i<NUM_PAYLINES;i++){
            _aLinesBut[i].disable(bDisable);
        }
    };
    
    this.enableGuiButtons = function(){
        _oSpinBut.enable();
        _oMaxBetBut.enable();
        _oBetCoinBut.enable();
        _oAddLineBut.enable();
        _oInfoBut.enable();
    };
	
	this.enableSpin = function(){
		_oSpinBut.enable();
		_oMaxBetBut.enable();
	};
	
	this.disableSpin = function(){
		_oSpinBut.disable();
		_oMaxBetBut.disable();
	};
    
    this.disableGuiButtons = function(){
        _oSpinBut.disable();
        _oMaxBetBut.disable();
        _oBetCoinBut.disable();
        _oAddLineBut.disable();
        _oInfoBut.disable();
    };
    
    this._onBetLineClicked = function(iLine){
        this.refreshNumLines(iLine);
        
        s_oGame.activateLines(iLine);
    };
    
    this._onExit = function(){
        s_oGame.onExit();  
    };
    
    this._onSpin = function(){
        s_oGame.onSpin();
    };
    
    this._onAddLine = function(){
        s_oGame.addLine();
    };
    
    this._onInfo = function(){
        s_oGame.onInfoClicked();
    };
    
    this._onBet = function(){
        s_oGame.changeCoinBet();
    };
    
    this._onMaxBet = function(){
        s_oGame.onMaxBet();
    };
    
    this._onAudioToggle = function(){
        createjs.Sound.setMute(!s_bAudioActive);
    };
    
    s_oInterface = this;
    
    this._init(iCurBet,iTotBet,iMoney);
    
    return this;
}

var s_oInterface;