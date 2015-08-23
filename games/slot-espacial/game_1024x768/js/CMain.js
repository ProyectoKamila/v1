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
		
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            this._initSounds();
        }
		
        s_oSpriteLibrary  = new CSpriteLibrary();

        //ADD PRELOADER
        _oPreloader = new CPreloader();

        this._loadImages();
    };

    this.soundLoaded = function(){
         _iCurResource++;

         if(_iCurResource === RESOURCE_TO_LOAD){
              new CSlotSettings();
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
		
			createjs.Sound.registerSound("./games/slot-espacial/game_1024x768/sounds/press_but.ogg", "press_but");
			createjs.Sound.registerSound("./games/slot-espacial/game_1024x768/sounds/win.ogg", "win");
			createjs.Sound.registerSound("./games/slot-espacial/game_1024x768/sounds/reels.ogg", "reels");
			createjs.Sound.registerSound("./games/slot-espacial/game_1024x768/sounds/reel_stop.ogg", "reel_stop",6);
			createjs.Sound.registerSound("./games/slot-espacial/game_1024x768/sounds/start_reel.ogg", "start_reel",6);
		}else{
			createjs.Sound.alternateExtensions = ["ogg"];
			createjs.Sound.addEventListener("fileload", createjs.proxy(this.soundLoaded, this));
		
			createjs.Sound.registerSound("./games/slot-espacial/game_1024x768/sounds/press_but.mp3", "press_but");
			createjs.Sound.registerSound("./games/slot-espacial/game_1024x768/sounds/win.mp3", "win");
			createjs.Sound.registerSound("./games/slot-espacial/game_1024x768/sounds/reels.mp3", "reels");
			createjs.Sound.registerSound("./games/slot-espacial/game_1024x768/sounds/reel_stop.mp3", "reel_stop",6);
			createjs.Sound.registerSound("./games/slot-espacial/game_1024x768/sounds/start_reel.mp3", "start_reel",6);
		}
        RESOURCE_TO_LOAD += 5;
        
    };
    
    this._loadImages = function(){
        s_oSpriteLibrary.init( this._onImagesLoaded,this._onAllImagesLoaded, this );

        s_oSpriteLibrary.addSprite("but_bg","./games/slot-espacial/game_1024x768/sprites/but_play_bg.png");
        s_oSpriteLibrary.addSprite("but_exit","./games/slot-espacial/game_1024x768/sprites/but_exit.png");
        s_oSpriteLibrary.addSprite("bg_menu","./games/slot-espacial/game_1024x768/sprites/bg_menu.jpg");
        s_oSpriteLibrary.addSprite("bg_game","./games/slot-espacial/game_1024x768/sprites/bg_game.jpg");
        s_oSpriteLibrary.addSprite("paytable","./games/slot-espacial/game_1024x768/sprites/paytable.jpg");
        s_oSpriteLibrary.addSprite("msg_box","./games/slot-espacial/game_1024x768/sprites/msg_box.png");
        s_oSpriteLibrary.addSprite("bg_help","./games/slot-espacial/game_1024x768/sprites/bg_help.png");
        s_oSpriteLibrary.addSprite("mask_slot","./games/slot-espacial/game_1024x768/sprites/mask_slot.png");
        s_oSpriteLibrary.addSprite("spin_but","./games/slot-espacial/game_1024x768/sprites/but_spin_bg.png");
        s_oSpriteLibrary.addSprite("coin_but","./games/slot-espacial/game_1024x768/sprites/but_coin_bg.png");
        s_oSpriteLibrary.addSprite("info_but","./games/slot-espacial/game_1024x768/sprites/but_info_bg.png");
        s_oSpriteLibrary.addSprite("bet_but","./games/slot-espacial/game_1024x768/sprites/bet_but.png");
        s_oSpriteLibrary.addSprite("win_frame_anim","./games/slot-espacial/game_1024x768/sprites/win_frame_anim.png");
        s_oSpriteLibrary.addSprite("but_lines_bg","./games/slot-espacial/game_1024x768/sprites/but_lines_bg.png");
        s_oSpriteLibrary.addSprite("but_maxbet_bg","./games/slot-espacial/game_1024x768/sprites/but_maxbet_bg.png");
        s_oSpriteLibrary.addSprite("audio_icon","./games/slot-espacial/game_1024x768/sprites/audio_icon.png");
        
        for(var i=1;i<NUM_SYMBOLS+1;i++){
            s_oSpriteLibrary.addSprite("symbol_"+i,"./games/slot-espacial/game_1024x768/sprites/symbol_"+i+".png");
            s_oSpriteLibrary.addSprite("symbol_"+i+"_anim","./games/slot-espacial/game_1024x768/sprites/symbol_"+i+"_anim.png");
        }
        
        for(var j=1;j<NUM_PAYLINES+1;j++){
            s_oSpriteLibrary.addSprite("payline_"+j,"./games/slot-espacial/game_1024x768/sprites/payline_"+j+".png");
        }
        
        RESOURCE_TO_LOAD += s_oSpriteLibrary.getNumSprites();

        s_oSpriteLibrary.loadSprites();
    };
    
    this._onImagesLoaded = function(){
        _iCurResource++;

        var iPerc = Math.floor(_iCurResource/RESOURCE_TO_LOAD *100);

        _oPreloader.refreshLoader(iPerc);
        
        if(_iCurResource === RESOURCE_TO_LOAD){
            new CSlotSettings();
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