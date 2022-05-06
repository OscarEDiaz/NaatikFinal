function graphBar(valuesI, labelsI, backgrC, borderC, canvasID, titleI, xLabel, yLabel){
  const data = {
      labels: labelsI,
      datasets: [{
          label: titleI,
          backgroundColor: backgrC,
          borderColor: borderC,
          borderWidth: 1.5,
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
                    text: yLabel
                  }
              },
              x: {
                title: {
                  display: true,
                  text: xLabel
                }
            }
          },
          maintainAspectRatio: true,
      }
  };

  var ctx = document.getElementById(canvasID).getContext('2d'); // 2d context

  const myChart = new Chart(
      ctx,
      config
  );
}