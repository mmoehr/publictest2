<?php

class DB {
       
    
    private $_link = null; // db link resource
    
    private $_neueVar = null;
    
    private $_result = null; // current result
    
    public function __construct($host, $user, $pw, $dbName) {        
        $this->_link = mysql_connect($host,$user, $pw) or die('Database error');
        mysql_select_db($dbName, $this->_link); 
    }
    
    public function query($query) {        
        $this->_result = mysql_query($query);
        
        if(false == $this->_result) {
            $this->_handleError();
        }
    }
                
    private function _handleError() {
        die('<p><b>FEHLER</b> '.mysql_error($this->_link).'</p>');
    }
    
    public function numRows() {
        return (int)mysql_num_rows($this->_result);
    }
    
    public function affectedRows() {
        return mysql_affected_rows($this->_link);
    }
    
    public function fetchRow() {
        return mysql_fetch_assoc($this->_result);
    }    
    
    public function quoteSmart($string) {
        return mysql_real_escape_string($string);
    }    
    
    public function freeResult() {
        mysql_free_result($this->_result);   
        $this->_result = null;
    }    
}
