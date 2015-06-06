function CGameOver(){
    var _oTextTitle;
    var _oTextMsg;
    var _ButRecharge;
    var _oButExit;
    var _oContainer;
    
    this._init = function(){
        _oContainer = new createjs.Container();
        s_oStage.addChild(_oContainer);

        var oBg = createBitmap(s_oSpriteLibrary.getSprite('game_over_bg'));
        _oContainer.addChild(oBg);
        
        _oTextTitle = new createjs.Text(TEXT_NO_MONEY,"bold 36px Arial", "#fff");
        _oTextTitle.textAlign = "center";
        _oTextTitle.x = CANVAS_WIDTH/2;
        _oTextTitle.y = 140;
        _oContainer.addChild(_oTextTitle);
        
        _oTextMsg = new createjs.Text(TEXT_RECHARGE_MSG,"bold 20px Arial", "#fff");
        _oTextMsg.textAlign = "center";
        _oTextMsg.x = CANVAS_WIDTH/2;
        _oTextMsg.y = 240;
        _oContainer.addChild(_oTextMsg);
        
        _ButRecharge = new CTextButton(CANVAS_WIDTH/2,400,s_oSpriteLibrary.getSprite('but_game_bg'),TEXT_RECHARGE,"Arial","#fff",14,false);
        _ButRecharge.addEventListener(ON_MOUSE_UP, this._onRecharge, this);
        _oContainer.addChild(_ButRecharge.getSprite());
        
        _oButExit = new CTextButton(CANVAS_WIDTH/2,440,s_oSpriteLibrary.getSprite('but_game_bg'),TEXT_EXIT,"Arial","#fff",14,false);
        _oButExit.addEventListener(ON_MOUSE_UP, this._onExit, this);
        _oContainer.addChild(_oButExit.getSprite());
        
        this.hide();
    };
	
	this.unload = function(){
		_ButRecharge.unload();
		_oButExit.unload();
	};
    
    this.show = function(){
        _oContainer.visible = true;
    };
    
    this.hide = function(){
        _oContainer.visible = false;
    };
    
    this._onRecharge = function(){
        s_oGame.onRecharge();
    };
    
    this._onExit = function(){
        s_oGame.onExit();
    };
    
    this._init();
}