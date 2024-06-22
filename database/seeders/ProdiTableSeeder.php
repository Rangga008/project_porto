<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $prodi = [
      [
        'id' => 1,
        'fk_id' => 1,
        'name' => 'S1-Hukum'
      ],
      [
        'id' => 2,
        'fk_id' => 2,
        'name'  => 'S1-Ekonomi'
      ],
      [
        'id' => 3,
        'fk_id' => 2,
        'name' => 'S1-Ekonomi Islam'
      ],
      [
        'id' => 4,
        'fk_id' => 2,
        'name' => 'S1-Manajemen'
      ],
      [
        'id' => 5,
        'fk_id' => 2,
        'name' => 'S1-Akuntansi'
      ],
      [
        'id' => 6,
        'fk_id' => 3,
        'name' => 'S1-Teknik Elektro'
      ],
      [
        'id' => 7,
        'fk_id' => 3,
        'name' => 'S1-Teknik Mesin'
      ],
      [
        'id' => 8,
        'fk_id' => 3,
        'name' => 'S1-Teknik Sipil'
      ],
      [
          'id' => 9,
          'fk_id' => 3,
          'name' => 'S1-Arsitektur'
      ],
      [
          'id' => 10,
          'fk_id' => 3,
          'name' => 'S1-Teknik Kimia'
      ],
      [
          'id' => 11,
          'fk_id' => 3,
          'name' => 'S1-Teknik Lingkungan'
      ],
      [
          'id' => 12,
          'fk_id' => 3,
          'name' => 'S1-Teknik Industri'
      ],
      [
          'id' => 13,
          'fk_id' => 3,
          'name' => 'S1-Teknik Geodesi'
      ],
      [
          'id' => 14,
          'fk_id' => 3,
          'name' => 'S1-Teknik Geologi'
      ],
      [
          'id' => 15,
          'fk_id' => 3,
          'name' => 'S1-Perencanaan Wilayah dan Kota'
      ],
      [
          'id' => 16,
          'fk_id' => 3,
          'name' => 'S1-Teknik Perkapalan'
      ],
      [
          'id' => 17,
          'fk_id' => 3,
          'name' => 'S1-Teknik Komputer'
      ],
      [
          'id' => 18,
          'fk_id' => 4,
          'name' => 'S1-Kedokteran'
      ],
      [
          'id' => 19,
          'fk_id' => 4,
          'name' => 'S1-Kedokteran Gigi'
      ],
      [
          'id' => 20,
          'fk_id' => 4,
          'name' => 'S1-Gizi'
      ],
      [
          'id' => 21,
          'fk_id' => 4,
          'name' => 'S1-Keperawatan'
      ],
      [
          'id' => 22,
          'fk_id' => 4,
          'name' => 'S1-Farmasi'
      ],
      [
          'id' => 23,
          'fk_id' => 5,
          'name' => 'S1-Teknologi Pangan'
      ],
      [
          'id' => 24,
          'fk_id' => 5,
          'name' => 'S1-Agribisnis'
      ],
      [
          'id' => 25,
          'fk_id' => 5,
          'name' => 'S1-Agroekoteknologi'
      ],
      [
          'id' => 26,
          'fk_id' => 5,
          'name' => 'S1-Peternakan'
      ],
      [
          'id' => 27,
          'fk_id' => 6,
          'name' => 'S1-Ilmu Perpustakaan'
      ],
      [
          'id' => 28,
          'fk_id' => 6,
          'name' => 'S1-Sastra Indonesia'
      ],
      [
          'id' => 29,
          'fk_id' => 6,
          'name' => 'S1-Sastra Inggris'
      ],
      [
          'id' => 30,
          'fk_id' => 6,
          'name' => 'S1-Bahasa dan Kebudayaan Jepang'
      ],
      [
          'id' => 31,
          'fk_id' => 6,
          'name' => 'S1-Sejarah'
      ],
      [
          'id' => 32,
          'fk_id' => 6,
          'name' => 'S1-Antropologi Sosial'
      ],
      [
          'id' => 33,
          'fk_id' => 7,
          'name' => 'S1-Administrasi Publik'
      ],
      [
          'id' => 34,
          'fk_id' => 7,
          'name' => 'S1-Administrasi Bisnis'
      ],
      [
          'id' => 35,
          'fk_id' => 7,
          'name' => 'S1-Hubungan Internasional'
      ],
      [
          'id' => 36,
          'fk_id' => 7,
          'name' => 'S1-Ilmu Pemerintahan'
      ],
      [
          'id' => 37,
          'fk_id' => 7,
          'name' => 'S1-Ilmu Komunikasi'
      ],
      [
          'id' => 38,
          'fk_id' => 8,
          'name' => 'S1-Kesehatan Masyarakat'
      ],
      [
          'id' => 39,
          'fk_id' => 9,
          'name' => 'S1-Matematika'
      ],
      [
          'id' => 40,
          'fk_id' => 9,
          'name' => 'S1-Fisika'
      ],
      [
          'id' => 41,
          'fk_id' => 9,
          'name' => 'S1-Biologi'
      ],
      [
          'id' => 42,
          'fk_id' => 9,
          'name' => 'S1-Kimia'
      ],
      [
          'id' => 43,
          'fk_id' => 9,
          'name' => 'S1-Statistika'
      ],
      [
          'id' => 44,
          'fk_id' => 9,
          'name' => 'S1-Bioteknologi'
      ],
      [
          'id' => 45,
          'fk_id' => 9,
          'name' => 'S1-Informatika'
      ],
      [
          'id' => 46,
          'fk_id' => 10,
          'name' => 'S1-Oseanografi'
      ],
      [
          'id' => 47,
          'fk_id' => 10,
          'name' => 'S1-Ilmu Kelautan'
      ],
      [
          'id' => 48,
          'fk_id' => 10,
          'name' => 'S1-Manajemen Sumberdaya Perairan'
      ],
      [
          'id' => 49,
          'fk_id' => 10,
          'name' => 'S1-Akuakultur'
      ],
      [
          'id' => 50,
          'fk_id' => 10,
          'name' => 'S1-Teknologi Hasil Perikanan'
      ],
      [
          'id' => 51,
          'fk_id' => 10,
          'name' => 'S1-Perikanan Tangkap'
      ],
      [
          'id' => 52,
          'fk_id' => 11,
          'name' => 'S1-Psikologi'
      ],
      [
          'id' => 53,
          'fk_id' => 12,
          'name' => 'D-IV-Teknologi Rekayasa Kimia Industri'
      ],
      [
          'id' => 54,
          'fk_id' => 12,
          'name' => 'D-IV-Teknologi Rekayasa Otomasi'
      ],
      [
          'id' => 55,
          'fk_id' => 12,
          'name' => 'D-IV-Rekayasa Perancangan Mekanik'
      ],
      [
          'id' => 56,
          'fk_id' => 12,
          'name' => 'D-IV-Teknologi Rekayasa Konstruksi Perkapalan'
      ],
      [
          'id' => 57,
          'fk_id' => 12,
          'name' => 'D-IV-Teknik Listrik Industri'
      ],
      [
          'id' => 58,
          'fk_id' => 12,
          'name' => 'D-IV-Perencanaan Tata Ruang dan Pertanahan'
      ],
      [
          'id' => 59,
          'fk_id' => 12,
          'name' => 'D-IV-Teknik Infrastruktur Sipil dan Perancangan Arsitektur'
      ],
      [
          'id' => 60,
          'fk_id' => 12,
          'name' => 'D-IV-Akuntansi Perpajakan'
      ],
      [
          'id' => 61,
          'fk_id' => 12,
          'name' => 'D-IV-Manajemen dan Administrasi Logistik'
      ],
      [
          'id' => 62,
          'fk_id' => 12,
          'name' => 'D-IV-Bahasa Asing Terapan'
      ],
      [
          'id' => 63,
          'fk_id' => 12,
          'name' => 'D-IV-Informasi dan Humas'
      ],
      [
          'id' => 64,
          'fk_id' => 12,
          'name' => 'D-III-Teknologi Kimia'
      ],
      [
          'id' => 65,
          'fk_id' => 12,
          'name' => 'D-III-Teknologi Elektronika'
      ],
      [
          'id' => 66,
          'fk_id' => 12,
          'name' => 'D-III-Teknologi Mesin'
      ],
      [
          'id' => 67,
          'fk_id' => 12,
          'name' => 'D-III-Teknologi Perancangan dan Konstruksi Kapal'
      ],
      [
          'id' => 68,
          'fk_id' => 12,
          'name' => 'D-III-Teknologi Instrumentasi'
      ],
      [
          'id' => 69,
          'fk_id' => 12,
          'name' => 'D-III-Teknologi Sipil'
      ],
      [
          'id' => 70,
          'fk_id' => 12,
          'name' => 'D-III-Perencanaan Tata Ruang Wilayah dan Kota'
      ],
      [
          'id' => 71,
          'fk_id' => 12,
          'name' => 'D-III-Perencanaan Wilayah dan Kota K. Pekalongan'
      ],
      [
          'id' => 72,
          'fk_id' => 12,
          'name' => 'D-III-Gambar Arsitektur'
      ],
      [
          'id' => 73,
          'fk_id' => 12,
          'name' => 'D-III-Administrasi Pertanahan'
      ],
      [
          'id' => 74,
          'fk_id' => 12,
          'name' => 'D-III-Manajemen'
      ],
      [
          'id' => 75,
          'fk_id' => 12,
          'name' => 'D-III-Manajemen K.Rembang'
      ],
      [
          'id' => 76,
          'fk_id' => 12,
          'name' => 'D-III-Administrasi Pajak'
      ],
      [
          'id' => 77,
          'fk_id' => 12,
          'name' => 'D-III-Administrasi Pajak K.Batang'
      ],
      [
          'id' => 78,
          'fk_id' => 12,
          'name' => 'D-III-Akuntansi'
      ],
      [
          'id' => 79,
          'fk_id' => 12,
          'name' => 'D-III-Akuntansi K. Pekalongan'
      ],
      [
          'id' => 80,
          'fk_id' => 12,
          'name' => 'D-III-Usaha Budidaya Ternak'
      ],
      [
          'id' => 81,
          'fk_id' => 12,
          'name' => 'D-III-Manajemen Pemasaran'
      ],
      [
          'id' => 82,
          'fk_id' => 12,
          'name' => 'D-III-Keuangan Publik'
      ],
      [
          'id' => 83,
          'fk_id' => 12,
          'name' => 'D-III-Hubungan Masyarakat'
      ],
      [
          'id' => 84,
          'fk_id' => 12,
          'name' => 'D-III-Hubungan Masyarakat K. Batang'
      ],
      [
          'id' => 85,
          'fk_id' => 12,
          'name' => 'D-III-Administrasi Perkantoran'
      ],
      [
          'id' => 86,
          'fk_id' => 12,
          'name' => 'D-III-Perpustakaan dan Informasi'
      ],
      [
          'id' => 87,
          'fk_id' => 12,
          'name' => 'D-III-Kearsipan'
      ],
      [
          'id' => 88,
          'fk_id' => 12,
          'name' => 'D-III-Bahasa Inggris'
      ],
      [
          'id' => 87,
          'fk_id' => 12,
          'name' => 'D-III-Bahasa Jepang'
      ],
    ];

    foreach($prodi as $key => $item) {
      $pd = Prodi::where([
        'id_fakultas' => $item['fk_id'],
        'nama' => $item['name'],
      ])->first();
      if(empty($pd)) {
        Prodi::create([
          'id_fakultas' => $item['fk_id'],
          'nama' => $item['name'],
        ]);
      }
    }
  }
}
