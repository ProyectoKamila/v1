<?php
/** Muestra el contenido de una variable para depurar y, opcionalmente, detiene la ejecucion del script. <br/>
 * @param mixed $var Variable a depurar.
 * @param bool $stop Si es verdadero detiene la ejecución del script.
 */
function debug($var, $stop = true) {
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
	if ($stop) exit;
}


function max_charlength($text, $charlength, $pad = '[...]', $strict = false) {
	$text = strip_tags($text);
	if (mb_strlen($text) > $charlength) {
		$subex = mb_substr($text, 0, $charlength - mb_strlen($pad));

		if ($strict) {
			$charlength++;
			$result = $subex;
		} else {

			$exwords = explode(' ', $subex);
			$excut = - ( mb_strlen($exwords[count($exwords) - 1]) );
			if ($excut < 0) {
				$result = mb_substr($subex, 0, $excut);
			} else {
				$result = $subex;
			}
		}
		$result .= $pad;
	} else {
		$result = $text;
	}
	return $result;
}
?>
