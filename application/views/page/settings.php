<script>

var CANVAS_WIDTH = <?php echo $CANVAS_WIDTH ?>;
var CANVAS_HEIGHT = <?php echo $CANVAS_HEIGHT ?>;

var FPS_TIME      = <?php echo $FPS_TIME ?>;
var DISABLE_SOUND_MOBILE = <?php echo $DISABLE_SOUND_MOBILE ?>;

var STATE_LOADING = <?php echo $STATE_LOADING ?>;
var STATE_MENU    = <?php echo $STATE_MENU ?>;
var STATE_HELP    = <?php echo $STATE_HELP ?>;
var STATE_GAME    = <?php echo $STATE_GAME ?>;

var GAME_STATE_IDLE         = <?php echo $GAME_STATE_IDLE ?>;
var GAME_STATE_SPINNING     = <?php echo $GAME_STATE_SPINNING ?>;
var GAME_STATE_SHOW_ALL_WIN = <?php echo $GAME_STATE_SHOW_ALL_WIN ?>;
var GAME_STATE_SHOW_WIN     = <?php echo $GAME_STATE_SHOW_WIN ?>;

var REEL_STATE_START   = <?php echo $REEL_STATE_START ?>;
var REEL_STATE_MOVING = <?php echo $REEL_STATE_MOVING ?>;
var REEL_STATE_STOP    = <?php echo $REEL_STATE_STOP ?>;

var ON_MOUSE_DOWN = <?php echo $ON_MOUSE_DOWN ?>;
var ON_MOUSE_UP   = <?php echo $ON_MOUSE_UP ?>;
var ON_MOUSE_OVER = <?php echo $ON_MOUSE_OVER ?>;
var ON_MOUSE_OUT  = <?php echo $ON_MOUSE_OUT ?>;
var ON_DRAG_START = <?php echo $ON_DRAG_START ?>;
var ON_DRAG_END   = <?php echo $ON_DRAG_END ?>;

var REEL_OFFSET_X = <?php echo $REEL_OFFSET_X ?>;
var REEL_OFFSET_Y = <?php echo $REEL_OFFSET_Y ?>;

var NUM_REELS = <?php echo $NUM_REELS ?>;
var NUM_ROWS = <?php echo $NUM_ROWS ?>;
var NUM_SYMBOLS = <?php echo $NUM_SYMBOLS ?>;
var WILD_SYMBOL = <?php echo $WILD_SYMBOL ?>;
var NUM_PAYLINES = <?php echo $NUM_PAYLINES ?>;
var SYMBOL_SIZE = <?php echo $SYMBOL_SIZE ?>;
var SPACE_BETWEEN_SYMBOLS = <?php echo $SPACE_BETWEEN_SYMBOLS ?>;
var MAX_FRAMES_REEL_EASE = <?php echo $MAX_FRAMES_REEL_EASE ?>;
var MIN_REEL_LOOPS;
var REEL_DELAY;
var REEL_START_Y = REEL_OFFSET_Y - (SYMBOL_SIZE * <?php echo $REEL_START_Y ?>);
var REEL_ARRIVAL_Y = REEL_OFFSET_Y + (SYMBOL_SIZE * <?php echo $REEL_ARRIVAL_Y ?>);
var TIME_SHOW_WIN;
var TIME_SHOW_ALL_WINS;
var MIN_BET = <?php echo $MIN_BET ?>;
var MAX_BET = <?php echo $MAX_BET ?>;
var TOTAL_MONEY;
</script>