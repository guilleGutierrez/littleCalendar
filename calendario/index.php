<html>
	<!--In order to keep the code tidy, I create the header in a separate file-->
	<head> <?php include_once('assets/php/head.php');?> </head>
	<body> 
		<!--The calendar has a responsive design, so just modify the width in the style sheet to adapt it to your design-->
		<div class="calendarContainer" id="calendarContainer">
			<div id="calendarYear"> </div>
			<div class="calendarHeader">
				<div class="calendarArrowDiv"> <i class="fas fa-caret-square-left calendarArrowIcon" id="btnPrevious"></i> </div>
				<div class="calendarMonthYear"> 
					<div id="calendarMonthPrevious"> </div>
					<div id="calendarMonth"> </div>
					<div id="calendarMonthNext"> </div>
				</div>
				<div class="calendarArrowDiv"> <i class="fas fa-caret-square-right calendarArrowIcon" id="btnNext"></i> </div>
			</div>
			<div id="weekDays"></div>
			<div id="calendarBody"></div>
		</div>
		<div class="copy"> &copy; <?php echo date('Y');?> - Guillermo Gutiérrez - guillegutierrezgomez@gmail.com </div>
	</body>
</html>