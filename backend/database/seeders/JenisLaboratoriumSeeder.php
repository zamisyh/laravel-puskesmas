<?php

namespace Database\Seeders;

use App\Models\JenisLaboratorium;
use Illuminate\Database\Seeder;

class JenisLaboratoriumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $var = [
            [
                'keterangan' => 'Hematologi',
                'nilai' => 'hasil',
                'satuan' => 'satuan',
                'nilai_rujukan' => 'nilai rujukan'
            ],
            [
                'keterangan' => 'Hemoglobin',
                'nilai' => '',
                'satuan' => 'g /dL',
                'nilai_rujukan' => 'L = 13 - 16    P = 12 - 14'
            ],
            [
                'keterangan' => 'Leukosit',
                'nilai' => '',
                'satuan' => ' / uL',
                'nilai_rujukan' => '5.000 - 10.0000'
            ],
            [
                'keterangan' => 'Hematokrit',
                'nilai' => '',
                'satuan' => '%',
                'nilai_rujukan' => 'L = 40 - 45    P = 35 - 42'
            ],
            [
                'keterangan' => 'Eritrosit',
                'nilai' => '',
                'satuan' => 'Juta / uL',
                'nilai_rujukan' => '3,2 - 4,2'
            ],
            [
                'keterangan' => 'Trombosit',
                'nilai' => '',
                'satuan' => ' / uL',
                'nilai_rujukan' => '150.000 - 500.000'
            ],
            [
                'keterangan' => 'LED (Laju Endap Darah)',
                'nilai' =>  '',
                'satuan' => 'mm/jam',
                'nilai_rujukan' => '< 10'
            ],
            [
                'keterangan' => 'Hitung Jenis Leukosti',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => ''
            ],
            [
                'keterangan' => 'Basofil',
                'nilai' => '',
                'satuan' => '%',
                'nilai_rujukan' => '0 - 1'
            ],
            [
                'keterangan' => 'Eosinofil',
                'nilai' => '',
                'satuan' => '%',
                'nilai_rujukan' => '1 - 3'
            ],
            [
                'keterangan' => 'Batang',
                'nilai' => '',
                'satuan' => '%',
                'nilai_rujukan' => '2 - 6'
            ],
            [
                'keterangan' => 'Segmen',
                'nilai' => '',
                'satuan' => '%',
                'nilai_rujukan' => '50 - 70'
            ],
            [
                'keterangan' => 'Limfosit',
                'nilai' => '',
                'satuan' => '%',
                'nilai_rujukan' => '20 - 40'
            ],
            [
                'keterangan' => 'Monosit',
                'nilai' => '',
                'satuan' => '%',
                'nilai_rujukan' => '2 - 6'
            ],
            [
                'keterangan' => 'Golongan Darah',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => ''
            ],
            [
                'keterangan' => 'Kimia Darah',
                'nilai' => 'hasil',
                'satuan' => 'satuan',
                'nilai_rujukan' => 'nilai rujukan'
            ],
            [
                'keterangan' => 'Glukosa Darah (GDN)',
                'nilai' => '',
                'satuan' => 'mg / dL',
                'nilai_rujukan' => '70 - 110'
            ],
            [
                'keterangan' => 'Glukosa 2 Jam Pp',
                'nilai' => '',
                'satuan' => 'mg / dL',
                'nilai_rujukan' => '< 140'
            ],
            [
                'keterangan' => 'Glukosa Sewaktu (GDS)',
                'nilai' => '',
                'satuan' => 'mg / dL',
                'nilai_rujukan' => '< 180'
            ],
            [
                'keterangan' => 'Cholesterol',
                'nilai' => '',
                'satuan' => 'mg / dL',
                'nilai_rujukan' => '< 200'
            ],
            [
                'keterangan' => 'Trigliserida',
                'nilai' => '',
                'satuan' => 'mg / dL',
                'nilai_rujukan' => '60 - 150'
            ],
            [
                'keterangan' => 'HDL',
                'nilai' => '',
                'satuan' => 'mg / dL',
                'nilai_rujukan' => 'L = 30 - 60    P = 40 - 70'
            ],
            [
                'keterangan' => 'LDL',
                'nilai' => '',
                'satuan' => 'mg / dL',
                'nilai_rujukan' => '< 150'
            ],
            [
                'keterangan' => 'Asam Urat',
                'nilai' => '',
                'satuan' => 'mg / dL',
                'nilai_rujukan' => 'L = 3,5 - 7,2    P = 2,6 - 6,0'
            ],
            [
                'keterangan' => 'SGOT',
                'nilai' => '',
                'satuan' => 'U/L',
                'nilai_rujukan' => '< 25'
            ],
            [
                'keterangan' => 'SGPT',
                'nilai' => '',
                'satuan' => 'U/L',
                'nilai_rujukan' => '< 29'
            ],
            [
                'keterangan' => 'Ureum',
                'nilai' => '',
                'satuan' => 'mg / dL',
                'nilai_rujukan' => '10 - 50'
            ],
            [
                'keterangan' => 'Creatinin',
                'nilai' => '',
                'satuan' => 'mg / dL',
                'nilai_rujukan' => 'L = 0,9 - 1,3    P = 0,6 - 1,1'
            ],
            [
                'keterangan' => 'Urinalisa',
                'nilai' => 'hasil',
                'satuan' => 'satuan',
                'nilai_rujukan' => 'nilai rujukan'
            ],
            [
                'keterangan' => 'Makroskopi',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => ''
            ],
            [
                'keterangan' => 'Warna',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Putih / Kuning'
            ],
            [
                'keterangan' => 'Kejernihan',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Jernih / Keruh'
            ],
            [
                'keterangan' => 'pH',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => '5,0 - 6,0'
            ],
            [
                'keterangan' => 'Reduksi',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Protein',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Berat Jenis',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => '1,000 - 1,020'
            ],
            [
                'keterangan' => 'Lekosit',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Blood',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Keton',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Nitrit',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Urobilinogen',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => '0,2 - 0,4'
            ],
            [
                'keterangan' => 'Bilirubin',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Mikroskopi',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => ''
            ],
            [
                'keterangan' => 'Eritrosit',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => '0 - 1'
            ],
            [
                'keterangan' => 'Leukosit',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => '1 - 5'
            ],
            [
                'keterangan' => 'Epitel',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Bakteri',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Kristal',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Silinder',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Lain Lain',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Tes Kehamilan',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Positif / Negatif'
            ],
            [
                'keterangan' => 'Tes Narkoba',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Positif / Negatif'
            ],
            [
                'keterangan' => 'Morphine',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Amphetamin',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Marijuana',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Imuno / Serologi',
                'nilai' => 'hasil',
                'satuan' => 'satuan',
                'nilai_rujukan' => 'nilai rujukan'
            ],
            [
                'keterangan' => 'Widal',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => ''
            ],
            [
                'keterangan' => 'Salmonella Typhi O',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Salmonella Para Typhi Ao',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Salmonella Para Typhi Bo',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Salmonella Para Typhi Co',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Salmonella Typhi H',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Salmonella Para Typhi Ah',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Salmonella Para Typhi Bh',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Salmonella Para Typhi Ch',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'RPR / RVDL',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'TPHA',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'HbSAG',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Anti Hbs',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Anti HCV',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Lgm Anti HAV',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'IgG Dengue',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'IgG Dengue',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'NSOne',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Posifif / Negatif'
            ],
            [
                'keterangan' => 'Anti HIV',
                'nilai' => '',
                'satuan' => '',
                'nilai_rujukan' => 'Reaktif / Non Reaktif'
            ],
            [
                'keterangan' => 'Sifilis',
                'nilai' => NULL,
                'satuan' => NULL,
                'nilai_rujukan' => NULL
            ],

        ];

        JenisLaboratorium::insert($var);
    }
}
