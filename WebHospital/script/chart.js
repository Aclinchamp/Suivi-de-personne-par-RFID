
function drawBornesChart(){
    var ctx = document.getElementById('chart-bornes').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Satusday", "Sunday"],
            datasets: [{
                label: "Entrance hall",
                backgroundColor: 'rgb(32, 201, 45)',
                borderColor: 'rgb(32, 201, 45)',
                data: [45, 32, 11, 67, 87, 32, 22],
            }, {
                label: "Consultation room",
                backgroundColor: 'rgb(58, 165, 240)',
                borderColor: 'rgb(58, 165, 240)',
                data: [12, 75, 34, 90, 23, 126, 45],
            },
            {
                label: "Dinner room",
                backgroundColor: 'rgb(220, 50, 63)',
                borderColor: 'rgb(220, 50, 63)',
                data: [43, 57, 34, 69, 65, 143, 23],
            }]
        },

        // Configuration options go here
        options: {}
    });
}
