function graphPie(canvasID, dataI, labelsI, colors, title){

const data = {
    labels: labelsI,
    datasets: [{
        display: true,
        label: 'My First Dataset',
        data: dataI,
        backgroundColor: colors,
        hoverOffset: 4
    }]
};

const config = {
    type: 'pie',
    data: data,
    options: {
        plugins: {
            title: {
                display: true,
                text: title
            }
        },
        responsive: true
    }
};

var ctx = document.getElementById(canvasID).getContext('2d'); // 2d context

const myChart = new Chart(
    ctx,
    config
);
}