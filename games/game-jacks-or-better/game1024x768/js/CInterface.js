function CInterface(iMoney,iBet){

    var _oButExit;
    var _oArrowLeft;
    var _oArrowRight;
    var _oBetOneBut;
    var _oBetMaxBut;
    var _oDealBut;
    var _oAudioToggle;
    var _oMoneyText;
    var _oWinText;
    var _oBetText;
    var _oTotBetText;
    var _oLosePanel;
    
    this._init = function(iMoney,iBet){

        var oSprite = s_oSpriteLibrary.getSprite('but_exit');
        _oButExit = new CGfxButton(CANVAS_WIDTH - (oSprite.width/2) - 15,(oSprite.height/2) + 15,oSprite,s_oStage);
        _oButExit.addEventListener(ON_MOUSE_UP, this._onExit, this);
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            _oAudioToggle = new CToggle(_oButExit.getX() - oSprite.width,(oSprite.height/2) + 15,s_oSpriteLibrary.getSprite('audio_icon'));
            _oAudioToggle.addEventListener(ON_MOUSE_UP, this._onAudioToggle, this);
        }
        
        var oDisplayWin = createBitmap(s_oSpriteLibrary.getSprite('display_bg'));
        oDisplayWin.x = 39;
        oDisplayWin.y = 25;
        s_oStage.addChild(oDisplayWin);
        
        var oWinTextBg = new createjs.Text(TEXT_WIN,"21px OpenSans-BoldItalic", "#fff");
        oWinTextBg.x = 50;
        oWinTextBg.y = 32;
        oWinTextBg.textAlign = "center";
        oWinTextBg.textBaseline = "middle";
        s_oStage.addChild(oWinTextBg);
        
        var oDisplayBet = createBitmap(s_oSpriteLibrary.getSprite('display_bg'));
        oDisplayBet.x = 39;
        oDisplayBet.y = 93;
        s_oStage.addChild(oDisplayBet);
        
        var oBetTextBg = new createjs.Text(TEXT_BET,"21px OpenSans-BoldItalic", "#fff");
        oBetTextBg.x = 50;
        oBetTextBg.y = 100;
        oBetTextBg.textAlign = "center";
        oBetTextBg.textBaseline = "middle";
        s_oStage.addChild(oBetTextBg);
        
        var oDisplayMoney = createBitmap(s_oSpriteLibrary.getSprite('display_bg'));
        oDisplayMoney.x = 39;
        oDisplayMoney.y = 687;
        s_oStage.addChild(oDisplayMoney);
        
        var oMoneyTextBg = new createjs.Text(TEXT_MONEY,"21px OpenSans-BoldItalic", "#fff");
        oMoneyTextBg.x = 50;
        oMoneyTextBg.y = 695;
        oMoneyTextBg.textAlign = "center";
        oMoneyTextBg.textBaseline = "middle";
        s_oStage.addChild(oMoneyTextBg);
	
	_oMoneyText = new createjs.Text(iMoney.toFixed(2)+TEXT_CURRENCY,"bold 29px Digital-7", "#ffde00");
        _oMoneyText.x = 150;
        _oMoneyText.y = CANVAS_HEIGHT - 65;
        _oMoneyText.textAlign = "center";
        s_oStage.addChild(_oMoneyText);
        
        _oBetText = new createjs.Text("0"+TEXT_CURRENCY,"bold 29px Digital-7", "#ffde00");
        _oBetText.x = 150;
        _oBetText.y = 110;
        _oBetText.textAlign = "center";
        s_oStage.addChild(_oBetText);
        
        _oWinText = new createjs.Text("0"+TEXT_CURRENCY,"bold 29px Digital-7", "#ffde00");
        _oWinText.x = 150;
        _oWinText.y = 40;
        _oWinText.textAlign = "center";
        s_oStage.addChild(_oWinText);
        
        var oBigDisplay = createBitmap(s_oSpriteLibrary.getSprite('big_display'));
        oBigDisplay.x = 348;
        oBigDisplay.y = 686;
        s_oStage.addChild(oBigDisplay);
        
        _oTotBetText = new createjs.Text(iBet.toFixed(2)+TEXT_CURRENCY,"bold 40px Digital-7", "#ffde00");
        _oTotBetText.x = 414;
        _oTotBetText.y = 700;
        _oTotBetText.textAlign = "center";
        s_oStage.addChild(_oTotBetText);

        var oLogo = createBitmap(s_oSpriteLibrary.getSprite('logo_game'));
        oLogo.x = 348;
        oLogo.y = 17;
        s_oStage.addChild(oLogo);
        
        var oSprite = s_oSpriteLibrary.getSprite('but_left');
        _oArrowLeft = new CGfxButton(315,722,oSprite,s_oStage);
        _oArrowLeft.addEventListener(ON_MOUSE_UP, this._onButLeftRelease, this);

        oSprite = s_oSpriteLibrary.getSprite('but_right');
        _oArrowRight = new CGfxButton(515,722,oSprite,s_oStage);
        _oArrowRight.addEventListener(ON_MOUSE_UP, this._onButRightRelease, this);
        
        oSprite = s_oSpriteLibrary.getSprite('but_game_bg');
        _oBetOneBut = new CTextButton(624,716,oSprite,TEXT_BET_ONE,"OpenSans-BoldItalic","#ffffff",23,s_oStage);
        _oBetOneBut.addEventListener(ON_MOUSE_UP, this._onButBetOneRelease, this);
        
        _oBetMaxBut = new CTextButton(774,716,oSprite,TEXT_MAX_BET,"OpenSans-BoldItalic","#ffffff",23,s_oStage);
        _oBetMaxBut.addEventListener(ON_MOUSE_UP, this._onButBetMaxRelease, this);
        
        _oDealBut = new CTextButton(924,716,oSprite,TEXT_DEAL,"OpenSans-BoldItalic","#ffffff",30,s_oStage);
        _oDealBut.addEventListener(ON_MOUSE_UP, this._onButDealRelease, this);
        
        _oLosePanel = new createjs.Container();
        _oLosePanel.visible = false;
        _oLosePanel.x = 260;
        _oLosePanel.y = 500;
        s_oStage.addChild(_oLosePanel);
        
        var oFade = new createjs.Shape();
        oFade.graphics.beginFill("rgba(0,0,0,0.7)").drawRect(0,0,500,100);
        _oLosePanel.addChild(oFade);
        
        var oText = new createjs.Text(TEXT_NO_WIN,"50px OpenSans-BoldItalic", "#fff");
        oText.x = 250;
        oText.y = 30;
        oText.textAlign = "center";
        _oLosePanel.addChild(oText);
    };
    
    this.unload = function(){
        _oButExit.unload();
        _oArrowLeft.unload();
        _oArrowRight.unload();
        _oBetOneBut.unload();
        _oBetMaxBut.unload();
        _oDealBut.unload();

        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            _oAudioToggle.unload();
            _oAudioToggle = null;
        }
    };
    
    this.setState = function(iState){
        switch(iState){
            case STATE_GAME_CHOOSE_HOLD:{
                _oDealBut.changeText(TEXT_DRAW);
                break;
            }
            case STATE_GAME_EVALUATE:{
                _oDealBut.changeText(TEXT_DEAL);
                break;
            }
        }
    };
    
    this.resetHand = function(){
        this.refreshWin(0);
        _oLosePanel.visible = false;
    };
    
    this.refreshMoney = function(iMoney,iBet){
        alert(iMoney);
        _oMoneyText.text = iMoney.toFixed(2)+TEXT_CURRENCY;
        _oBetText.text = iBet.toFixed(2)+TEXT_CURRENCY;
    };
    
    this.refreshWin = function(iWin){
        _oWinText.text = iWin.toFixed(2)+TEXT_CURRENCY;
    };
    
    this.refreshBet = function(iBet){
        _oTotBetText.text = iBet.toFixed(2)+TEXT_CURRENCY;
    };
    
    this.showLosePanel = function(){
        _oLosePanel.visible = true;
    };

    this._onButLeftRelease = function(){
        s_oGame._onButLeftRelease();
    };
    
    this._onButRightRelease = function(){
        s_oGame._onButRightRelease();
    };
    
    this._onButBetOneRelease = function(){
        s_oGame._onButBetOneRelease();
    };
    
    this._onButBetMaxRelease = function(){
        s_oGame._onButBetMaxRelease();
    };
    
    this._onButDealRelease = function(){
        s_oGame._onButDealRelease();
    };
    
    this._onExit = function(){
        s_oGame.onExit();  
    };
    
    this._onAudioToggle = function(){
        createjs.Sound.setMute(!s_bAudioActive);
    };
    
    s_oInterface = this;
    
    this._init(iMoney,iBet);
    
    return this;
}

var s_oInterface;