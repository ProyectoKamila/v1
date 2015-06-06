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
		
        s_oSpriteLibrary  = new CSpriteLibrary();

        //ADD PRELOADER
        _oPreloader = new CPreloader();
    };

    this.soundLoaded = function(){
         _iCurResource++;
         var iPerc = Math.floor(_iCurResource/RESOURCE_TO_LOAD *100);

        _oPreloader.refreshLoader(iPerc);
        
        if(_iCurResource === RESOURCE_TO_LOAD){
            this.removePreloader();
        }
    };
    
    this._initSounds = function(){
         if (!createjs.Sound.initializeDefaultPlugins()) {
             return;
         }

        if(navigator.userAgent.indexOf("Opera")>0 || navigator.userAgent.indexOf("OPR")>0){
                createjs.Sound.alternateExtensions = ["mp3"];
                createjs.Sound.addEventListener("fileload", createjs.proxy(this.soundLoaded, this));

                createjs.Sound.registerSound("./games/game-jacks-or-better/game1024x768/sounds/soundtrack.ogg", "soundtrack");
                createjs.Sound.registerSound("./games/game-jacks-or-better/game1024x768/sounds/card.ogg", "card");
                createjs.Sound.registerSound("./games/game-jacks-or-better/game1024x768/sounds/press_but.ogg", "press_but");
                createjs.Sound.registerSound("./games/game-jacks-or-better/game1024x768/sounds/win.ogg", "win");
                createjs.Sound.registerSound("./games/game-jacks-or-better/game1024x768/sounds/lose.ogg", "lose");
                createjs.Sound.registerSound("./games/game-jacks-or-better/game1024x768/sounds/press_hold.ogg", "press_hold");
        }else{
                createjs.Sound.alternateExtensions = ["ogg"];
                createjs.Sound.addEventListener("fileload", createjs.proxy(this.soundLoaded, this));

                createjs.Sound.registerSound("./games/game-jacks-or-better/game1024x768/sounds/soundtrack.mp3", "soundtrack");
                createjs.Sound.registerSound("./games/game-jacks-or-better/game1024x768/sounds/card.mp3", "card");
                createjs.Sound.registerSound("./games/game-jacks-or-better/game1024x768/sounds/press_but.mp3", "press_but");
                createjs.Sound.registerSound("./games/game-jacks-or-better/game1024x768/sounds/win.mp3", "win");
                createjs.Sound.registerSound("./games/game-jacks-or-better/game1024x768/sounds/lose.mp3", "lose");
                createjs.Sound.registerSound("./games/game-jacks-or-better/game1024x768/sounds/press_hold.mp3", "press_hold");
        }
        RESOURCE_TO_LOAD += 6;
        
    };
    
    this._loadImages = function(){
        s_oSpriteLibrary.init( this._onImagesLoaded,this._onAllImagesLoaded, this );
        
        s_oSpriteLibrary.addSprite("bg_menu","./games/game-jacks-or-better/game1024x768/sprites/bg_menu.jpg");
        s_oSpriteLibrary.addSprite("but_menu_bg","./games/game-jacks-or-better/game1024x768/sprites/but_menu_bg.png");
        s_oSpriteLibrary.addSprite("but_game_bg","./games/game-jacks-or-better/game1024x768/sprites/but_game_bg.png");
        s_oSpriteLibrary.addSprite("but_exit","./games/game-jacks-or-better/game1024x768/sprites/but_exit.png");
        s_oSpriteLibrary.addSprite("audio_icon","./games/game-jacks-or-better/game1024x768/sprites/audio_icon.png");
        s_oSpriteLibrary.addSprite("bg_game","./games/game-jacks-or-better/game1024x768/sprites/bg_game.jpg");
        s_oSpriteLibrary.addSprite("card_spritesheet","./games/game-jacks-or-better/game1024x768/sprites/card_spritesheet.png");
        s_oSpriteLibrary.addSprite("msg_box","./games/game-jacks-or-better/game1024x768/sprites/msg_box.png");
        s_oSpriteLibrary.addSprite("but_left","./games/game-jacks-or-better/game1024x768/sprites/but_left.png");
        s_oSpriteLibrary.addSprite("but_right","./games/game-jacks-or-better/game1024x768/sprites/but_right.png");
        s_oSpriteLibrary.addSprite("hold","./games/game-jacks-or-better/game1024x768/sprites/hold.png");
        s_oSpriteLibrary.addSprite("logo_game","./games/game-jacks-or-better/game1024x768/sprites/logo_game.png");
        s_oSpriteLibrary.addSprite("paytable","./games/game-jacks-or-better/game1024x768/sprites/paytable.png");
        s_oSpriteLibrary.addSprite("display_bg","./games/game-jacks-or-better/game1024x768/sprites/display_bg.png");
        s_oSpriteLibrary.addSprite("big_display","./games/game-jacks-or-better/game1024x768/sprites/big_display.png");
        s_oSpriteLibrary.addSprite("selection","./games/game-jacks-or-better/game1024x768/sprites/selection.png");
        s_oSpriteLibrary.addSprite("card_selection","./games/game-jacks-or-better/game1024x768/sprites/card_selection.png");
        
        RESOURCE_TO_LOAD += s_oSpriteLibrary.getNumSprites();

        s_oSpriteLibrary.loadSprites();
    };
    
    this._onImagesLoaded = function(){
        _iCurResource++;
        var iPerc = Math.floor(_iCurResource/RESOURCE_TO_LOAD *100);

        _oPreloader.refreshLoader(iPerc);
        
        if(_iCurResource === RESOURCE_TO_LOAD){
            this.removePreloader();
        }
    };
    
    this.preloaderReady = function(){
        this._loadImages();
		
	if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            this._initSounds();
        }
    };
    
    this.removePreloader = function(){
        _oPreloader.unload();
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            s_oSoundTrack = createjs.Sound.play("soundtrack",{loop:-1});
        }
        
        this.gotoMenu();
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
var s_oSoundTrack;