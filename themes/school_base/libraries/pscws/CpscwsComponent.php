<?php
class CpscwsComponent extends CApplicationComponent{
	   protected $cws;
	   public $test;
	   public $charset = 'gbk';
       function init(){

		   	parent::init();
			require 'pscws4.php';
			$pscwsPath = dirname(__FILE__);


			$this->cws = new PSCWS4();
			$this->cws->set_charset('utf8');
			$this->cws->set_dict($pscwsPath . '/etc/dict.utf8.xdb');
			$this->cws->set_rule($pscwsPath . '/etc/rules.utf8.ini');
			//$this->cws->set_multi(3);
			//$cws->set_ignore(true);
			
			//$cws->set_duality(true);
	   }
	 
	   function getWord($text){
 
		  $this->cws->send_text($text);
		  $words = array();
		  while ($tmp = $this->cws->get_result()){
 			 	   foreach($tmp as $word){
				   			  $words[] =  $word['word']	;
				   }
		  }
  		  return $words;

	   }

}