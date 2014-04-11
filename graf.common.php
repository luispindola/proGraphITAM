<?php
require_once ("xajaxs/xajax_core/xajax.inc.php");
$xajax = new xajax("graf.funciones.php");
$xajax->configure('javascript URI','xajaxs/');
$xajax->register(XAJAX_FUNCTION,"muestraresultados");
?>
