
var dzisiaj = new Date();
var miesiac = dzisiaj.getMonth()+1;
var dzien = dzisiaj.getDate();
var rok = dzisiaj.getFullYear();

if(dzien<10)
{
  dzien="0"+dzien;
}
if(miesiac<10)
{
  miesiac="0"+miesiac;
}

function currentDateYMD (popo)
	{
		document.getElementById(popo).value = rok+"-"+miesiac+"-"+dzien;
	}
  function previousDateYMD (popo)
  {
      var prevD = dzien-1;
      if(prevD<10)
      {
        prevD="0"+prevD;
      }
  		document.getElementById(popo).value = rok+"-"+miesiac+"-"+prevD;
  }

function currentDateYandM ()
	{
		document.getElementById("currDate").innerHTML = miesiac+"/"+rok;
	}

function currentDateY ()
	{
		document.getElementById("currDate").innerHTML = rok;
	}

function previousDateYandM ()
	{
    document.getElementById("currDate").innerHTML = miesiac+"/"+rok;
	}

function uncommonDate ()
{
  var dateFrom = document.getElementById("dateFrom").value;
  var dateTo = document.getElementById("dateTo").value;
  document.getElementById("currDate").innerHTML = dateFrom+" === "+dateTo;
}

window.onload = start;

function start()
{
  document.getElementById("currDate").innerHTML = miesiac+"/"+rok;
}

function addCategoryIN ()
{
  var newCat = document.getElementById("catIN").value;
  var x = document.getElementById("inputGroupSelect01");
  var option = document.createElement("option");
  option.text = newCat;
  x.add(option);
  document.getElementById("catIN").value = "";
}
function addCategoryEX ()
{
  var newCat = document.getElementById("catEX").value;
  var x = document.getElementById("inputEX");
  var option = document.createElement("option");
  option.text = newCat;
  x.add(option);
  document.getElementById("catEX").value = "";
}
// function loadINcategory ()
// {
//   var innOptions = new Array();
//
//   innOptions = document.getElementById("inputGroupSelect01").value;
//   alert(arrray[3]);
//   var inCatTodel = document.getElementById("catINtoDel");
//   var option = document.createElement("option");
//     for(i=0; i<inCat.length; i++)
//     {
//       option.text = inCat.charAt(i);
//       x.add(option);
//     }
// }






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
