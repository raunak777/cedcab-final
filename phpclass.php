<?php

class database {
	private $servername= "localhost";
	private $username= "root";
	private $dbname= "cedcab";
	private $conn= false;
	private $mysqli="";
	private $result=array();
	public $price=0;

	public function __construct()
	{
		if(!$this->conn)
		{
			$this->mysqli= new mysqli($this->servername, $this->username,'',$this->dbname);
			$this->conn=true;
			if($this->mysqli->connect_error){
				array_push($this->result, $this->mysqli->connect_error);
				return false;
			}
		}
		else{
			return true;
		}
	}

	public function insertdata($para= array()){
		$table_columns = implode(', ', array_keys($para));
		$table_value = implode("','", $para);

		$sql = "INSERT INTO registration($table_columns) values ('$table_value')";
		if ($this->mysqli->query($sql)) {
			array_push($this->result, $this->mysqli->insert_id);
			return true;
		}
		else{
			array_push($this->result, $this->mysqli->error);
			return false;
		}

	}
	public function datainsert($sql)
	{
		$query = $this->mysqli->query($sql);
		if ($query) {
			echo "<script> alert('Your ride has been booked but approval is needed from admin please wait for the approval!'); </script>";
			return true;
		}
		else{
			echo "<script> alert('Ride not book'); </script>";
			return false;
		}
	}

	public function cancel_status($id)
	{
		$sql= "UPDATE tbl_ride SET status=2 WHERE ride_id=$id";
		if($this->mysqli->query($sql)){
			echo 1;
		}
		else{
			echo 0;
		}

	}
	public function accept_status($id)
	{
		$sql= "UPDATE tbl_ride SET status=1 WHERE ride_id=$id";
		if($this->mysqli->query($sql)){
			echo 1;
		}
		else{
			echo 0;
		}

	}

	public function pending_ride_users($status,$id)
	{
		$sql= "SELECT count(status) FROM `tbl_ride` WHERE status=$status and cuser_id=$id";
		$query = $this->mysqli->query($sql);
		if ($query) {
			$this->result= $query->fetch_assoc();
			return true;
		}
		else{
			array_push($this->result, $this->mysqli->error);
			return false;
		}
	}

	public function pending_ride_admin($status)
	{
		$sql= "SELECT count(status) FROM `tbl_ride` WHERE status=$status";
		$query = $this->mysqli->query($sql);
		if ($query) {
			$this->result= $query->fetch_assoc();
			return true;
		}
		else{
			array_push($this->result, $this->mysqli->error);
			return false;
		}
	}

	public function total_ride_admin()
	{
		$sql= "SELECT count(*) FROM tbl_ride";
		$query = $this->mysqli->query($sql);
		if ($query) {
			$this->result= $query->fetch_assoc();
			return true;
		}
		else{
			array_push($this->result, $this->mysqli->error);
			return false;
		}
	}
	public function all_user()
	{
		$sql= "SELECT count(*) FROM registration where is_admin=0";
		$query = $this->mysqli->query($sql);
		if ($query) {
			$this->result= $query->fetch_assoc();
			return true;
		}
		else{
			array_push($this->result, $this->mysqli->error);
			return false;
		}
	}

	public function service_location()
	{
		$sql= "SELECT count(*) FROM `tbl_location` WHERE is_available=1";
		$query = $this->mysqli->query($sql);
		if ($query) {
			$this->result= $query->fetch_assoc();
			return true;
		}
		else{
			array_push($this->result, $this->mysqli->error);
			return false;
		}
	}

	public function all_ride_fare_users($id)
	{
		$sql= "SELECT count(status), sum(total_fare) FROM `tbl_ride` WHERE cuser_id=$id";
		$query = $this->mysqli->query($sql);
		if ($query) {
			$this->result= $query->fetch_assoc();
			return true;
		}
		else{
			array_push($this->result, $this->mysqli->error);
			return false;
		}
	}

	public function get_update_user($id)
	{
		$sql= "SELECT email, name, mobile FROM `registration` WHERE user_id=$id";
		$query = $this->mysqli->query($sql);
		if ($query) {
			$this->result= $query->fetch_assoc();
			return true;
		}
		else{
			array_push($this->result, $this->mysqli->error);
			return false;
		}
	}
	public function get_location_data($id)
	{
		$sql= "SELECT * FROM `tbl_location` WHERE id=$id";
		$query = $this->mysqli->query($sql);
		if ($query) {
			$this->result= $query->fetch_assoc();
			return true;
		}
		else{
			array_push($this->result, $this->mysqli->error);
			return false;
		}
	}

	public function update_user($para=array(), $id)
	{
		$args= array();
		foreach ($para as $key => $value) {
			$args[]="$key = '$value'";
		}
		$sql= "UPDATE registration SET ". implode(', ', $args);
		$sql.=" WHERE user_id = $id";
		$query = $this->mysqli->query($sql);
		if ($query) {
			echo "Profile successfully updated..";
		}
		else{
			echo "Profile not updated";
		}
	}

	//////////////////////////////////////////////////////////////////
	
	function cedmicro($distt)
	{
		if( $distt>0 && $distt<=10)
		{
			$this->price=$distt*13.5;
		}
		elseif ($distt>10 && $distt<=60)
		{
			$distt_new= $distt-10;
			$this->price=$distt_new*12+135;
		}
		elseif ($distt>60 && $distt<=160)
		{
			$disttnew=$distt-60;
			$this->price=($disttnew*10.20)+735;
		}
		elseif($distt>160)
		{
			$new_distt=$distt-160;
			$this->price=1755+$new_distt*8.5;
		}
		$this->price+=50;
		return $this->price;
	}
	function cedmini($distt, $weigh){
		if( $distt>0 && $distt<=10)
		{
			$this->price=$distt*14.5;
		}
		elseif ($distt>10 && $distt<=60)
		{
			$distt_new= $distt-10;
			$this->price=$distt_new*13+145;
		}
		elseif ($distt>60 && $distt<=160)
		{
			$disttnew=$distt-60;
			$this->price=($disttnew*11.20)+795;
		}
		elseif($distt>160)
		{
			$new_distt=$distt-160;
			$this->price=1915+$new_distt*9.5;
		}	
		if ($weigh>0 && $weigh<=10){
			$this->price+=50;
		}
		elseif($weigh>10 && $weigh<=20){
			$this->price+=100;
		}
		elseif ($weigh>20) {
			$this->price+=200; 
		}
		else{}
			$this->price+=150;
		return $this->price;
	}
	function cedroyal($distt, $weigh){
		if( $distt>0 && $distt<=10)
		{
			$this->price=$distt*15.5;
		}
		elseif ($distt>10 && $distt<=60)
		{
			$distt_new= $distt-10;
			$this->price=$distt_new*14+155;
		}
		elseif ($distt>60 && $distt<=160)
		{
			$disttnew=$distt-60;
			$this->price=($disttnew*12.20)+855;
		}
		elseif($distt>160)
		{
			$new_distt=$distt-160;
			$this->price=2075+$new_distt*10.5;
		}	
		if ($weigh>0 && $weigh<=10){
			$this->price+=50;
		}
		elseif($weigh>10 && $weigh<=20){
			$this->price+=100;
		}
		elseif ($weigh>20) {
			$this->price+=200; 
		}
		else{}
			$this->price+=200;
		return $this->price;
	}
	function cedsuv($distt, $weigh){
		if( $distt>0 && $distt<=10)
		{
			$this->price=$distt*16.5;
		}
		elseif ($distt>10 && $distt<=60)
		{
			$distt_new= $distt-10;
			$this->price=$distt_new*14+165;
		}
		elseif ($distt>60 && $distt<=160)
		{
			$disttnew=$distt-60;
			$this->price=($disttnew*13.20)+915;
		}
		elseif($distt>160)
		{
			$new_distt=$distt-160;
			$this->price=2235+$new_distt*11.5;
		}	
		if ($weigh>0 && $weigh<=10){
			$this->price+=100;}
			elseif($weigh>10 && $weigh<=20){
				$this->price+=200;}
				elseif ($weigh>20) {
					$this->price+=400;}
					$this->price+=250;
					return $this->price;
				}

	/////////////////////////////////////////////////////////////////


				public function getResult()
				{
					$val = $this->result;
					$this->result = array();
					return $val;
				}

				public function __destruct()
				{
					if ($this->conn) {
						if($this->mysqli->close()){
							$this->conn= true;
						}
					}
					else{
						return false;
					}
				}
			}

			?>