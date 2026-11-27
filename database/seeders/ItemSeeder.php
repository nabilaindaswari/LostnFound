<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemQuestion;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        // DINONAKTIFKAN SEMENTARA (2026-11-27): data dummy akan dibuat ulang di akhir.
        return;

        $users = User::all()->values();
        $categories = Category::all()->values();
        $locations = Location::all()->values();

        // Tiga foto yang sudah ada di storage/app/public/items.
        $photos = [
            'items/pLmGPLzI3BeUcecHDMnkSUJRnlA6cxXEAvkkiUCF.jpg',
            'items/zZlJMl3JJ8LtU84rAuZDqfGTEEevMF1GlqmVpwsS.jpg',
            'items/Ky1HWjLVyAWr1F75dZCg0IiEyxoXe9Jc76DXjC0K.jpg',
        ];

        // Baris pertama memakai id=1 supaya dummy lama ikut diperbarui, bukan jadi baris baru.
        $samples = [
            // ['id' => 1, 'name' => 'HP iPhone 13', 'description' => 'Warna hitam, pakai case bening', 'location_detail' => 'Di meja dekat jendela'],
            ['name' => 'Dompet hitam', 'description' => 'Dompet kulit dengan kartu mahasiswa di dalamnya', 'location_detail' => 'Di koridor fakultas'],
            ['name' => 'Kunci motor Honda', 'description' => 'Gantungan kunci biru bertuliskan Honda', 'location_detail' => 'Di parkiran motor'],
            ['name' => 'Botol tumbler hijau', 'description' => 'Tumbler hijau dengan tas kain', 'location_detail' => 'Di meja kantin'],
            ['name' => 'Buku catatan biru', 'description' => 'Buku catatan berjilid biru, ada coretan nama', 'location_detail' => 'Di rak perpustakaan'],
            ['name' => 'Kacamata hitam', 'description' => 'Kacamata hitam lensa gelap', 'location_detail' => 'Di bangku depan kelas'],
            ['name' => 'Flashdisk 32GB', 'description' => 'Flashdisk putih bertanda kampus', 'location_detail' => 'Di lab komputer'],
            ['name' => 'Jaket hoodie abu', 'description' => 'Hoodie abu-abu ukuran M', 'location_detail' => 'Di ruang tunggu asrama'],
            ['name' => 'Tas ransel hitam', 'description' => 'Ransel hitam dengan resleting kuning', 'location_detail' => 'Di halte kampus'],
            ['name' => 'Kartu mahasiswa', 'description' => 'Kartu mahasiswa dengan foto', 'location_detail' => 'Di depan gerbang'],
        ];

        $questionTemplates = [
            ['question' => 'Apa warna dominan barang ini?', 'option_a' => 'Hitam', 'option_b' => 'Putih', 'option_c' => 'Biru'],
            ['question' => 'Di area mana kira-kira barang ditemukan?', 'option_a' => 'Koridor', 'option_b' => 'Kantin', 'option_c' => 'Perpustakaan'],
            ['question' => 'Apa ciri khas barangnya?', 'option_a' => 'Ada stiker', 'option_b' => 'Ada tali', 'option_c' => 'Polos'],
            ['question' => 'Kapan barang itu hilang?', 'option_a' => 'Pagi', 'option_b' => 'Siang', 'option_c' => 'Sore'],
        ];

        foreach ($samples as $i => $sample) {
            $key = isset($sample['id'])
                ? ['id' => $sample['id']]
                : ['name' => $sample['name']];

            $item = Item::updateOrCreate(
                $key,
                [
                    'type' => 'found',
                    'user_id' => $users[$i % $users->count()]->id,
                    'category_id' => $categories[$i % $categories->count()]->id,
                    'location_id' => $locations[$i % $locations->count()]->id,
                    'name' => $sample['name'],
                    'description' => $sample['description'],
                    'location_detail' => $sample['location_detail'],
                    'event_date' => now()->subDays($i)->toDateString(),
                    'kept_by' => 'Satpam pos depan',
                    'photo' => $photos[$i % count($photos)],
                    'status' => 'open',
                ]
            );

            foreach ($questionTemplates as $order => $template) {
                $template['correct_option'] = ['a', 'b', 'c'][($i + $order) % 3];

                ItemQuestion::updateOrCreate(
                    ['item_id' => $item->id, 'order' => $order + 1],
                    $template
                );
            }
        }
    }
}
