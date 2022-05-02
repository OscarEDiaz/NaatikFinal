function graphBar(valuesI, labelsI, backgrC, borderC, canvasID){
  const data = {
      labels: labelsI,
      datasets: [{
          label: 'CHURN rate (%)',
          backgroundColor: backgrC,
          borderColor: borderC,
          data: valuesI,
      }]
  };
  
  const config = {
      type: 'bar',
      data: data,
      options: {
          scales: {
              y: {
                  beginAtZero: true,
                  title: {
                    display: true,
                    text: 'Cantidad de usuarios'
                  }
              },
              x: {
                title: {
                  display: true,
                  text: 'Rango de % de abandono'
                }
            }
          }
      }
  };
  var ctx = document.getElementById('myChart').getContext('2d'); // 2d context

  const myChart = new Chart(
      ctx,
      config
  );
}