<?php

namespace Database\Seeders;

use App\Models\KasusPenyakit;
use Illuminate\Database\Seeder;

class KasusPenyakitSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_penyakit' => 'ISPA',
                'ikon' => '🫁',
                'warna_hex' => '#e11d48',
                'badge_bg' => '#ffe4e6',
                'badge_text' => '#be123c',
                'jun' => 180, 'jul' => 310, 'agu' => 450, 'sep' => 310,
            ],
            [
                'nama_penyakit' => 'Iritasi Mata',
                'ikon' => '👁️',
                'warna_hex' => '#ea580c',
                'badge_bg' => '#ffedd5',
                'badge_text' => '#c2410c',
                'jun' => 120, 'jul' => 210, 'agu' => 320, 'sep' => 200,
            ],
            [
                'nama_penyakit' => 'Asma',
                'ikon' => '😮‍💨',
                'warna_hex' => '#eab308',
                'badge_bg' => '#fef9c3',
                'badge_text' => '#a16207',
                'jun' => 90, 'jul' => 150, 'agu' => 230, 'sep' => 150,
            ],
            [
                'nama_penyakit' => 'Iritasi Kulit',
                'ikon' => '✋',
                'warna_hex' => '#06b6d4',
                'badge_bg' => '#cffafe',
                'badge_text' => '#0e7490',
                'jun' => 60, 'jul' => 110, 'agu' => 160, 'sep' => 100,
            ],
            [
                'nama_penyakit' => 'Pneumonia',
                'ikon' => '🦠',
                'warna_hex' => '#64748b',
                'badge_bg' => '#e2e8f0',
                'badge_text' => '#334155',
                'jun' => 30, 'jul' => 50, 'agu' => 80, 'sep' => 50,
            ],
        ];

        foreach ($data as $item) {
            KasusPenyakit::create($item);
        }
    }
}