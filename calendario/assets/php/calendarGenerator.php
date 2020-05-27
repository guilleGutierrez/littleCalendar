<?php 

	//WE WILL USE SESSION VARIABLES FOR THE CALENDAR FORWARD AND BACKWARD
	session_start();
	
	//ADVANCE OR BACKWARD OF THE MONTHS
	$action = $_POST['action'];
	
	//IF WE RECEIVE AN ACTION WE EXECUTE THE FUNCTION
	if(!empty($action)){ generateCalendar($action); } 

	function generateCalendar($action){
		
		//WE ADD, SUBTRACT OR SHOW CURRENT MONTH DEPENDING ON THE ACTION
		
		if($action=='current'){
			
			$_SESSION['currentDate'] = date("Y-m-d");
			
		}else if($action=='previous'){
			
			$_SESSION['currentDate'] = date("Y-m-d", strtotime($_SESSION['currentDate']."- 1 month"));
			
		}else if($action=='next'){
			
			$_SESSION['currentDate'] = date("Y-m-d", strtotime($_SESSION['currentDate']."+ 1 month"));
			
		}
		
		//LETS DEFINE SOME VARS (i need some data to use later)
		
		//today
		$today = date('Y-m-d');
		
		//current month number
		$currentMonthNumber = date('m', strtotime($_SESSION['currentDate']));
		
		//current year number
		$currentYearNumber = date('Y', strtotime($_SESSION['currentDate']));
		
		//first day of the current month 
		$firstMonthDay = date('D', strtotime('first day of this month', strtotime($_SESSION['currentDate'])));
		
		//number of days in the current month
		$monthDays = cal_days_in_month(CAL_GREGORIAN, $currentMonthNumber, $currentYearNumber);
		
		//current month in text format
		$currentMonthText = date('F', strtotime($_SESSION['currentDate']));
		$nextMonthText = date("F", strtotime($_SESSION['currentDate']."+ 1 month"));
		$previousMonthText = date("F", strtotime($_SESSION['currentDate']."- 1 month"));
		
		//CALENDAR TEXTS ARE FILLED
		
		echo "
			<script>
				document.getElementById('calendarMonth').innerHTML = '$currentMonthText';
				document.getElementById('calendarMonthPrevious').innerHTML = '$previousMonthText';
				document.getElementById('calendarMonthNext').innerHTML = '$nextMonthText';
				document.getElementById('calendarYear').innerHTML = '$currentYearNumber';
			</script>
		";
		
		//I check which day of the week is the first day of the month and generate empty gaps to match the design with the real calendar
		
		$gaps = 0;
		
		if($firstMonthDay=='Mon'){$gaps = 0;}
		else if($firstMonthDay=='Tue'){$gaps = 1;}
		else if($firstMonthDay=='Wed'){$gaps = 2;}
		else if($firstMonthDay=='Thu'){$gaps = 3;}
		else if($firstMonthDay=='Fri'){$gaps = 4;}
		else if($firstMonthDay=='Sat'){$gaps = 5;}
		else if($firstMonthDay=='Sun'){$gaps = 6;}
		
		//I create the initial gaps
		while ($gaps>=1) {
			//I draw the initial gaps
			echo "<div class='gapDay' onclick='alert(`You can develop here your own function`);'> - </div>";
			//subtract 1 gap in each pass of the loop
			$gaps = $gaps - 1;
		}
		
		//I create the days of the month 
		//the id of each day of the month will be the current date, so we will have to add a day in each pass of the loop until completing the month
		$dateAdvance = date('Y-m-d', strtotime($currentYearNumber.'-'.$currentMonthNumber.'-'.'1'));
		
		while ($monthDays>=1) {
			
			//i draw the days of the month
			$dayColor = '';
			
			//I check what day of the week it is to load the appropriate class
			$weekDay = date("D", strtotime($dateAdvance));
			
			if($dateAdvance==$today){$dayColor='today';}
			else if($weekDay=='Sat'){$dayColor='saDay';}
			else if($weekDay=='Sun'){$dayColor='partyDay';}
			else{$dayColor='normalDay';}
		
			//This is the current day in the calendar 
			$currentDay = date("j", strtotime($dateAdvance));
			
			echo "<div class='monthDay $dayColor' id='$dateAdvance' onclick='alert(`$dateAdvance - Develop your own functions here`);'> $currentDay </div>";
			
			//we add a day to the advance of the date
			$dateAdvance = date("Y-m-d", strtotime($dateAdvance."+ 1 day"));
			
			//substract 1 day in each pass of the loop
			$monthDays = $monthDays - 1;
			
		}
		
	}

?>