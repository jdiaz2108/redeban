$(document).ready(function() {
  data();
});

function data(){
  $.ajax({
      type : 'GET',
      url : '/dashboard/reports-access',
      dataType : "json",
      success : function(data){
        renderData(data);
      }
    });
}


function renderData(data)
{
  var access_logs = data.access_logs;

	graph1(access_logs);
}


function graph1(access_logs){
  console.log("access_logs");
  console.log(access_logs);
  var days = [];
	var access_all = access_logs.total;

  for(i=0;i < access_logs.days.length; i++){
      var row = {
        'name' : access_logs.days[i],
        'y' : parseInt(access_logs.rows[i]),
				'color' : '#3bd1ff'
      };
      days.push(row);
  }
  console.log(days);

  // graph 2
  Highcharts.chart('container_access_users', {
      chart: {
        backgroundColor: 'transparent'
      },
	    title: {
	        text: 'Ingresos de Usuarios',
          style: {
            color: '#fff'
          }
	    },
	    subtitle: {
	        text: 'Numero de ingresos por día',
          style: {
            color: '#fff'
          }
	    },
	    xAxis: {
	        type: 'category'
	    },
	    yAxis: {
	        title: { text: 'Numero Ingresos' }
	    },
	    legend: {
	        enabled: false
	    },
	    plotOptions: {
	        series: {
	            borderWidth: 0,
	            dataLabels: {
	                enabled: true
	            }
	        }
	    },
	    tooltip: {
	        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
	        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> de '+access_all+'<br/>'
	    },
	    series: [{
	      name: 'Ingresos por día',
	      data: days
	    }]
	});
}
