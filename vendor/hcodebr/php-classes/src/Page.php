<?php

namespace Hcode;

use Rain\Tpl;

class Page {
    
    private $tpl;
    private $options = [];
    private $defauts = [
        "data"=>[]
    ];

    public function __construct($opts = array()) {
        
        $this->options = array_merge($this->defauts, $opts);
        
        // config
	$config = array(
			"tpl_dir"   => $_SERVER["DOCUMENT_ROOT"]."/views/",
			"cache_dir" => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"     => false // set to false to improve the speed
			);       
    
    Tpl::configure($config);
    
    $this->tpl = new Tpl;
    
    $this->setData($this->options["data"]);
    
    /*foreach ($this->options["data"] as $key =>$value){
        $this->tpl->assign($key, $value);
    }*/
         
    $this->tpl->draw("header");
    
    }
    
    public function setData($data = array()) {
        
        foreach ($data as $key =>$value){
        $this->tpl->assign($key, $value);        
        }
    }
    
    public function setTpl($name, $data = array(), $returnHTML = false) {
    
        $this->setData($data);//
        
        return $this->tpl->draw($name, $returnHTML);
        
    }
    
    
    
    
    public function __destruct() {
        $this->tpl->draw("footer");
    }
}
