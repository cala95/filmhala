<?php
#We need to secure our data base 
function escape($string){
	return htmlentities($string, ENT_QUOTES, 'UTF-8'); #ENT_QUOTES skips single and double quotes
}