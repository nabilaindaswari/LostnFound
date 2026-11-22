<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use PhpParser\Builder\Class_;

class LocationSeeder extends Seeder
{

    public function run(): void
    {
        $locs = [
            ['code' => 'fh', 'name' => 'Fakultas Hukum'],
            ['code' => 'feb', 'name' => 'Fakultas Ekonomi dan Bisnis'],
            ['code' => 'faperta', 'name' => 'Fakultas Pertanian'],
            ['code' => 'ft', 'name' => 'Fakultas Teknik'],
            ['code' => 'fisip', 'name' => 'Fakultas Ilmu Sosial dan Ilmu Politik'],
            ['code' => 'fkip', 'name' => 'Fakultas Keguruan dan Ilmu Pendidikan'],
            ['code' => 'fahutan', 'name' => 'Fakultas Kehutanan'],
            ['code' => 'fmipa', 'name' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam'],
            ['code' => 'fk', 'name' => 'Fakultas Kedokteran'],
            ['code' => 'gkba', 'name' => 'Gedung Kuliah Bersama A'],
            ['code' => 'gkbb', 'name' => 'Gedung Kuliah Bersama B'],
            ['code' => 'rkt', 'name' => 'Gedung Rektorat'],
            ['code' => 'knf', 'name' => 'Gedung Konferensi'],
            ['code' => 'st', 'name' => 'Jalanan'],
            ['code' => 'prp', 'name' => 'Perpustakaan'],
            ['code' => 'kys', 'name' => 'Kiyosu'],
        ];
        foreach ($locs as $loc) {
            Location::create($loc);
        }
    }

}
