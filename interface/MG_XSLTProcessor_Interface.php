<?php

interface MG_XSLTProcessor_Interface 
{
	/* Interface for native XSLTProcessor methods */
	public function importStyleSheet($stylesheet);
	public function transformToDoc($doc);
	public function transformToURI($doc, $uri);
	public function transformToXML($doc);
}

?>
