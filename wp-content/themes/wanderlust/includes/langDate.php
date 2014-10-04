<?php
function lang($word){
	return $word;
}

	function convertDateString($dateStr){
		$dateArr = explode('/',$dateStr);
		return $dateArr[2].'-'.$dateArr[0].'-'.$dateArr[1];
	}

	function today($modifyDateBy=false){
		if(!$modifyDateBy){
			$finalDate = date('Y-m-d H:i:s');
		}else{
			$finalDate = date( 'Y-m-d H:i:s',mktime(0, 0, 0, date("m")  , date("d")+$modifyDateBy, date("Y")) );
		}
		return $finalDate;
	}

	function getWeek($date){
		// set current date
		$date = date('Y-m-d H:i:s');
		// parse about any English textual datetime description into a Unix timestamp
		$ts = strtotime($date);
		// calculate the number of days since Monday
		$dow = date('w', $ts);
		$offset = $dow - 1;
		if ($offset < 0) $offset = 6;
		// calculate timestamp for the Monday
		$ts = $ts - $offset*86400;
		//Clear $days array
		$days = array();
		// loop from Monday till Sunday
		for ($i = 0; $i < 7; $i++, $ts += 86400){
			$days[] = date("d", $ts);
		}
		return $days;
	}	
	function sNumDate($date){
		$newdate = substr($date,0, strpos($date,' ') );
		$tiTXT = (trim($newdate) == '0000-00-00')? 'N/A' : $newdate ;
		return $tiTXT;
	}

	function fdate($unix_date,$modifyFormat=false){
		if(strtotime($unix_date) && ($unix_date != '0000-00-00 00:00:00') ){
			$meses = explode(',',lang('January,February,March,April,May,June,July,August,September,October,November,December'));
			array_unshift($meses, " ");
			$fecha = date('d', strtotime($unix_date));
			$anyo = date('Y', strtotime($unix_date));
			if ($modifyFormat==true){
				$mes = date('n', strtotime($unix_date));
				return $mes.'/'.$fecha.'/'.$anyo;
			}
			else{
			$mes = $meses[date('n', strtotime($unix_date))];
			return $mes.' '.$fecha.', '.$anyo;
			}
		}else{
			return lang('N/A');
		}
	}

	function sdate($unix_date,$modifyFormat=false){
		if(strtotime($unix_date) && ($unix_date != '0000-00-00 00:00:00') ){
			$meses = explode(',',lang('ene,feb,mar,abr,may,jun,jul,ago,sept,oct,nov,dec'));
			array_unshift($meses, " ");
			$fecha = date('d', strtotime($unix_date));
			$anyo = date('Y', strtotime($unix_date));
			if ($modifyFormat==true){
				$mes = date('n', strtotime($unix_date));
				return $fecha.'/'.$mes.'/'.$anyo;
			}
			else{
			$mes = $meses[date('n', strtotime($unix_date))];
	/*			$search = array('d','m','y');
			$replace= array($fecha,$mes,$anyo);
			$newDateString = str_replace($search,$replace,_DATE_FORMAT);
			return $newDateString;*/
			return $mes.'/'.$fecha.'/'.$anyo;
			}
		}else{
			return lang('N/A');
		}
	}
	
	function formatDate($dateStr,$first=true,$inverse=false){
		//For mm/dd/YYYY
		if(!$inverse){
			$dateArr = explode('/',$dateStr);
			$newDate = $dateArr[2].'-'.$dateArr[0].'-'.$dateArr[1];
			//Adding time
			if($first){
				$newDate.= ' 00:00:00';
			}else{
				$newDate.= ' 23:59:59';
			}
		}else{
			//For YYYY-mm-dd H:i:s
			$dateArr = explode(' ',$dateStr);
			$date = explode('-',$dateArr[0]);
			$time = $dateArr[1];
			$newDate = $date[1].'/'.$date[2].'/'.$date[0];
		}
	
		return $newDate;
	}
?>