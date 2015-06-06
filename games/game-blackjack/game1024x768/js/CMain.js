function CMain(oData){

    var _iCurResource = 0;
    var RESOURCE_TO_LOAD = 0;
    var _iState = STATE_LOADING;
    
    var _oData;
    var _oPreloader;
    var _oMenu;
    var _oHelp;
    var _oGame;

    this.initContainer = function(){
        var canvas = document.getElementById("canvas");
        s_oStage = new createjs.Stage(canvas);       
        createjs.Touch.enable(s_oStage);
        
        s_bMobile = jQuery.browser.mobile;
        if(s_bMobile === false){
            s_oStage.enableMouseOver(20);  
        }
        
        
        s_iPrevTime = new Date().getTime();

        createjs.Ticker.setFPS(30);
	createjs.Ticker.addEventListener("tick", this._update);
		if(navigator.userAgent.match(/Windows Phone/i)){
			DISABLE_SOUND_MOBILE = true;
		}

        s_oSpriteLibrary  = new CSpriteLibrary();

        //ADD PRELOADER
        _oPreloader = new CPreloader();
        
        s_oGameSettings=new CGameSettings();
    };
	
	this.preloaderReady = function(){
        this._loadImages();
		
		if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            this._initSounds();
        }
    };

    this.soundLoaded = function(){
         _iCurResource++;
		 var iPerc = Math.floor(_iCurResource/RESOURCE_TO_LOAD *100);

         _oPreloader.refreshLoader(iPerc);
		
         if(_iCurResource === RESOURCE_TO_LOAD){
            _oPreloader.unload();
            
            this.gotoMenu();
         }
    };
    
    this._initSounds = function(){
         if (!createjs.Sound.initializeDefaultPlugins()) {
             return;
         }

        if(navigator.userAgent.indexOf("Opera")>0 || navigator.userAgent.indexOf("OPR")>0){
                createjs.Sound.alternateExtensions = ["mp3"];
                createjs.Sound.addEventListener("fileload", createjs.proxy(this.soundLoaded, this));

                createjs.Sound.registerSound("./games/game-blackjack/game1024x768/sounds/card.ogg", "card");
                createjs.Sound.registerSound("./games/game-blackjack/game1024x768/sounds/chip.ogg", "chip");
                createjs.Sound.registerSound("./games/game-blackjack/game1024x768/sounds/fiche_collect.ogg", "fiche_collect");
                createjs.Sound.registerSound("./games/game-blackjack/game1024x768/sounds/press_but.ogg", "press_but");
                createjs.Sound.registerSound("./games/game-blackjack/game1024x768/sounds/win.ogg", "win");
                createjs.Sound.registerSound("./games/game-blackjack/game1024x768/sounds/lose.ogg", "lose");
        }else{
                createjs.Sound.alternateExtensions = ["ogg"];
                createjs.Sound.addEventListener("fileload", createjs.proxy(this.soundLoaded, this));

                createjs.Sound.registerSound("./games/game-blackjack/game1024x768/sounds/card.mp3", "card",4);
                createjs.Sound.registerSound("./games/game-blackjack/game1024x768/sounds/chip.mp3", "chip",4);
                createjs.Sound.registerSound("./games/game-blackjack/game1024x768/sounds/fiche_collect.mp3", "fiche_collect");
                createjs.Sound.registerSound("./games/game-blackjack/game1024x768/sounds/press_but.mp3", "press_but");
                createjs.Sound.registerSound("./games/game-blackjack/game1024x768/sounds/win.mp3", "win");
                createjs.Sound.registerSound("./games/game-blackjack/game1024x768/sounds/lose.mp3", "lose");
        }
        RESOURCE_TO_LOAD += 6;
        
    };
    
    this._loadImages = function(){
        s_oSpriteLibrary.init( this._onImagesLoaded,this._onAllImagesLoaded, this );

        s_oSpriteLibrary.addSprite("but_menu_bg","./games/game-blackjack/game1024x768/sprites/but_menu_bg.png");
        s_oSpriteLibrary.addSprite("but_game_bg","./games/game-blackjack/game1024x768/sprites/but_game_bg.png");
        s_oSpriteLibrary.addSprite("but_game_small_bg","./games/game-blackjack/game1024x768/sprites/but_game_small_bg.png");
        s_oSpriteLibrary.addSprite("but_game_very_small_bg","./games/game-blackjack/game1024x768/sprites/but_game_very_small_bg.png");
        s_oSpriteLibrary.addSprite("but_exit","./games/game-blackjack/game1024x768/sprites/but_exit.png");
        s_oSpriteLibrary.addSprite("bg_menu","./games/game-blackjack/game1024x768/sprites/bg_menu.jpg");
        s_oSpriteLibrary.addSprite("audio_icon","./games/game-blackjack/game1024x768/sprites/audio_icon.png");
        s_oSpriteLibrary.addSprite("bg_game_1","./games/game-blackjack/game1024x768/sprites/bg_game_1.jpg");
        s_oSpriteLibrary.addSprite("bg_game_2","./games/game-blackjack/game1024x768/sprites/bg_game_2.jpg");
        s_oSpriteLibrary.addSprite("bg_game_3","./games/game-blackjack/game1024x768/sprites/bg_game_3.jpg");
        s_oSpriteLibrary.addSprite("bg_game_4","./games/game-blackjack/game1024x768/sprites/bg_game_4.jpg");
        s_oSpriteLibrary.addSprite("seat","./games/game-blackjack/game1024x768/sprites/seat.png");
        s_oSpriteLibrary.addSprite("card_spritesheet","./games/game-blackjack/game1024x768/sprites/card_spritesheet.png");
        s_oSpriteLibrary.addSprite("arrow_hand","./games/game-blackjack/game1024x768/sprites/arrow_hand.png");
        s_oSpriteLibrary.addSprite("msg_box","./games/game-blackjack/game1024x768/sprites/msg_box.png");
        
        for(var i=0;i<NUM_FICHES;i++){
            s_oSpriteLibrary.addSprite("fiche_"+i,"./games/game-blackjack/game1024x768/sprites/fiche_"+i+".png");
        }
        
        RESOURCE_TO_LOAD += s_oSpriteLibrary.getNumSprites();

        s_oSpriteLibrary.loadSprites();
    };
    
    this._onImagesLoaded = function(){
        _iCurResource++;

        var iPerc = Math.floor(_iCurResource/RESOURCE_TO_LOAD *100);

        _oPreloader.refreshLoader(iPerc);
        
        if(_iCurResource === RESOURCE_TO_LOAD){
            _oPreloader.unload();
            
            this.gotoMenu();
        }
    };
    
    this._onAllImagesLoaded = function(){
        
    };
    
    this.onAllPreloaderImagesLoaded = function(){
        this._loadImages();
    };
    
    this.gotoMenu = function(){
        _oMenu = new CMenu();
        _iState = STATE_MENU;
    };
    
    this.gotoGame = function(){
        _oGame = new CGame(_oData);   
							
        _iState = STATE_GAME;
        $(s_oMain).trigger("game_start");
    };
    
    this.gotoHelp = function(){
        _oHelp = new CHelp();
        _iState = STATE_HELP;
    };
    
    this._update = function(event){
        var iCurTime = new Date().getTime();
        s_iTimeElaps = iCurTime - s_iPrevTime;
        s_iCntTime += s_iTimeElaps;
        s_iCntFps++;
        s_iPrevTime = iCurTime;
        
        if ( s_iCntTime >= 1000 ){
            s_iCurFps = s_iCntFps;
            s_iCntTime-=1000;
            s_iCntFps = 0;
        }
                
        if(_iState === STATE_GAME){
            _oGame.update();
        }
        
        s_oStage.update(event);

    };
    
    s_oMain = this;
    _oData = oData;

    this.initContainer();
}

var s_bMobile;
var s_bAudioActive = true;
var s_iCntTime = 0;
var s_iTimeElaps = 0;
var s_iPrevTime = 0;
var s_iCntFps = 0;
var s_iCurFps = 0;

var s_oDrawLayer;
var s_oStage;
var s_oMain;
var s_oSpriteLibrary;
var s_oGameSettings;