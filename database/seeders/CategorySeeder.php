<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $cats = [
            ['code' => 'elec', 'name' => 'Elektronik'],
            ['code' => 'food', 'name' => 'Makanan'],
            ['code' => 'acce', 'name' => 'Aksesoris'],
            ['code' => 'clot', 'name' => 'Pakaian'],
            ['code' => 'bagg', 'name' => 'Tas & Koper'],
            ['code' => 'docu', 'name' => 'Dokumen & Kartu Identitas'],
            ['code' => 'keys', 'name' => 'Kunci'],
            ['code' => 'jwls', 'name' => 'Perhiasan & Barang Berharga'],
            ['code' => 'book', 'name' => 'Buku & Alat Tulis'],
            ['code' => 'spor', 'name' => 'Perlengkapan Olahraga'],
            ['code' => 'medi', 'name' => 'Obat-obatan & Kesehatan'],
            ['code' => 'cosm', 'name' => 'Kosmetik & Perawatan Diri'],
            ['code' => 'toys', 'name' => 'Mainan & Hobi'],
            ['code' => 'tool', 'name' => 'Perkakas & Alat Tukang'],
            ['code' => 'misc', 'name' => 'Lain-lain / Serbaguna'],
        ];

        foreach ($cats as $cat) {
            Category::create($cat);
        }
    }
}
