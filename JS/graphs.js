function graphBar(valuesI, labelsI){
const labels = [
    '0 - 20',
    '21 - 40',
    '41 - 60',
    '61 - 80',
    '81 - 100',
];

const data = {
    labels: labelsI,
    datasets: [{
        label: 'CHURN rate (%)',
        backgroundColor: 'rgb(10,10,210)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
    }]
};

const config = {
    type: 'bar',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

const churnBar = new Chart(
    document.getElementById('churnBar'),
    config
);
}