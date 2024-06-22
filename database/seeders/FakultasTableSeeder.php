<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakultasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fakultas = [
            [
                'name' => 'Fakultas Hukum'
            ],
 
            [
                'name' => 'Fakultas Ekonomika dan Bisnis'
            ],
 
            [
                'name' => 'Fakultas Teknik'
            ],
            [
                'name' => 'Fakultas Kedokteran'
            ],
            [
                'name' => 'Fakultas Peternakan dan Pertanian'
            ],
            [
                'name' => 'Fakultas Ilmu Budaya'
            ],
            [
                'name' => 'Fakultas Ilmu Sosial dan Politik	'
            ],
            [
                'name' => 'Fakultas Kesehatan Masyarakat'
            ],
            [
                'name' => 'Fakultas Sains dan Matematika'
            ],
            [
                'name' => 'Fakultas Perikanan dan Ilmu Kelautan'
            ],
            [
                'name' => 'Fakultas Psikologi'
            ],
            [
                'name' => 'Sekolah Vokasi'
            ]
        ];

        foreach($fakultas as $key => $item) {
            $fk = Fakultas::where('nama', $item['name'])->first();
            if (empty($fk)) {
                Fakultas::create([
                    'nama' => $item['name'],
                ]);
            }
        }
    }
}
