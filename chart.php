<?php
$conn = oci_connect('demo', 'system', 'localhost:1521/xe');
$query = 'SELECT d.doctor_id, COUNT(appt_id) FROM appointments a RIGHT OUTER JOIN doctors d ON d.doctor_id = a.doctor_id GROUP BY d.doctor_id';
$stid = oci_parse($conn, $query);
$row = oci_execute($stid);
$chart_data = "";
while ($row = oci_fetch_array($stid)) {

  $docid[]  = $row['DOCTOR_ID'];
  $apptnum[] = $row['COUNT(APPT_ID)'];
}
?>


<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<body>
  <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
  <script>
    var barColors = ["#C7BBBC", "#CED6E0", "#b7cfb7", "#f6eac2", "#f5d2d3"];
    new Chart("myChart", {
      type: "bar",
      data: {
        labels: <?php echo json_encode($docid); ?>,
        datasets: [{
          backgroundColor: barColors,
          data: <?php echo json_encode($apptnum); ?>
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "Number of Appointments According to Doctor ID",
          fontSize: 18
        },
        scales: {
          yAxes: [{
            scaleLabel: {
              display: true,
              labelString: "Number of Appointments",
            },
            ticks: {
              beginAtZero: true,
              stepSize: 1
            }
          }],
          xAxes: [{
            scaleLabel: {
              display: true,
              labelString: "Doctor ID",
            }
          }]
        }
      }
    });
  </script>

</body>

</html>
