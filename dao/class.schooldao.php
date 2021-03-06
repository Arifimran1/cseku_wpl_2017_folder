<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class SchoolDAO{

	private $_DB;
	private $_School;

	function SchoolDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_School = new School();

	}

	// get all the Schools from the database using the database query
	public function getAllSchools(){

		$SchoolList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_School");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_School = new School();

		    $this->_School->setID ( $row['ID']);
		    $this->_School->setName( $row['Name'] );


		    $SchoolList[]=$this->_School;
   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SchoolList);

		return $Result;
	}

	//create School funtion with the School object
	public function createSchool($School){

		$ID=$School->getID();
		$Name=$School->getName();


		$SQL = "INSERT INTO tbl_School(ID,Name) VALUES('$ID','$Name')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	//read an School object based on its id form School object
	public function readSchool($School){
		
		
		$SQL = "SELECT * FROM tbl_School WHERE ID='".$School->getID()."'";
		$this->_DB->doQuery($SQL);

		//reading the top row for this School from the database
		$row = $this->_DB->getTopRow();

		$this->_School = new School();

		//preparing the School object
	    $this->_School->setID ( $row['ID']);
	    $this->_School->setName( $row['Name'] );



	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_School);

		return $Result;
	}

	//update an School object based on its 
	public function updateSchool($School){

		$SQL = "UPDATE tbl_School SET Name='".$School->getName()."' WHERE ID='".$School->getID()."'";


		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

	//delete an School based on its id of the database
	public function deleteSchool($School){


		$SQL = "DELETE from tbl_School where ID ='".$School->getID()."'";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

}

echo '<br> log:: exit the class.schooldao.php';

?>