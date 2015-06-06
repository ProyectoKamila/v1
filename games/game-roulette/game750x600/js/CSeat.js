function CSeat(){
    
    var _iCurBet;
    var _iCredit;
    var _aNumberBetted;
    var _aNumbersSelected;
    var _oFicheController;
    
    this._init = function(){
        this.reset();
    };
    
    this.reset = function(){
        _aNumberBetted=new Array();
        this.resetNumberWins();

        if(_oFicheController){
            _oFicheController.reset();
        }
        
        _iCurBet=0;
    };
    
    this.setInfo = function(iCredit,oContainerFiche){
        _iCredit=iCredit;
        _iCurBet=0;

        _oFicheController = new CFichesController(oContainerFiche);
    };
	
    this.resetNumberWins = function(){
	for(var i=0;i<NUMBERS_TO_BET;i++){
                _aNumberBetted[i] = {win:0,mc:null};
        }
    };
    
    this.setFicheBetted = function(iFicheValue,aNumbers,iWinForBet,aFichesMc,iNumFiches){
        for(var i=0;i<aNumbers.length;i++){
            var iWin = ( parseFloat(_aNumberBetted[aNumbers[i]].win)+(iWinForBet* (iFicheValue*iNumFiches) )).toFixed(1);
            _aNumberBetted[aNumbers[i]]={win:iWin,mc:aFichesMc};
        }
        
        _aNumbersSelected = aNumbers;
        _iCurBet+= (iFicheValue * iNumFiches);
        _iCredit -= (iFicheValue * iNumFiches);
        _iCredit = roundDecimal(_iCredit, 1);
    };
    
    this.createPileForVoisinZero = function(iFicheValue,iIndexFicheSelected,aNumbers,iBetMult,iNumFiches){
        var aFichesMc=new Array();
        _oFicheController.createPileForVoisinZero(iIndexFicheSelected,aFichesMc);
        this.setFicheBetted(iFicheValue,aNumbers,iBetMult,aFichesMc,iNumFiches);
    };
		
    this.createPileForTier = function(iFicheValue,iIndexFicheSelected,aNumbers,iBetMult,iNumFiches){
        var aFichesMc=new Array();
        _oFicheController.createPileForTier(iIndexFicheSelected,aFichesMc);
        this.setFicheBetted(iFicheValue,aNumbers,iBetMult,aFichesMc,iNumFiches);
    };
		
    this.createPileForOrphelins = function(iFicheValue,iIndexFicheSelected,aNumbers,iBetMult,iNumFiches){
        var aFichesMc=new Array();
        _oFicheController.createPileForOrphelins(iIndexFicheSelected,aFichesMc);
        this.setFicheBetted(iFicheValue,aNumbers,iBetMult,aFichesMc,iNumFiches);
    };
		
    this.createPileForMultipleNumbers = function(iFicheValue,iIndexFicheSelected,aNumbers,iBetMult,iNumFiches){
        var aFichesMc=new Array();
        _oFicheController.createPileForMultipleNumbers(iIndexFicheSelected,aNumbers,aFichesMc);
        this.setFicheBetted(iFicheValue,aNumbers,iBetMult,aFichesMc,iNumFiches);
    };
		
    this.addFicheOnTable = function(iFicheValue,iIndexFicheSelected,aNumbers,iBetMult,szNameAttach){
        var aFichesMc=new Array();
        _oFicheController.setFicheOnTable(iIndexFicheSelected,szNameAttach,aFichesMc);
        this.setFicheBetted(iFicheValue,aNumbers,iBetMult,aFichesMc,1);
    };
    
    this.clearLastBet = function(){
        var iBet = _oFicheController.clearLastBet();
        _iCredit += iBet;
        _iCredit = roundDecimal(_iCredit, 1);
        _iCurBet -= iBet;
    };
    
    this.clearAllBets = function(){
        this.resetNumberWins();
        _oFicheController.clearAllBets();
        _iCredit += _iCurBet;
        _iCredit = roundDecimal(_iCredit, 1);
        _iCurBet=0;
    };
    
    this.showWin = function(iWin){
        _iCredit += iWin;
        _iCredit = roundDecimal(_iCredit, 1);
    };
    
    this.recharge = function(iMoney) {
        _iCredit = iMoney;
    };
    
    this.getCurBet = function(){
        return _iCurBet;
    };
    
    this.getCredit = function(){
        return _iCredit;
    };
    
    this.getNumbersBetted = function(){
        return _aNumberBetted;
    };
    
    this.getNumberSelected = function(){
        return _aNumbersSelected;
    };
    
    this._init();
}