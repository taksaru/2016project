$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		var calendar = $('#calendar').fullCalendar({
			header: {
				

				left: 'prev,next today',
				left: 'title'

			},
			
			
			events: 
			[
				/*
					- EACH EVENT HAS
						ID
						TITLE
						optional - START
						optional - END
						URL LINK TO THE INFO
				*/

				{
					id: 999,
					title: 'Munster - Culture Fest',
					start: new Date(2016, 1, 2),
					url: 'http://google.com/'

				},
				{
					id: 999,
					title: 'Ulster - Epic Rock Concert',
					start: new Date(2016, 1, 22),
					end: new Date(2016, 1, 24),
					url: 'http://google.com/'
				},
				{
					id: 999,
					title: 'Ulster - Dog Competition',
					start: new Date(2016, 1, 10),
					end: new Date(2016, 1, 13),
					url: 'http://google.com/'
				},
				
				{
					id: 999,
					title: 'Munster - Environmental Awarness *',
					start: new Date(2016, 1, 28),
					end: new Date(2016, 1, 29),
					url: 'http://google.com/'
				},
				{
					id: 999,
					title: 'Connuct - Litary Festival',
					start: new Date(2016, 2, 2),
					url: 'http://google.com/'
				}

			]
		});
		
	});