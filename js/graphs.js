// Chart.defaults.global.defaultFontFamily = 'rola';
var nightmode = localStorage.getItem('nightmode');
if(nightmode == "true"){
	Chart.defaults.global.defaultFontColor = 'white';
}
else{
	Chart.defaults.global.defaultFontColor = '#666666';
}


// Gráfico de barra

var contextBarra = document.getElementById('graficoBarra').getContext('2d');

// DataSets dos produtos mais vendidos

var produto1 = {
	label: 'Quantidade',
			data: [16019, 27421, 13729, 45535],
			backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
			],
			borderColor: [
				'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
			],
			borderWidth: 1
}

var produto2 = {
	label: 'Quantidade',
			data: [0, 22],
			backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
			],
			borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
			],
			borderWidth: 1
}

var BarraChart = new Chart(contextBarra, {
	type: 'bar',
	responsive: true,
	
	data: {
		labels: ["Arroz", "Feijão", "Carne Moída", "Salada de Acelga"],
		datasets: [produto1]
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
		text: 'Produtos Mais Vendidos'
	},
	legend: {
		display: false,
		position: 'bottom'
	}
	}
});

// Gráfico de linha

var contextLine = document.getElementById('graficoLine').getContext('2d');

var numEntrada = {
			label: 'Entrada',
			data: [352, 440, 570, 835, 719, 907, 754, 453, 874, 790, 440, 725],
			backgroundColor: [
				'rgba(255, 99, 132, 0)'
			],
			borderColor: [
				'rgba(255,99,132,1)'
			],
			borderWidth: 1
};

var numSaida = {
	label: 'Saída',
	data: [778, 144, 891, 355, 196, 558, 294, 880, 420, 483, 951, 274],
	backgroundColor: [
		'rgba(54, 162, 235, 0)'
	],
	borderColor: [
		'rgba(54, 162, 235, 1)'
	],
	borderWidth: 1

}
var LineChart = new Chart(contextLine, {
	type: 'line',
	responsive: true,

	data: {
		labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
		datasets: [numEntrada, numSaida]
	},
	options: {
		title: {
			display: true,
			text: 'Movimentação do Estoque'
		},
		legend: {
			position: 'bottom'
		}
	}
});
