<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Chrome',<?=$chrome?>],
	 	 ['Firefox',<?=$firefox?>],
	  	['IE',<?=$IE?>],
	  	['Safari',<?=$safari?>],
	  	['Opera',<?=$opera?>],
	  	['Edge',<?=$edge?>],
	  ['chromium',<?=$chromium?>]
        ]);

        var options = {
          title: '',
          pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
      google.charts.setOnLoadCallback(drawChart2); //Hàm Xuất Browser
	  function drawChart2() {
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Topping');
	data.addColumn('number', 'Slices');
	data.addRows([
	  ['Android',<?=$android?>],
	  ['IOS',<?=$ios?>],
	  ['WinDows',<?=$windows?>],
	  ['Windows Phone',<?=$windowsphone?>],
	  ['mac',<?=$mac?>],
	  ['Linux',<?=$linux?>],
	  ['Other',<?=$other?>]
	]);
	var options = {'title':''/*'Biểu đồ thống kê số lượng browser được sử dụng truy cập'*/,
				   
				   };
	var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
	chart.draw(data, options); // Hàm Xuất OS
  } 
</script>