$(document).ready(function() {
  data();
  graph3();
});

function data(){
  $.ajax({
      type : 'GET',
      url : '/dashboard/reports-admin',
      dataType : "json",
      success : function(data){
        renderData(data);
      }
    });
}


function renderData(data)
{
  var access_logs = data.access_logs;
  var users_categories = data.users_categories;

	graph1(access_logs);
  graph2(users_categories);
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
				'color' : '#6d9a39'
      };
      days.push(row);
  }
  console.log(days);

  // graph 2
  Highcharts.chart('container_access_users', {
      chart: {
        backgroundColor: 'transparent',
        borderWidth: 1,
        borderColor: '#8be523'
      },
	    title: {
	        text: 'Ingresos de Usuarios',
          style: {
            color: '#8be523'
          }
	    },
	    subtitle: {
	        text: 'Numero de ingresos por día',
          style: {
            color: '#fff'
          }
	    },
	    xAxis: {
	        type: 'category',
          labels: {
            style: {
              color: '#fff'
            }
          }
	    },
	    yAxis: {
	        title: {
            text: 'Numero Ingresos',
            style: {
              color: '#fff'
            }
          }
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

function graph2(users_categories) {
  console.log("users_categories");
  console.log(users_categories);

  var bills = [];
	var colors = ['#3bd1ff','#8be523','#ff2c2c','#fff558','#e5cefd']
  for(i=0;i < users_categories.rows.length; i++){
    var row = {
      'name' : users_categories.rows[i],
      'y' : parseInt(users_categories.users_count[i]),
			'color' : colors[i]
    };
    bills.push(row);
  }

  // Build the chart
  Highcharts.chart('container_users_categories', {
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie',
          backgroundColor: 'transparent',
          borderWidth: 1,
          borderColor: '#3bd1ff'
      },
      exporting: { enabled: false },
      title: {
          text: 'Usuarios por categoria',
          style: {
            color: '#3bd1ff'
          }
      },
      subtitle: {
          text: 'Porcentaje de usuarios por categoria',
          style: {
            color: '#fff'
          }
      },
      legend: {
        itemStyle: {
          color: '#fff'
        },
        itemHoverStyle: {
          color: '#d4d2d2'
        }
	    },
      tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage}%</b>'
      },
      plotOptions: {
          pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                  enabled: false
              },
              showInLegend: true
          }
      },
      series: [{
        name: 'Usuarios por categoria',
        colorByPoint: true,
        data:
        bills
      }]
    });
}

function graph3()
{
  Highcharts.chart('container_prizes', {
    data: {
        table: 'prizes',
        color : ['#ff2c2c', '#ccc']
    },
    chart: {
        type: 'column',
        backgroundColor: 'transparent',
        borderWidth: 1,
        borderColor: '#ff2c2c'
    },
    title: {
        text: 'Redención de premios',
        style: {
          color: '#ff2c2c'
        }
    },
    subtitle: {
        text: 'Numoro de redenciones por premio',
        style: {
          color: '#fff'
        }
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Cantidad',
            style: {
              color: '#ffffff'
            }
        },
        labels: {
          style: {
            color: '#fff'
          }
        }
    },
    xAxis: {
        labels: {
          style: {
            color: '#fff'
          }
        }
    },
    legend: {
      itemStyle: {
        color: '#fff'
      },
      itemHoverStyle: {
        color: '#d4d2d2'
      }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.point.y + ' ' + this.point.name.toLowerCase();
        }
    },
    colors : ['#ff2c2c', '#ccc']
  });
}
