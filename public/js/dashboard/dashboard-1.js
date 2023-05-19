(function($) {
    /* "use strict" */


 var dzChartlist = function(){
	let draw = Chart.controllers.line.__super__.draw; //draw shadow
	var screenWidth = $(window).width();
	
	var radialBar = function(){
		var options = {
          series: [64, 73, 48],
          chart: {
          height: 330,
          type: 'radialBar',
        },
        plotOptions: {
          radialBar: {
			startAngle: -180,
			endAngle: 180,
			 hollow: {
				margin: 0,
				size: '30%',
				background: 'transparent',
			  },
			  
			  track: {
				show: true,
				background: '#e1e5ff',
				strokeWidth: '10%',
				opacity: 1,
				margin: 15, // margin is in pixels
			  },
            dataLabels: {
              name: {
                fontSize: '18px',
              },
              value: {
                fontSize: '16px',
              },
            }
          }
        },
	  colors:['#BDA25C','#209F84','#323232'],
        labels: ['New Patient', 'Recovered', 'In Treatment'],
        };

        var chart = new ApexCharts(document.querySelector("#radialBar"), options);
        chart.render();
	}
	var radialBar2 = function(){
		var options = {
          series: [40, 81, 50],
          chart: {
          height: 330,
          type: 'radialBar',
        },
        plotOptions: {
          radialBar: {
			startAngle: -180,
			endAngle: 180,
			 hollow: {
				margin: 0,
				size: '30%',
				background: 'transparent',
			  },
			  
			  track: {
				show: true,
				background: '#e1e5ff',
				strokeWidth: '10%',
				opacity: 1,
				margin: 15, // margin is in pixels
			  },
            dataLabels: {
              name: {
                fontSize: '18px',
              },
              value: {
                fontSize: '16px',
              },
            }
          }
        },
	  colors:['#BDA25C','#209F84','#323232'],
        labels: ['New Patient', 'Recovered', 'In Treatment'],
        };

        var chart = new ApexCharts(document.querySelector("#radialBar2"), options);
        chart.render();
	}
	var radialBar3 = function(){
		var options = {
          series: [90,75, 30],
          chart: {
          height: 330,
          type: 'radialBar',
        },
        plotOptions: {
          radialBar: {
			startAngle: -180,
			endAngle: 180,
			 hollow: {
				margin: 0,
				size: '30%',
				background: 'transparent',
			  },
			  
			  track: {
				show: true,
				background: '#e1e5ff',
				strokeWidth: '10%',
				opacity: 1,
				margin: 15, // margin is in pixels
			  },
            dataLabels: {
              name: {
                fontSize: '18px',
              },
              value: {
                fontSize: '16px',
              },
            }
          }
        },
	  colors:['#BDA25C','#209F84','#323232'],
        labels: ['New Patient', 'Recovered', 'In Treatment'],
        };

        var chart = new ApexCharts(document.querySelector("#radialBar3"), options);
        chart.render();
	}
	
	var chartTimeline = function(){
		var optionsTimeline = {
			chart: {
				type: "bar",
				height: 300,
				stacked: true,
				toolbar: {
					show: false
				},
				sparkline: {
					//enabled: true
				},
				offsetX: 0,
			},
			series: [
				 {
					name: "New",
					data: [20, 40, 60, 35, 50, 70, 30]
				},
				{
					name: "Recovered",
					data: [-28, -32, -12, -24, -35, -18, -30]
				} 
			],
			
			plotOptions: {
				bar: {
					columnWidth: "30%",
					colors: {
						backgroundBarColors: ['#F0F0F0', '#F0F0F0', '#F0F0F0', '#F0F0F0', '#F0F0F0', '#F0F0F0', '#F0F0F0'],
						backgroundBarOpacity: 1,
						opacity:0
					},

				},
				distributed: true
			},
			colors:['#BDA25C', '#209F84'],
			
			grid: {
				show: false,
			},
			legend: {
				show: false
			},
			fill: {
				opacity: 1
			},
			dataLabels: {
				enabled: false,
				colors:['#BDA25C', '#209F84'],
				dropShadow: {
					enabled: true,
					top: 1,
					left: 1,
					blur: 1,
					opacity: 1
				}
			},
			xaxis: {
				categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
				labels: {
					style: {
						colors: '#787878',
						fontSize: '13px',
						fontFamily: 'Poppins',
						fontWeight: 400
						
					},
				},
				crosshairs: {
					show: false,
				},
				axisBorder: {
					show: false,
				},
			},
			
			yaxis: {
				show: false,
			},
			
			tooltip: {
				x: {
					show: true
				}
			}
		};
		var chartTimelineRender =  new ApexCharts(document.querySelector("#chartTimeline"), optionsTimeline);
		 chartTimelineRender.render();
	}
	var chartBar = function(){
		var chartBarRunningOptions = {
				  series: [
					{
						name: 'Running',
						data: [50, 18, 70, 40, 90, 70, 20, 55, 25],
					}, 
					{
					  name: 'Cycling',
					  data: [80, 40, 55, 20, 45, 30, 80, 45, 15]
					}, 
					
				],
				chart: {
				type: 'bar',
				height: 370,
				
				toolbar: {
					show: false,
				},
				
			},
			plotOptions: {
			  bar: {
				horizontal: false,
				columnWidth: '75%',
				
			  },
			},
			colors:['#007A64', '#BDA25C'],
			dataLabels: {
			  enabled: false,
			},
			markers: {
				shape: "circle",
			},
			legend: {
				show: true,
				fontSize: '12px',
				offsetY:8,
				labels: {
					colors: '#000000',
					
					},
				markers: {
				width: 18,
				height: 18,
				strokeWidth: 0,
				strokeColor: '#fff',
				fillColors: undefined,
				radius: 0,	
				}
			},
			stroke: {
			  show: true,
			  width: 4,
			  colors: ['transparent']
			},
			grid: {
				borderColor: '#eee',
			},
			xaxis: {
				
			  categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
			  labels: {
			   style: {
				  colors: '#787878',
				  fontSize: '13px',
				  fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
				},
			  },
			  crosshairs: {
			  show: false,
			  }
			},
			yaxis: {
				labels: {
					offsetX:-16,
				   style: {
					  colors: '#787878',
					  fontSize: '13px',
					   fontFamily: 'poppins',
					  fontWeight: 100,
					  cssClass: 'apexcharts-xaxis-label',
				  },
			  },
			},
			fill: {
			  opacity: 1,
			  colors:['#007A64', '#BDA25C'],
			},
			tooltip: {
			  y: {
				formatter: function (val) {
				  return "$ " + val + " thousands"
				}
			  }
			},
			 responsive: [{
				breakpoint: 575,
				options: {
					plotOptions: {
					  bar: {
						columnWidth: '40%',
						
					  },
					},
					chart:{
						height:250,
					}
				}
			 }]
			};

			var chartBarRunningObject = new ApexCharts(document.querySelector("#chartBar"), chartBarRunningOptions);
			chartBarRunningObject.render();
	}
	var lineChart = function(){
		var options = {
          series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62]
        }],
          chart: {
          height: 250,
          type: 'line',
		  toolbar: {
			show:false,  
		  },
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth',
		  width:4,
        },
        title: {
			show:false,
          align: 'left'
        },
        grid: {
			show:false,
        },
		colors:['#007A64'],
		yaxis: {
			show:false,
		},
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        }
        };

        var chart = new ApexCharts(document.querySelector("#lineChart"), options);
        chart.render();
	}
	/* Function ============ */
		return {
			init:function(){
			},
			
			
			load:function(){
				radialBar();
				radialBar2();
				radialBar3();
				chartTimeline();
				chartBar();
				lineChart();
			},
			
			resize:function(){
				
			}
		}
	
	}();

	jQuery(document).ready(function(){
	});
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dzChartlist.load();
		}, 1000); 
		
	});

	jQuery(window).on('resize',function(){
		
		
	});     

})(jQuery);