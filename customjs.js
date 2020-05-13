

var date = new Date(), y = date.getFullYear(), m = date.getMonth();
var firstDay = new Date(y, m, 1);
var lastDay = new Date(y, m + 1, 0);





if(dzien<10)
{
  dzien="0"+dzien;
}
if(miesiac<10)
{
  miesiac="0"+miesiac;
}
if(poprzedniMiesiac<10)
{
  poprzedniMiesiac="0"+poprzedniMiesiac;
}

function currentDateYandM ()
	{
    alert(firstDay);
		document.getElementById("dateFromToCompute").innerHTML =firstDay;
		document.getElementById("dateFromToCompute").value = firstDay;
    document.getElementById("dateToToCompute").innerHTML =lastDay;
		document.getElementById("dateToToCompute").value = lastDay;
	}

function currentDateY ()
	{
		document.getElementById("currDate").innerHTML = firstDayOfYear+" do "+lastDayOfYear;
		document.getElementById("currDate").value = firstDayOfYear+" do "+lastDayOfYear;
	}

function previousDateYandM ()
	{
    var date = new Date();
    var firstDay = new Date(y, m, 1);
    var lastDay = new Date(y, m + 1, 0);
    alert(lastDay);
    document.getElementById("dateFromToWorkWith").value = previousFirstDay+" do "+previousLastDay;
    document.getElementById("dateFromToWorkWith").innerHTML = previousFirstDay+" do "+previousLastDay;
	}

function uncommonDate ()
{
  var dateFrom = document.getElementById("dateFrom").value;
  var dateTo = document.getElementById("dateTo").value;
  document.getElementById("dateFromToWorkWith").innerHTML = dateFrom+" do "+dateTo;
  document.getElementById("dateFromToWorkWith").value = dateFrom+" do "+dateTo;
}
