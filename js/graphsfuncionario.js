var nightmode = localStorage.getItem('nightmode');
if(nightmode == "true"){
	Chart.defaults.global.defaultFontColor = 'white';
}
else{
	Chart.defaults.global.defaultFontColor = '#666666';
}

var contextDonut = document.getElementById('graficoDonut').getContext('2d');

var DonutChart = new Chart(contextDonut, {
	type: 'doughnut',
	data: {
      labels: ["Alcançado", "Não alcançado"],
      datasets: [
        {
          label: "Population (millions)",
          backgroundColor: ["#2DAA2D", "#D43838"],
          data: ['40','60']
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Metas para Setembro de 2018'
      },
			legend: {
				display: true
			}
    }
});

var contextDesempenho = document.getElementById('DesempenhoFunc').getContext('2d');

var funcUm = {
	label: 'Abner',
			data: [16019, 27421, 13729, 45535,16019, 27421, 13729, 45535,16019, 27421, 13729, 45535],
			backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 99, 132, 0.2)',
			],
			borderColor: [
				'rgba(255,99,132,1)',
        'rgba(255,99,132,1)',
        'rgba(255,99,132,1)',
        'rgba(255,99,132,1)',
        'rgba(255,99,132,1)',
        'rgba(255,99,132,1)',
        'rgba(255,99,132,1)',
        'rgba(255,99,132,1)',
        'rgba(255,99,132,1)',
        'rgba(255,99,132,1)',
        'rgba(255,99,132,1)',
        'rgba(255,99,132,1)',
			],
			borderWidth: 1
}
var funcDois = {
	label: 'Vinícius',
			data: [26760,52953, 78501,45648, 30717, 66387, 59521, 62731,28150, 56341, 93197, 52915],
			backgroundColor: [
				'rgba(24, 163, 144, 0.2)',
        'rgba(24, 163, 144, 0.2)',
        'rgba(24, 163, 144, 0.2)',
        'rgba(24, 163, 144, 0.2)',
        'rgba(24, 163, 144, 0.2)',
        'rgba(24, 163, 144, 0.2)',
        'rgba(24, 163, 144, 0.2)',
        'rgba(24, 163, 144, 0.2)',
        'rgba(24, 163, 144, 0.2)',
        'rgba(24, 163, 144, 0.2)',
        'rgba(24, 163, 144, 0.2)',
        'rgba(24, 163, 144, 0.2)',
			],
			borderColor: [
				'rgba(24, 163, 144, 1)',
        'rgba(24, 163, 144, 1)',
        'rgba(24, 163, 144, 1)',
        'rgba(24, 163, 144, 1)',
        'rgba(24, 163, 144, 1)',
        'rgba(24, 163, 144, 1)',
        'rgba(24, 163, 144, 1)',
        'rgba(24, 163, 144, 1)',
        'rgba(24, 163, 144, 1)',
        'rgba(24, 163, 144, 1)',
        'rgba(24, 163, 144, 1)',
        'rgba(24, 163, 144, 1)',
			],
			borderWidth: 1
}
var ChartDesempenho = new Chart(contextDesempenho, {
	type: 'bar',
	data: {
		labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
		datasets: [funcUm,funcDois]
	},
	options: {
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero: true
				}
			}]
		},
	title: {
		display: true,
		position: 'top',
		text: 'Vendas por Funcionário'
	},
	legend: {
		display: true,
		position: 'bottom'
	}
	}
})
