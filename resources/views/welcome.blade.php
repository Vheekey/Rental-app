@include('layout.header')
    <div class="row">

        <div class="col-md-10 offset-md-1">

            <div class="panel panel-default">

                <div class="panel-heading font-weight-bold h3">Dashboard</div>

                <div class="panel-body">

                    <canvas id="canvas" height="280" width="600"></canvas>

                </div>

            </div>

        </div>

    </div>


@include('layout.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>

    var activities = <?php echo $activities; ?>;
    var period = ' <?php echo $period; ?>'
    var items = Object.keys(activities);
    var quantity = Object.values(activities)

    console.log(items)
    console.log(quantity)
    console.log(period)

    var barChartData = {

        labels: items,

        datasets: [{

            label: 'Items',

            backgroundColor: "purple",

            data: quantity

        }]

    };


    window.onload = function() {

        var ctx = document.getElementById("canvas").getContext("2d");

        window.myBar = new Chart(ctx, {

            type: 'bar',

            data: barChartData,

            options: {

                elements: {

                    rectangle: {

                        borderWidth: 2,

                        borderColor: '#c1c1c1',

                        borderSkipped: 'bottom'

                    }

                },

                responsive: true,

                scales: {

                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },

                title: {

                    display: true,

                    text: 'Activites of Items'+period

                }

            }

        });

    };

</script>
