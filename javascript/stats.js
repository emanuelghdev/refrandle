document.addEventListener('DOMContentLoaded', async () => {
    const gameModeSelect = document.getElementById('gameMode');
    const gamesNumberEl = document.getElementById('gamesNumber');
    const bestScoreEl   = document.getElementById('bestScore');
    const percentileEl  = document.getElementById('percentile');
    const estilosRoot = getComputedStyle(document.documentElement);
    let lineChart, barChart;

    const allScores = JSON.parse(localStorage.getItem('allScores')) || {5: [], 10: [], 20: [], 100: []};

    // Agrupamos los datos en rangos
    const groupData = (data, bin) => data.reduce((acc, v) => {
        const b = Math.floor(v/bin)*bin;
        acc[b] = (acc[b]||0) + 1;
        return acc;
    }, {});

    const createRangeLabels = (min, max, bin) => {
        const labels = [];
        for (let i = min; i <= max; i += bin) labels.push(i.toString());
        return labels;
    };

    // Función que actualiza los gráficos
    async function updateStats(mode) {
        const scores = allScores[mode];
        const totalGames = scores.length;
        const bestScore = totalGames ? Math.max(...scores) : 0;

        gamesNumberEl.textContent = totalGames;
        bestScoreEl.textContent = bestScore;

        const dataUsers = await fetchDistribution(mode);
        const L = dataUsers.filter(v => v < bestScore).length;
        const S = dataUsers.filter(v => v === bestScore).length;
        const perc = dataUsers.length ? Math.round(((L + 0.5 * S) / dataUsers.length) * 100) : 0;
        percentileEl.textContent = perc + '%';

        // Preparamos etiquetas y conteos
        const maxPts = mode * 10;
        let binSize = mode === 5 ? 1 : mode === 10 ? 2 : mode === 20 ? 4 : 20;

        let labels = mode > 5 ? createRangeLabels(0, maxPts, binSize)
                    : Array.from({ length: maxPts + 1 }, (_, i) => i.toString());

        let counts = [];
        if (mode > 5) {
            const grouped = groupData(dataUsers, binSize);
            counts = labels.map(lbl => grouped[parseInt(lbl)] || 0);
        } else {
            counts = new Array(maxPts + 1).fill(0);
            dataUsers.forEach(v => counts[v]++);
        }

        // Datos usuario
        let userDist = new Array(labels.length).fill(0);
        if (bestScore > 0) {
            if (mode > 5) {
                const bestBin = Math.floor(bestScore/binSize) * binSize;
                const idx = labels.indexOf(bestBin.toString());
                if (idx >= 0){ 
                    userDist[idx] = Math.max(...counts);
                }
            } else {
                userDist[bestScore] = Math.max(...counts);
            }
        }

        // Destruimos gráficos previos
        if (lineChart) lineChart.destroy();
        if (barChart)  barChart.destroy();

        // Gráfico de líneas comparativo de distribución de puntuaciones
        lineChart = new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
            labels,
            datasets: [
                {
                label: 'Media de usuarios',
                data: counts,
                fill: true,
                backgroundColor: estilosRoot.getPropertyValue('--color-linea-usuarios-fondo'),
                borderColor: estilosRoot.getPropertyValue('--color-linea-usuarios-borde'),
                pointBackgroundColor: estilosRoot.getPropertyValue('--color-linea-usuarios-puntos'),
                borderWidth: 2,
                tension: 0.2,
                pointRadius: 2
                },
                {
                label: 'Tu puntuación máxima',
                data: userDist,
                fill: true,
                backgroundColor: estilosRoot.getPropertyValue('--color-linea-propio-fondo'),
                borderColor: estilosRoot.getPropertyValue('--color-linea-propio-borde'),
                pointBackgroundColor: estilosRoot.getPropertyValue('--color-linea-propio-puntos'),
                borderWidth: 2,
                tension: 0.2,
                pointRadius: 4,
                pointShadowBlur: 10
                }
            ]
            },
            options: {
            scales: {
                x: { ticks: {
                    autoSkip: mode > 5,
                    maxTicksLimit: mode > 5 ? 20 : undefined,
                    callback: (v,i) => {
                        if (mode > 5) return i % 2 === 0 ? parseInt(labels[i]) : null;
                        return i % 5 === 0 ? labels[i] : null;
                    }
                }},
                y: { beginAtZero: true, suggestedMax: Math.max(...counts)*1.2, ticks:{ display:false }}
            },
            plugins: {
                tooltip: {
                callbacks: {
                    title: items => {
                    const val = mode > 5 ? Math.floor(bestScore/binSize)*binSize : bestScore;
                    const x = parseInt(items[0].label);
                    return x === val
                        ? `⭐ TU MEJOR PUNTUACIÓN: ${bestScore}`
                        : `Puntuación: ${x}`;
                    },
                    label: () => null
                }
                }
            },
            maintainAspectRatio: false,
            responsive: true,
            aspectRatio: 3
            }
        });

        // Gráfico de barras de las últimas 15 puntuaciones conseguidas del usuario
        const recent = scores.slice(-15);
        const startIdx = totalGames - recent.length;
        const barLabels = recent.map((_,i)=>`${startIdx+i+1}º Partida`);

        barChart = new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
            labels: barLabels,
            datasets: [{
                label: 'Puntos conseguidos',
                data: recent,
                backgroundColor: estilosRoot.getPropertyValue('--color-barras-fondo'),
                borderColor: estilosRoot.getPropertyValue('--color-barras-borde'),
                borderWidth: 1
            }]
            },
            options: {
            scales: { y: { beginAtZero:true, suggestedMax: Math.max(...recent)*1.1 } },
            maintainAspectRatio:false,
            responsive:true,
            aspectRatio:2.5
            }
        });
    }

    // onChange
    gameModeSelect.addEventListener('change', () => {
        updateStats(parseInt(gameModeSelect.value));
    });

    // Carga inicial con el modo de 5 refranes por defecto
    await updateStats(parseInt(gameModeSelect.value));


    // Lógica para resetear container-canvas al volver a escritorio
    let fueMovil = window.innerWidth <= TABLET_WIDTH;

    window.addEventListener('resize', () => {
        const esMovil = window.innerWidth <= TABLET_WIDTH;
        if (fueMovil && !esMovil) {
            location.reload()
        }
        fueMovil = esMovil;
    });
});


// Funcion asincrona para obtener la distribución de puntuaciones del servidor
async function fetchDistribution(mode) {
    try {
        const response = await fetch(`../php/obtener_puntuaciones.php?mode=${mode}`);
        if (!response.ok) throw new Error('Error en la respuesta del servidor');
        return await response.json();
    } catch (error) {
        console.error('Error recuperando distribución:', error);
        return [];
    }
}