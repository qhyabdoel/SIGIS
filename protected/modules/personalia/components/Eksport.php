<?php

class Eksport extends Excel{	
	private $sql 	= null;	

	public function setGenerate($query, $count){
		return $this->sql	 = array('query'=>$query, 'count'=>$count);
		// return $this->column = $count;
	}

	public function getGenerate(){
		// echo $this->sql['query'];
		// echo "<br>";
		// echo $this->sql['count'];
		// die();

		#koneksi ke mysql
		$mysqli = new mysqli("localhost","root","","sigis2");

		if ($mysqli->connect_error) {
		    die('Connect Error (' . $mysqli->connect_error . ') ');
		}
		#akhir koneksi

		#ambil data		
		$sql 	= $mysqli->query($this->sql['query']);
		$arrmhs = array();

		// print_r($sql);
		// die();

		while ($row = $sql->fetch_assoc()){
			array_push($arrmhs, $row);
		}
		#akhir data

		$excel = new Excel();

		if($this->sql['count']==1){			
			#Send Header
			$excel->setHeader('absensi.xls');
			$excel->BOF();
			
			#header tabel
			$excel->writeLabel(0, 0, "NIK");
			$excel->writeLabel(0, 1, "TANGGAL");
			$excel->writeLabel(0, 2, "KEHADIRAN");
			$excel->writeLabel(0, 3, "CUTI");
			$excel->writeLabel(0, 4, "IJIN");
			$excel->writeLabel(0, 5, "SAKIT");
			$excel->writeLabel(0, 6, "ALPA");			
		}
		else{
			#Send Header
			$excel->setHeader('absensi.xls');
			$excel->BOF();

			#header tabel			
			$excel->writeLabel(0, 0, "NIK");
			$excel->writeLabel(0, 1, "NAMA");
			$excel->writeLabel(0, 2, "TANGGAL");
			$excel->writeLabel(0, 3, "JAM MASUK");
			$excel->writeLabel(0, 4, "JAM PULANG");
			$excel->writeLabel(0, 5, "TOTAL JAM KERJA");
		}

		#isi data
		$i = 1;
		foreach($arrmhs as $baris){
			$j= 0;

			foreach($baris as $value){
				$excel->writeLabel($i, $j, $value);
				$j++;
			}

			$i++;
		}

		$excel->EOF();

		exit();
	}	
}