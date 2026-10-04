<?php

namespace Database\Seeders;

use App\Models\NftCategory;
use App\Models\NftCollection;
use App\Models\NftItem;
use Illuminate\Database\Seeder;

class NftSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'name' => 'Digital Art'],
            ['id' => 2, 'name' => 'Photography'],
            ['id' => 3, 'name' => 'Music'],
            ['id' => 4, 'name' => 'Collectibles'],
            ['id' => 5, 'name' => 'Virtual Worlds'],
        ];
        foreach ($categories as $cat) {
            NftCategory::updateOrCreate(['id' => $cat['id']], $cat);
        }

        $collections = [
            ['id' => 1, 'name' => 'Cosmic Explorers', 'description' => 'Handcrafted astronauts exploring the far reaches of space.'],
            ['id' => 2, 'name' => 'Urban Lens', 'description' => 'Street photography from the world\'s most vibrant cities.'],
            ['id' => 3, 'name' => 'Beat Drops', 'description' => 'Digital art inspired by music, rhythm and sound.'],
            ['id' => 4, 'name' => 'Pixel Legends', 'description' => 'Retro pixel-art heroes reimagined for a new generation.'],
            ['id' => 5, 'name' => 'Meta Estates', 'description' => 'Virtual land and buildings in the metaverse.'],
        ];
        foreach ($collections as $col) {
            NftCollection::updateOrCreate(['id' => $col['id']], $col);
        }

        $items = [
            ['name' => 'Cosmic Explorer #42', 'desc' => 'An astronaut drifting past the rings of Saturn, hand-painted in deep space tones.', 'collection' => 1, 'category' => 1, 'price' => 250.00, 'seed' => 'cosmic42'],
            ['name' => 'Nebula Wave', 'desc' => 'Abstract rendering of a nebula caught in perpetual motion.', 'collection' => 1, 'category' => 1, 'price' => 180.00, 'seed' => 'nebula'],
            ['name' => 'Midnight Metro', 'desc' => 'A lone commuter captured under the neon glow of a late-night platform.', 'collection' => 2, 'category' => 2, 'price' => 95.00, 'seed' => 'metro'],
            ['name' => 'Rooftop Light', 'desc' => 'Golden-hour cityscape shot from a Brooklyn rooftop.', 'collection' => 2, 'category' => 2, 'price' => 120.00, 'seed' => 'rooftop'],
            ['name' => 'Bassline Bloom', 'desc' => 'Visual of a bassline breaking into thousands of petals.', 'collection' => 3, 'category' => 3, 'price' => 160.00, 'seed' => 'bassline'],
            ['name' => 'Synth Skyline', 'desc' => 'A synthwave skyline pulsing to an 80s heartbeat.', 'collection' => 3, 'category' => 1, 'price' => 210.00, 'seed' => 'synth'],
            ['name' => 'Pixel Monarch', 'desc' => 'A pixel-art ruler of the ancient retro realm.', 'collection' => 4, 'category' => 4, 'price' => 75.00, 'seed' => 'monarch'],
            ['name' => 'Blade Rogue', 'desc' => 'Rare raider from the pixelverse — one of a kind.', 'collection' => 4, 'category' => 4, 'price' => 130.00, 'seed' => 'rogue'],
            ['name' => 'Skyline Plot #7', 'desc' => 'Prime virtual land with a view of the city plaza.', 'collection' => 5, 'category' => 5, 'price' => 500.00, 'seed' => 'skyline7'],
            ['name' => 'Crystal Tower', 'desc' => 'A crystalline skyscraper in the heart of Meta Estates.', 'collection' => 5, 'category' => 5, 'price' => 640.00, 'seed' => 'tower'],
        ];

        foreach ($items as $item) {
            NftItem::create([
                'owner_id' => 1,
                'created_by' => 1,
                'collection_id' => $item['collection'],
                'category_id' => $item['category'],
                'name' => $item['name'],
                'description' => $item['desc'],
                'image' => 'https://picsum.photos/seed/' . $item['seed'] . '/600/600',
                'price' => $item['price'],
                'status' => 'listed',
            ]);
        }
    }
}