<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswa = [
            [
                'nama'  => 'mahasiswa1',
                'nim'   => '11111111111111',
                'email' => 'mahasiswa1@guest.com',
                'password'=> bcrypt('mahasiswa1'),
                'fakultas' => 'Fakultas Teknik',
                'prodi' => 'S1-Teknik Komputer',
            ],
            [
                'nama'  => 'mahasiswa2',
                'nim'   => '22222222222222',
                'email' => 'mahasiswa2@guest.com',
                'password'=> bcrypt('mahasiswa2'),
                'fakultas' => 'Fakultas Teknik',
                'prodi' => 'S1-Teknik Komputer',
            ]
        ];

        foreach($mahasiswa as $item) {
            $mahasiswa = Mahasiswa::where('email', $item['email'])->first();
            if(empty($mahasiswa)){
                Mahasiswa::create([
                    'nama'  => $item['nama'],
                    'nim'   => $item['nim'],
                    'email' => $item['email'],
                    'password'=> $item['password'],
                    'fakultas' => $item['fakultas'],
                    'prodi' => $item['prodi'],
                ]);
            }
        }
    }
}
