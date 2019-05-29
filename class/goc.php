<?php
class goc {
	public $host="localhost";
	public $user="root";
	public $pass="";
	public $dbname="tintuc";
	protected $db;
	function __construct(){
		$this->db= new mysqli ($this->host, $this->user, $this->pass, $this->dbname);
	$this->db->set_charset("utf8");
	}//cac method
}//class goc
?>