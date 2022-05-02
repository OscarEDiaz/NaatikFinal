function graphBar(valuesI, labelsI, backgrC, borderC, canvasID, titleI){
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
                    text: 'Cantidad de clientes'
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

  var ctx = document.getElementById(canvasID).getContext('2d'); // 2d context

  const myChart = new Chart(
      ctx,
      config
  );
}