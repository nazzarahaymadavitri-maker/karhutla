<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karhutla Health Analytics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: radial-gradient(circle at 20% 90%, rgba(180, 58, 12, 0.28), transparent 45%),
                        radial-gradient(circle at 80% 85%, rgba(217, 119, 6, 0.22), transparent 45%),
                        #0d0907;
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        .card-dark {
            background: rgba(24, 17, 13, 0.92);
            border: 1px solid rgba(234, 88, 12, 0.28);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
        }
    </style>
</head>
<body class="text-gray-100 py-8 px-4 md:px-10">
    <div class="max-w-6xl mx-auto space-y-6">
        <!-- Header Banner -->
        <div class="rounded-2xl py-5 px-6 text-center shadow-lg border border-orange-500/30"
             style="background: linear-gradient(90deg, #7f1d1d 0%, #9a3412 50%, #92400e 100%);">
            <h1 class="text-2xl md:text-3xl font-bold tracking-tight flex items-center justify-center gap-2 text-white">
                <span>🔥</span> Dashboard Karhutla Health Analytics
            </h1>
            <p class="text-xs md:text-sm text-orange-100/85 mt-1">
                Visualisasi Kasus Penyakit Dampak Kebakaran Hutan & Lahan (Juni – September 2026)
            </p>
        </div>

        <!-- Grid Konten Utama -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Kartu Kiri: Polar Area Chart -->
            <div class="card-dark rounded-2xl p-6 flex flex-col justify-between">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-amber-400 flex items-center gap-2">
                        <span>◔</span> Polar Area Kasus Penyakit
                    </h2>
                    <button onclick="putarAnimasi()"
                            class="bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-500 hover:to-amber-500 text-white text-xs font-semibold px-4 py-2 rounded-full shadow transition cursor-pointer">
                        Putar Animasi
                    </button>
                </div>

                <div class="relative w-full max-w-[380px] mx-auto my-2">
                    <canvas id="polarChart"></canvas>
                </div>

                <!-- Legend Kustom -->
                <div class="flex flex-wrap justify-center gap-x-4 gap-y-2 mt-4 pt-2 text-xs text-gray-300">
                    @foreach($penyakit as $item)
                        <div class="flex items-center gap-1.5">
                            <span class="w-4 h-2.5 inline-block rounded-xs border"
                                  style="background-color: {{ $item->warna_hex }}88; border-color: {{ $item->warna_hex }};"></span>
                            <span>{{ $item->nama_penyakit }} ({{ number_format($item->total) }})</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Kartu Kanan: Rincian Data Tabel -->
            <div class="card-dark rounded-2xl p-6 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold text-amber-400 flex items-center gap-2">
                            <span>☷</span> Rincian Data (Juni – Sept 2026)
                        </h2>
                        <span class="bg-rose-600 text-white text-xs font-bold px-3 py-1 rounded-md shadow">
                            ▲ {{ number_format($totalKasus) }} Total Kasus
                        </span>
                    </div>

                    <!-- Header Kolom -->
                    <div class="grid grid-cols-12 text-[11px] font-bold uppercase tracking-wider text-amber-500/90 bg-orange-950/40 rounded-lg px-3 py-2 mb-2.5 items-center">
                        <div class="col-span-4">Penyakit</div>
                        <div class="col-span-1 text-center">Jun</div>
                        <div class="col-span-1 text-center">Jul</div>
                        <div class="col-span-1 text-center bg-amber-500/20 text-amber-300 py-1 rounded">Agu</div>
                        <div class="col-span-1 text-center">Sep</div>
                        <div class="col-span-4 text-right">Total / Proporsi</div>
                    </div>

                    <!-- Baris Data dari Database -->
                    <div class="space-y-2.5">
                        @foreach($penyakit as $item)
                            @php
                                $persen = $totalKasus > 0 ? round(($item->total / $totalKasus) * 100, 1) : 0;
                            @endphp
                            <div class="grid grid-cols-12 items-center bg-white text-gray-800 rounded-xl px-3 py-2 shadow-sm text-xs">
                                <div class="col-span-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full font-semibold text-[11px]"
                                          style="background-color: {{ $item->badge_bg }}; color: {{ $item->badge_text }};">
                                        <span>{{ $item->ikon }}</span> {{ $item->nama_penyakit }}
                                    </span>
                                </div>
                                <div class="col-span-1 text-center text-gray-600 font-medium">{{ $item->jun }}</div>
                                <div class="col-span-1 text-center text-gray-600 font-medium">{{ $item->jul }}</div>
                                <div class="col-span-1 text-center bg-[#3b2c13] text-amber-400 font-bold py-1.5 rounded">
                                    {{ $item->agu }}
                                </div>
                                <div class="col-span-1 text-center text-gray-600 font-medium">{{ $item->sep }}</div>
                                <div class="col-span-4 pl-3">
                                    <div class="flex justify-end items-baseline gap-1 mb-1">
                                        <span class="font-bold" style="color: {{ $item->warna_hex }};">
                                            {{ number_format($item->total) }}
                                        </span>
                                        <span class="text-[11px] text-gray-500">({{ $persen }}%)</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                        <div class="h-1.5 rounded-full"
                                             style="width: {{ $persen }}%; background-color: {{ $item->warna_hex }};"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Catatan Puncak Dampak -->
                <div class="mt-5 rounded-xl p-3.5 border border-orange-500/30 bg-orange-950/30 text-xs">
                    <p class="font-bold text-amber-400 flex items-center gap-1.5 mb-1">
                        <span>🔥</span> Puncak Dampak Kesehatan:
                    </p>
                    <p class="text-gray-300 leading-relaxed">
                        Bulan <strong class="text-white">Agustus 2026</strong> mencatat angka tertinggi
                        (<strong class="text-white">{{ number_format($totalAgustus, 0, ',', '.') }} kasus</strong>)
                        akibat eskalasi asap titik panas (<em class="text-white font-semibold">hot spot</em>) Karhutla.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const labels = @json($penyakit->pluck('nama_penyakit'));
        const totals = @json($penyakit->map(fn($p) => $p->total));
        const colors = @json($penyakit->pluck('warna_hex'));

        const ctx = document.getElementById('polarChart').getContext('2d');
        const polarChart = new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: labels,
                datasets: [{
                    data: totals,
                    backgroundColor: colors.map(c => c + '88'),
                    borderColor: colors,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 1200,
                    animateRotate: true,
                    animateScale: true
                },
                scales: {
                    r: {
                        min: 0,
                        max: 1400,
                        ticks: {
                            stepSize: 200,
                            color: '#9ca3af',
                            backdropColor: 'transparent',
                            font: { size: 10 }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.08)'
                        },
                        angleLines: {
                            color: 'rgba(255, 255, 255, 0.08)'
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ` ${context.label}: ${context.raw.toLocaleString()} kasus`;
                            }
                        }
                    }
                }
            }
        });

        function putarAnimasi() {
            polarChart.reset();
            polarChart.update();
        }
    </script>
</body>
</html>