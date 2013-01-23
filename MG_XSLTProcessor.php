<?php

require_once("interface/MG_XSLTProcessor_Interface.php");

class MG_XSLTProcessor extends XSLTProcessor implements MG_XSLTProcessor_Interface {
	
	private $stylesheet = null;
	private $params = array();
	
	public function importStyleSheet($stylesheet) {

		$this->stylesheet = $stylesheet;
	}

	public function setParameterById($id, $attribute, $value) {
		
		if( !isset($this->params[trim($id)]) ) {
			
			$this->params[trim($id)] = array(
				'attribute' => trim($attribute),
				'value' => trim($value)
			);
		}			
	}
	
	public function transformToDoc($doc) {
		
		$this->preProcess();
		return parent::transformToDoc($doc);
	}
	public function transformToURI($doc, $uri) {
		
		$this->preProcess();
		return parent::transformToURI($doc, $uri);
	}
	
	public function transformToXML($doc) {
		
		$this->preProcess();
		return parent::transformToXML($doc);
	}	
	
	private function preProcess() {
		
		if( !empty($this->params) && $this->stylesheet instanceof DOMDocument) {
			
			$xp = new DomXPath($this->stylesheet);
			
			foreach($this->params as $id => $v) {
			
				$res = $xp->query("//*[@id = '$id']");
				$res->item(0)->setAttribute($v['attribute'], $v['value']);	
			}
			
			unset($xp);
		}
		
		parent::importStyleSheet($this->stylesheet);
	}
}

?>