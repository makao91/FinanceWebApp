//WYKRESY
// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChartIncomes);
google.charts.setOnLoadCallback(drawChartExpenses);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChartIncomes()
{

  // Create the data table.
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Topping');
  data.addColumn('number', 'Slices');
  data.addRows([
    ['Mushrooms', 3],
    ['Onions', 1],
    ['Olives', 1],
    ['Zucchini', 1],
    ['Pepperoni', 2]
  ]);

  // Set chart options
  var options = {'title':'Twoje przychody',
                 'width':600,
                 'height':450};

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.PieChart(document.getElementById('chart_div_inn'));
  chart.draw(data, options);
}
function drawChartExpenses() {

  // Create the data table.
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Topping');
  data.addColumn('number', 'Slices');
  data.addRows([
    ['Mushrooms', 3],
    ['Onions', 1],
    ['Olives', 1],
    ['Zucchini', 1],
    ['Pepperoni', 2]
  ]);

  // Set chart options
  var options = {'title':'Twoje wydatki',
                 'width':600,
                 'height':450};

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.PieChart(document.getElementById('chart_div_exp'));
  chart.draw(data, options);
}


//sticky nav bar from j.querry
$(document).ready(function() {
	var NavY = $('.nav').offset().top;

	var stickyNav = function(){
	var ScrollY = $(window).scrollTop();

	if (ScrollY > NavY) {
		$('.nav').addClass('sticky', 'stickyL', 'stickyR');
	} else {
		$('.nav').removeClass('sticky', 'stickyR', 'stickyR');
	}
	};

	stickyNav();

	$(window).scroll(function() {
		stickyNav();
	});
	});
