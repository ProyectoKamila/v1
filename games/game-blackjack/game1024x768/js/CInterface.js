function CInterface(iMoney){
    var _aFiches;
    var _oButExit;
    var _oClearBetBut;
    var _oDealBut;
    var _oHitBut;
    var _oStandBut;
    var _oDoubleBut;
    var _oSplitBut;
    var _oAudioToggle;
    var _oMoneyText;
    var _oCurDealerCardValueText;
    var _oDisplayText1;
    var _oDisplayText2;
    var _oInsurancePanel;
    
    this._init = function(iMoney){

        var oSprite = s_oSpriteLibrary.getSprite('but_game_very_small_bg');
        _oClearBetBut = new CTextButton(350,CANVAS_HEIGHT -20,oSprite,TEXT_CLEAR,"Arial","#ffffff",14,s_oStage);
        _oClearBetBut.addEventListener(ON_MOUSE_UP, this._onButClearRelease, this);
        
        var oSprite = s_oSpriteLibrary.getSprite('but_exit');
        _oButExit = new CGfxButton(CANVAS_WIDTH - (oSprite.width/2) - 15,(oSprite.height/2) + 15,oSprite,s_oStage);
        _oButExit.addEventListener(ON_MOUSE_UP, this._onExit, this);
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            _oAudioToggle = new CToggle(_oButExit.getX() - oSprite.width,(oSprite.height/2) + 15,s_oSpriteLibrary.getSprite('audio_icon'));
            _oAudioToggle.addEventListener(ON_MOUSE_UP, this._onAudioToggle, this);
        }
	
	_oMoneyText = new createjs.Text("$"+iMoney.toFixed(2),"bold 29px Digital-7", "#ffde00");
        _oMoneyText.x = 80;
        _oMoneyText.y = CANVAS_HEIGHT - 38;
        _oMoneyText.textAlign = "center";
        s_oStage.addChild(_oMoneyText);

        _oDisplayText1 = new createjs.Text("","bold 24px Digital-7", "#ffde00");
        _oDisplayText1.x = 74;
        _oDisplayText1.y = 20;
		_oDisplayText1.lineWidth = 150;
        _oDisplayText1.textAlign = "left";
        _oDisplayText1.lineHeight = 20;
        s_oStage.addChild(_oDisplayText1);
        
        _oDisplayText2 = new createjs.Text("","bold 18px Digital-7", "#ffde00");
        _oDisplayText2.x = 74;
        _oDisplayText2.y = 70;
		_oDisplayText1.lineWidth = 140;
        _oDisplayText2.textAlign = "left";
        _oDisplayText2.lineHeight = 20;
        s_oStage.addChild(_oDisplayText2);

        _oCurDealerCardValueText = new createjs.Text("","bold 20px Arial", "#fff");
        _oCurDealerCardValueText.shadow = new createjs.Shadow("#000000", 2, 2, 1);
        _oCurDealerCardValueText.x = 420;
        _oCurDealerCardValueText.y = 180;
        _oCurDealerCardValueText.textAlign = "right";
        s_oStage.addChild(_oCurDealerCardValueText);

        oSprite = s_oSpriteLibrary.getSprite('but_game_bg');
        _oDealBut = new CTextButton(570,CANVAS_HEIGHT -30,oSprite,TEXT_DEAL,"Arial","#ffffff",20,s_oStage);
        _oDealBut.addEventListener(ON_MOUSE_UP, this._onButDealRelease, this);
        
        _oHitBut = new CTextButton(670,CANVAS_HEIGHT -30,oSprite,TEXT_HIT,"Arial","#ffffff",20,s_oStage);
        _oHitBut.addEventListener(ON_MOUSE_UP, this._onButHitRelease, this);
        
        _oStandBut = new CTextButton(770,CANVAS_HEIGHT -30,oSprite,TEXT_STAND,"Arial","#ffffff",20,s_oStage);
        _oStandBut.addEventListener(ON_MOUSE_UP, this._onButStandRelease, this);
        
        _oDoubleBut = new CTextButton(870,CANVAS_HEIGHT -30,oSprite,TEXT_DOUBLE,"Arial","#ffffff",20,s_oStage);
        _oDoubleBut.addEventListener(ON_MOUSE_UP, this._onButDoubleRelease, this);
        
        _oSplitBut  = new CTextButton(970,CANVAS_HEIGHT -30,oSprite,TEXT_SPLIT,"Arial","#ffffff",20,s_oStage);
        _oSplitBut.addEventListener(ON_MOUSE_UP, this._onButSplitRelease, this);

        //SET FICHES BUTTON
        var aPos = [{x:39,y:647},{x:84,y:672},{x:129,y:697},{x:174,y:717},{x:219,y:732},{x:264,y:747}];
        _aFiches = new Array();
        for(var i=0;i<NUM_FICHES;i++){
            var aFichesValues=s_oGameSettings.getFichesValues();
            oSprite = s_oSpriteLibrary.getSprite('fiche_'+i);
            _aFiches[i] = new CGfxButton(aPos[i].x,aPos[i].y,oSprite,s_oStage);
            _aFiches[i].addEventListenerWithParams(ON_MOUSE_UP, this._onFicheClicked, this,[aFichesValues[i],i]);
        }
        
        _oInsurancePanel = new CInsurancePanel();
        
        FICHE_WIDTH = oSprite.width;
        
        this.disableButtons();
        
        
    };
    
    this.unload = function(){
        _oButExit.unload();
        _oButExit = null;

        if(DISABLE_SOUND_MOBILE === false){
            _oAudioToggle.unload();
            _oAudioToggle = null;
        }

        s_oStage.removeChild(_oMoneyText);

    };
    
    this.reset = function(){
        this.disableButtons();
    };
    
    this.enableBetFiches = function(){
        for(var i=0;i<NUM_FICHES;i++){
            _aFiches[i].enable();
        }
        _oClearBetBut.enable();
    };
    
    this.disableBetFiches = function(){
        for(var i=0;i<NUM_FICHES;i++){
            _aFiches[i].disable();
        }
        _oClearBetBut.disable();
    };

    this.disableButtons = function(){
        _oDealBut.disable();
        _oHitBut.disable();
        _oStandBut.disable();
        _oDoubleBut.disable();
        _oSplitBut.disable();
    };
    
    this.enable = function(bDealBut,bHit,bStand,bDouble,bSplit){
        if(bDealBut){
            _oDealBut.enable();
        }else{
            _oDealBut.disable();
        }

        if(bHit){
            _oHitBut.enable();
        }else{
            _oHitBut.disable();
        }

        if(bStand){
            _oStandBut.enable();
        }else{
            _oStandBut.disable();
        }

        if(bDouble){
            _oDoubleBut.enable();
        }else{
            _oDoubleBut.disable();
        }

        if(bSplit){
            _oSplitBut.enable();
        }else{
            _oSplitBut.disable();
        }
    };
    
    this.refreshCredit = function(iMoney){
        _oMoneyText.text = "$"+iMoney.toFixed(2);
    };
    
    this.refreshDealerCardValue = function(iDealerValue){
        _oCurDealerCardValueText.text=""+iDealerValue;
    };
    
    this.displayMsg = function(szMsg,szMsgBig){
        _oDisplayText1.text = szMsg;
        _oDisplayText2.text = szMsgBig;
    };
    
    this.showInsurancePanel = function(){
        _oInsurancePanel.show(TEXT_INSURANCE);
    };
    
    this.clearDealerText = function(){
        _oCurDealerCardValueText.text="";
    };
    
    this._onFicheClicked = function(aParams){
        s_oGame.onFicheSelected(aParams[1],aParams[0]);  
    };
    
    this._onButClearRelease = function(){
        s_oGame.clearBets();
    };
    
    this._onButDealRelease = function(){
        this.disableBetFiches();
	this.disableButtons();
        s_oGame.onDeal();
    };
    
    this._onButHitRelease = function(){
        this.disableButtons();
        s_oGame.onHit();
    };
    
    this._onButStandRelease = function(){
        this.disableButtons();
	s_oGame.onStand();
    };
    
    this._onButDoubleRelease = function(){
        this.disableButtons();
        s_oGame.onDouble();
    };
    
    this._onButSplitRelease = function(){
        this.disableButtons();
        s_oGame.onSplit();
    };

    this._onExit = function(){
        s_oGame.onExit();  
    };
    
    this._onAudioToggle = function(){
        createjs.Sound.setMute(!s_bAudioActive);
    };
    
    s_oInterface = this;
    
    this._init(iMoney);
    
    return this;
}

var s_oInterface;