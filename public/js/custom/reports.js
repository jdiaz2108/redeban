$(document).ready(function() {
    data();
    graph3();
    graph4();
    graph5();
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
    var access_sections = data.access_sections;
    var fulfillments_category = data.fulfillments_category;

    graph1(access_logs);
    graph2(users_categories);
    graph6(access_sections);
    graph7(fulfillments_category);
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

  Highcharts.chart('container_access_users', {
      chart: {
        backgroundColor: 'transparent',
        // borderWidth: 1,
        // borderColor: '#8be523'
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
	        },
          line: {
            color: '#8be523'
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
	var colors = ['#ffd400','#969696','#ff2c2c','#e56b23','#e6a329']
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
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
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
  Highcharts.chart('container_prizes_oro', {
    data: {
        table: 'prizes_oro',
        color : ['#ffd400', '#ccc']
    },
    chart: {
        type: 'column',
        backgroundColor: 'transparent',
        // borderWidth: 1,
        // borderColor: '#ffd400'
    },
    title: {
        text: 'Redención de premios Categoria Oro',
        style: {
          color: '#ffd400'
        }
    },
    subtitle: {
        text: 'Numero de redenciones por premio',
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
    colors : ['#ffd400', '#ccc']
  });
}

function graph4()
{
  Highcharts.chart('container_prizes_plata', {
    data: {
        table: 'prizes_plata',
        color : ['#969696', '#ccc']
    },
    chart: {
        type: 'column',
        backgroundColor: 'transparent',
        // borderWidth: 1,
        // borderColor: '#969696'
    },
    title: {
        text: 'Redención de premios Categoria Plata',
        style: {
          color: '#969696'
        }
    },
    subtitle: {
        text: 'Numero de redenciones por premio',
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
        color: '#969696'
      }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.point.y + ' ' + this.point.name.toLowerCase();
        }
    },
    colors : ['#969696', '#fff']
  });
}

function graph5()
{
  Highcharts.chart('container_prizes_bronce', {
    data: {
        table: 'prizes_bronce',
        color : ['#ff2c2c', '#ccc']
    },
    chart: {
        type: 'column',
        backgroundColor: 'transparent',
        // borderWidth: 1,
        // borderColor: '#ff2c2c'
    },
    title: {
        text: 'Redención de premios Categoria Bronce',
        style: {
          color: '#ff2c2c'
        }
    },
    subtitle: {
        text: 'Numero de redenciones por premio',
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

function graph6(access_sections){
  console.log("access_sections");
  console.log(access_sections);
  var days = [];
	var access_all = access_sections.total;

  for(i=0;i < access_sections.sections.length; i++){
      var row = {
        'name' : access_sections.sections[i],
        'y' : parseInt(access_sections.rows[i]),
				'color' : '#6d9a39'
      };
      days.push(row);
  }
  console.log(days);

  Highcharts.chart('container_sections', {
      chart: {
        backgroundColor: 'transparent',
        // borderWidth: 1,
        // borderColor: '#8be523'
      },
	    title: {
	        text: 'Ingresos a Secciones',
          style: {
            color: '#8be523'
          }
	    },
	    subtitle: {
	        text: 'Numero de ingresos por sección',
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
	        },
          line: {
            color: '#8be523'
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

function graph7(fulfillments_category){
  console.log("fulfillments_category");
  console.log(fulfillments_category);
  var categories = [];
	var total = fulfillments_category.total;

  for(i=0;i < fulfillments_category.categories.length; i++){
      var row = {
        'name' : fulfillments_category.categories[i],
        'y' : parseInt(fulfillments_category.categories[i]),
				'color' : '#3bd1ff'
      };
      categories.push(row);
  }
  console.log(categories);

  Highcharts.chart('container_fulfillments_category', {
      chart: {
        backgroundColor: 'transparent',
        // borderWidth: 1,
        // borderColor: '#3bd1ff'
      },
	    title: {
	        text: 'Cumplimientos por Categoria',
          style: {
            color: '#3bd1ff'
          }
	    },
	    subtitle: {
	        text: 'Numero de codigos unicos que cumplen con la meta actual',
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
            text: 'Numero codigos unicos',
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
	        },
          line: {
            color: '#3bd1ff'
          }
	    },
	    tooltip: {
	        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
	        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> de '+total+'<br/>'
	    },
	    series: [{
	      name: 'Numero de codigos unicos',
	      data: categories
	    }]
	});
}
