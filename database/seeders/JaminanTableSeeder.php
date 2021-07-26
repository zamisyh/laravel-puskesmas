<?php

namespace Database\Seeders;

use App\Models\Jaminan;
use Illuminate\Database\Seeder;

class JaminanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama_jaminan' => 'KIS'],
            ['nama_jaminan' => 'ASKES'],
            ['nama_jaminan' => 'LM-NIK']
        ];


        Jaminan::insert($data);
    }
}
