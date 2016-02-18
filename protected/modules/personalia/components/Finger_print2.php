<?php

class Finger_print extends CApplicationComponent{	
	public function getScan(){
		ini_set('max_execution_time', 300);

		// manipulasi soap untuk mesin fingerprint		
		$error 		= 'true';
		$IP 		= "sig.tigade.co:6001";
		$Key 		= "0";		
		$Connect 	= @fsockopen($IP, "80", $errno, $errstr, 1);
		
		if($Connect){			
			$soap_request = "<GetAttLog>
								<ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey>
								<Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg>
							</GetAttLog>";			

			$newLine = "\r\n";

			fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
		    fputs($Connect, "Content-Type: text/xml".$newLine);
		    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
		    fputs($Connect, $soap_request.$newLine);
									
			$buffer="";
			
			while($Response=fgets($Connect, 1024)){
				$buffer=$buffer.$Response;
			}
			
			$error='false';

			include("parse.php");
			$buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
			$buffer=explode("\r\n",$buffer);		
			
			for($a=0;$a<count($buffer);$a++){
				$data 			= Parse_Data($buffer[$a],"<Row>","</Row>");
				$PIN 			= Parse_Data($data,"<PIN>","</PIN>");
				$Time 			= Parse_Data($data,"<DateTime>","</DateTime>");
				$Verified 		= Parse_Data($data,"<Verified>","</Verified>");				
				$Tanggal 		= substr($Time,0,10);
				$Waktu 			= substr($Time,10,10);		
				$cektime    	= substr($Time,10,3);
				$count_check 	= count(TbAbsensi::model()->findByAttributes(array('Tanggal'=>$Tanggal,'NIK'=>$PIN)));
				   
				if($cektime>=06 and $cektime<13){
					$Status=0;
				}
				else $Status=1;														

				if($Status==0 and $PIN!=0 and $count_check==0){
					$absen 				= new TbAbsensi;
					$absen->NIK 		= $PIN;
					$absen->Jam_Masuk 	= $Waktu;
					$absen->Tanggal 	= $Tanggal;							
					$absen->save();
				}
				elseif($Status==1 and $PIN!=0 and $count_check!=0){					
					$absen 					= TbAbsensi::model()->findByAttributes(array('Tanggal'=>$Tanggal,'NIK'=>$PIN));
					$absen->Jam_Keluar 		= $Waktu;
					$seconds 				= strtotime($Waktu)-strtotime($absen->Jam_Masuk);
					$hours 					= floor($seconds/3600);
					$minutes 				= floor(($seconds-($hours*3600))/60);
					$seconds 				= $seconds-(($minutes*60)+($hours*3600));
					$interval 				= $hours.':'.$minutes.':'.$seconds;
					$absen->Total_Jam_Kerja = $interval;
					$absen->save();
				}			
			}		
		}
		else Yii::app()->user->setFlash('error', 'Web tidak terhubung dengan mesin fingerprint.');		
	}
}