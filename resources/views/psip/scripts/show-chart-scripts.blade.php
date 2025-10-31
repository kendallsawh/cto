<script src="
https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js
"></script>

<script>

    // Decode and extract data
    const rawData = JSON.parse({!! json_encode($draft_estimates) !!});
    const labels = rawData.map(item => item.draft_est_year);
    const data = rawData.map(item => parseFloat(item.draft_est));
    const ctx = document.getElementById('Projections');

    new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: 'Projection in $TTD',
            data: data,
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
</script>

<script>

    // Decode and extract data

    const psipDetail = document.getElementById('PolarArea');
    const approved = JSON.parse({!! json_encode($approved_estimates) !!});
    const actual = JSON.parse({!! json_encode($actual_expenditure) !!});
    const revised = JSON.parse({!! json_encode($revised_estimates) !!});

    Chart.defaults.font.family = "Lato";
    Chart.defaults.font.size = 22;
    Chart.defaults.color = "black";

    var birdsData = {
      labels: ["Actual Expenditure","Approved Allocation(MOP&F)","Revised Allocation"],
      datasets: [{
        data: [actual, approved, revised],
        backgroundColor: [
          "rgba(255, 0, 0, 0.5)",
          "rgba(100, 255, 0, 0.5)",
          "rgba(0, 100, 255, 0.5)"
        ]
      }]
    };

    var chartOptions = {
      plugins: {
        title: {
          display: true,
          align: "start",
          text: "Polar Radial Chart"
        },
        legend: {
          align: "start"
        }

      },
      responsive: false, // Prevents resizing to the parent container
        maintainAspectRatio: false // Maintains the aspect ratio; set to false if aspect ratio is not a concern
    };

    var polarAreaChart = new Chart(psipDetail, {
      type: 'polarArea',
      data: birdsData,
      options: chartOptions

    });

</script>
