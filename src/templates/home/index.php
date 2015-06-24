<?php
include '../templates/partials/header.php';
include '../templates/partials/menu.php';

?>

<div class="container-fluid">
	<div class="row">
		<?php include '../templates/partials/sidenav.php'; ?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<h2 class="sub-header">Incidenten rapportage afgelopen maand</h2>
			<div class="col-md-7">
			</div>
			<div class="col-md-5">
				<h2 class="sub-header">Incidenten op Category</h2>
				<div class="col-md-10">
				<canvas id="chartCategory" height="150px"></canvas>
				</div>
				<div id="categoryLegend" class="col-md-2">
				</div>
			</div>
		</div>
	</div>

	<style>
		.pie-legend {
			list-style: none;
			position: absolute;
			right: 8px;
			top: 0;
		}
		.pie-legend li {
			display: block;
			padding-left: 30px;
			position: relative;
			margin-bottom: 4px;
			border-radius: 5px;
			padding: 2px 8px 2px 28px;
			font-size: 14px;
			cursor: default;
			-webkit-transition: background-color 200ms ease-in-out;
			-moz-transition: background-color 200ms ease-in-out;
			-o-transition: background-color 200ms ease-in-out;
			transition: background-color 200ms ease-in-out;
		}
		.pie-legend li:hover {
			background-color: #fafafa;
		}
		.pie-legend li span {
			display: block;
			position: absolute;
			left: 0;
			top: 0;
			width: 20px;
			height: 100%;
			border-radius: 3px;
		}
	</style>
	<script src="/js/chart.min.js"></script>
	<script>
	// Self invoking function - Stuff to generate charts
	(function(){
		var helpers = Chart.helpers;
		Chart.defaults.global.responsive = true;
		var data = <?=$chartCategory?>;
		var canvas = document.getElementById('chartCategory');
		var ctx = document.getElementById("chartCategory").getContext("2d");
		var chartCategory = new Chart(ctx).Pie(data, { tooltipTemplate : "<%if (label){%><%=label%>: <%}%><%= value %> incidenten", animation: false });

		var legendHolder = document.createElement('div');
		legendHolder.innerHTML = chartCategory.generateLegend();
		legendHolder.className = "list-group";
		// Include a html legend template after the module doughnut itself
		helpers.each(legendHolder.firstChild.childNodes, function(legendNode, index){
			helpers.addEvent(legendNode, 'mouseover', function(){
				var activeSegment = chartCategory.segments[index];
				activeSegment.save();
				activeSegment.fillColor = activeSegment.highlightColor;
				chartCategory.showTooltip([activeSegment]);
				activeSegment.restore();
			});
		});
		helpers.addEvent(legendHolder.firstChild, 'mouseout', function(){
			chartCategory.draw();
		});

		document.getElementById('categoryLegend').appendChild(legendHolder.firstChild);
	})();

</script>

<?php
include '../templates/partials/footer.php';
?>