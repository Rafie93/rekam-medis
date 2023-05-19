(function($) {
    /* "use strict" */


 var dzChartlist = function(){
	let draw = Chart.controllers.line.__super__.draw; //draw shadow
	var screenWidth = $(window).width();
	
	var pieChart = function(){
		 var options = {
          series: [40, 15,25,30],
          chart: {
          type: 'donut',
		  
        },
		dataLabels: {
          enabled: false
        },
		stroke: {
          width: 0,
        },
		colors:['#5FBF91', '#FF6E5A', '#FFD439', '#5F74BF'],
		legend: {
              position: 'bottom',
			  show:false
            },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom',
			  show:false
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#pieChart"), options);
        chart.render();
    
	}

	var pieChart2 = function(){
		var options = {
			series: [42, 47, 52, 58],
			chart: {
				width: 230,
				type: 'polarArea',
				sparkline: {
					enabled: true,
				},
			},
			labels: ['Colestrol', 'Heart Beat', 'Stamina', 'Immunities'],
			fill: {
				opacity: 1,
				colors: ['#5FBF91', '#FF6E5A', '#FFD439', '#5F74BF']
			},
			stroke: {
				width: 0,
				colors: undefined
			},
			colors: ['#5FBF91', '#FF6E5A', '#FFD439', '#5F74BF'],
			yaxis: {
				show: false
			},
			legend: {
				position: 'bottom'
			},
			plotOptions: {
				polarArea: {
					rings: {
						strokeWidth: 0
					}
				}
			},
			theme: {
				monochrome: {
					enabled: true,
					shadeTo: 'light',
					shadeIntensity: 0.6
				}
			}
		};

        var chart = new ApexCharts(document.querySelector("#pieChart2"), options);
        chart.render();
	}
	/* Function ============ */
		return {
			init:function(){
			},
			
			
			load:function(){
				pieChart();
				pieChart2();
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