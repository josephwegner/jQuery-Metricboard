

function textList(domObj) {

	this.init = function(domObj) {
		this.domObj = domObj;
		this.url = $(domObj).attr('refresh-url');
		this.rate = $(domObj).attr('refresh-rate');
		this.max = $(domObj).attr('max');
		
		if(typeof($(domObj).attr('useID')) !== "undefined") {
			this.useID = !!$(domObj).attr('useID');
		} else {
			this.useID = true;
		}
		
	
		if(typeof($(domObj).attr('key')) !== "undefined") {
			this.key = $(domObj).attr('key');
		}

		this.refreshData();

		var thisTextList = this;

		setInterval(function() { thisTextList.refreshData(); }, this.rate * 1000);
	};

	this.refreshData = function() {
		if(typeof(this.lastId) == "undefined") this.lastId = 0;
	
		var thisTextList = this;
		
		$.ajax({
			type: "POST",
			url: this.url,
			data: {
				'lastID': this.lastId,
				'count': this.max,
				'key': this.key
			},
			success: function(msg) {
				var json = $.parseJSON(msg);
				
				if(json.error) {
					alert(json.error);
				} else {
					thisTextList.lastId = json.lastID;
					thisTextList.drawData(json.items.reverse());
				}
			},
			error: function(msg) {
				alert(msg);
			}		
		});
	};

	this.drawData = function(htmlArray, index) {

		var thisTextList = this;

		if(typeof(index) == "undefined") index = 0;

		if(typeof(htmlArray[index]) !== "undefined") {	
			if(this.useID) {

				var newHTML = $(htmlArray[index]);

				$(newHTML).hide();

				if($(this.domObj).find("li").length >= this.max) {
					$(this.domObj).find("li").last().fadeOut(500, function() { $(this).remove();});
				}

				$(this.domObj).find("ul").prepend($(newHTML));
				$(newHTML).fadeIn(500, function() { thisTextList.drawData(htmlArray, index + 1); }); 
			} else {
				if($(this.domObj).find("li:nth-child(" + (index + 1) + ")").length === 1) {
					if($(this.domObj).find("li:nth-child(" + (index + 1) + ")").html() !== htmlArray[index]) {
						$(this.domObj).find("li:nth-child(" + index + ")").fadeOut(500, function() {
							$(this).replaceWith(htmlArray[index]);
							$(this).fadeIn(500, function() { thisTextList.drawData(htmlArray, index + 1); });
						});
					}
				} else {
					var newHTML = $(htmlArray[index]);
					$(newHTML).hide();
					$(this.domObj).find("ul").append(newHTML);
					$(newHTML).fadeIn(500, function() { thisTextList.drawData(htmlArray, index + 1); });
				}
			}
		}
	};

	this.init(domObj);
	
};
function pieChart(domObj) {

	this.init = function(domObj) {
		this.domObj = domObj;
		this.url = $(domObj).attr('refresh-url');
		this.rate = $(domObj).attr('refresh-rate');
		this.points = {};
		this.numPoints = 0;
		
		var height = $(domObj).height();
		
		this.chart = new Highcharts.Chart({
			chart: {
				renderTo: $(domObj).attr('id'),
				height: height,
				width: $(domObj).width(),
				backgroundColor: "#050505"
			},
			credits: {
				enabled: false
			},	
			title: {
				text: $(domObj).attr('title'),
				style: {
					color: '#FFFFFF'
				}
			},
			plotOptions: {
				pie: {
					showInLegend: true,
					dataLabels: {
						enabled: false
					}
				}
			},
			legend: {
				align: "left",
				width: $(domObj).width() / 2.5,
				floating: true,
				backgroundColor: "#FFFFFF",
				layout: "vertical"
			},
			series: [{
				type: 'pie',
				name: $(domObj).attr('title')

			}]
		});

		this.refreshData();

		var thisPieChart = this;

		setInterval(function() { thisPieChart.refreshData(); }, this.rate * 1000);

	};

	this.refreshData = function() {
		var thisPieChart = this;

		$.ajax({
			type: "POST",
			url: this.url,
			success: function(msg) {
				var json = $.parseJSON(msg);

				var dataPoints = [];
				for(op in json) {
					if(typeof(thisPieChart.points[op]) == "undefined") {
						thisPieChart.chart.series[0].addPoint({
							"name": op,
							"y": json[op]
						});
						thisPieChart.points[op] = thisPieChart.numPoints;
						thisPieChart.numPoints++;
					} else {
						thisPieChart.chart.series[0].data[thisPieChart.points[op]].update(y = json[op]);
					}
				}
			},
			error: function(msg) {
				alert(error);
			}
		});
	};

	this.init(domObj);
}
function numberWidget(domObj) {

	this.init = function(domObj) {
		this.domObj = domObj;
		this.url = $(domObj).attr('refresh-url');
		this.rate = $(domObj).attr('refresh-rate');
	
		if(typeof($(domObj).attr('key')) !== "undefined") {
			this.key = $(domObj).attr('key');
		}

		this.refreshData();

		var thisNumberWidget = this;

		setInterval(function() { thisNumberWidget.refreshData(); }, this.rate * 1000);
	};

	this.refreshData = function() {
		var thisNumberWidget = this;
		var to;

		$.ajax({
			type: "POST",
			url: this.url,
			data: { "key": this.key },
			success: function(msg) {
				msg = parseInt(msg);
				
				var span = $(thisNumberWidget.domObj).children(".numberNumber");

				if($(span).text() != msg) {
					if($(span).text() > msg) {
						to = setInterval(function() {
							$(span).text(parseInt($(span).text()) - 1);
							if($(span).text() == msg) clearTimeout(to);	
						}, 100);
					} else {
						to = setInterval(function() {
							$(span).text(parseInt($(span).text()) + 1);
							if($(span).text() == msg) clearTimeout(to);
						}, 100);						
					}
				}
			},
			error: function(msg) {
				alert(msg);
			}
		});

	};

	this.init(domObj);
}
	
(function( $ ) {

	$.initMetrics = function() {

		var charts = {};

		$(".widget").each(function() {
			switch($(this).attr('widget')) {
		
				case "textList":
					
					charts[$(this).attr('id')] = new textList($(this));

					break;

				case "number":
				
					charts[$(this).attr('id')] = new numberWidget($(this));
					
					break;
				
				case "pieChart":
		
					charts[$(this).attr('id')] = new pieChart($(this));				
				
					break;

				case "singleLine":
				
					var data = [];
					var height = $(this).height();
					
					$(this).children(".slData").find("li").each(function() {
						var point = {
							"label": $(this).children(".slColumn").html(),
							"value": $(this).children(".slValue").html()
						};

						data.push(point);
					});
				
					$(this).html("");
						
					charts[$(this).attr('id')] = new Highcharts.Chart({
						chart: {
							renderTo: $(this).attr('id'),
							height: height,
							backgroundColor: "#050505"
						},
						credits: {
							enabled: false
						},
						title: {
							text: $(this).attr('id') 
						},						
						height: $(this).height(),
						xAxis: {
							labels: {
								enabled: false
							},
							maxZoom: 7
						},
						yAxis: {
							title: {
								text: "# of Uploads"
							},
							plotLines: [{
								value: 0,
								width: 1,
								color: '#808080'
							}]
						},
						series: [{
							name: $(this).attr('title')
						}]
						
					});
					
					for(var i=0,max=data.length; i<max; i++) {
						charts[$(this).attr('id')].series[0].addPoint([data[i].label, data[i].value], true, false);
					}
				
					charts[$(this).attr('id')].yAxis[0].setExtremes(charts[$(this).attr('id')].yAxis[0].getExtremes().dataMin, charts[$(this).attr('id')].yAxis[0].getExtremes().dataMax);
	
					break;

				default:

			}

		});

		return charts;
	};

})(jQuery);
