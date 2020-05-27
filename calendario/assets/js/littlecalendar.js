$(document).ready(function() {
	
	monthCall('current');//initial calendar
	createBtns();
	chargeHeaderDaysText();
	
	
});

$(window).resize(function () {
	
   chargeHeaderDaysText();
   
});

//PREVIOUS & NEXT MONTH

function createBtns(){
	
	btnNext = document.getElementById("btnNext");
	btnPrevious = document.getElementById("btnPrevious");
	btnNext.onclick = function(){monthCall('next');};
	btnPrevious.onclick = function(){monthCall('previous');};
	
}

//CHECK DISPLAY WIDTH TO SHOW FULL OR SHORT DAYS

function chargeHeaderDaysText(){
	
	if (screen.width < 650){
	   document.getElementById('weekDays').innerHTML = "<div class='weekDay week'> Mon </div><div class='weekDay week'> Tue </div><div class='weekDay week'> Wed </div><div class='weekDay week'> Thu </div><div class='weekDay week'> Fri </div><div class='weekDay sa'> Sat </div><div class='weekDay su'> Sun </div>";
	} else {
		document.getElementById("weekDays").innerHTML = "<div class='weekDay week'> Monday </div><div class='weekDay week'> Tuesday </div><div class='weekDay week'> Wednesday </div><div class='weekDay week'> Thursday </div><div class='weekDay week'> Friday </div><div class='weekDay sa'> Saturday </div><div class='weekDay su'> Sunday </div>";
	}
	
}

//CALL TO THE CALENDAR GENERATOR

function monthCall(action){
		
	var callConfig = {
			action:action
		}; 
	
	$.ajax({
		type: "POST",
		url: "assets/php/calendarGenerator.php",
		data: callConfig,
		dataType: "html",
		beforeSend: function(){
			$("#calendarBody").empty();
		},
		error: function(){
			alert("call failed");
		},
		success: function(data){
			$("#calendarBody").empty();
			$("#calendarBody").append(data);
		}
	});	
	
}