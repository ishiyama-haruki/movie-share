<canvas id="myChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  axios.get("/movie/api/movieHistory/")
    .then(response => {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: response.data['labels'],
                datasets: [{
                    label: '視聴履歴',
                    data: response.data['data'],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            }
        })
    }).catch(err => {
        console.log('err:', err)
    });
</script>