<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;


class ItemSeeder extends Seeder{

    public function run(): void{
        $user = User::first();
        $cat = Category::first();
        $loc = Location::first();

        Item::create([
            'type' => 'found',
            'user_id' => $user->id,
            'category_id' => $cat->id,
            'location_id' => $loc->id,
            'name' => 'HP iPhone 13',
            'description' => 'Warna hitam, pakai case bening',
            'location_detail' => 'Di meja dekat jendela',
            'event_date' => now(),
            'kept_by' => 'Satpam pos depan',
        ]);

    }
}
