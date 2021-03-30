$(function() {

	new Chartist.Line('#moodChart', moodData, {
		lineSmooth: false
	});
	new Chartist.Bar('#answersChart', answersData, {
		horizontalBars: true,
		reverseData: true,
		axisX: {
            ticks: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            low: 0,
            high: 10,
		},
	});

});