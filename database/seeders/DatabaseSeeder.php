<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            //UserSeeder::class,
            /**
             * List of seeders to populate the database with initial data.
             *
             * Each seeder class is responsible for seeding a specific part of the database:
             * - FeatureSeeder: Seeds features data.
             * - PropertySeeder: Seeds property data.
             * - PropertyPhotoSeeder: Seeds property photos.
             * - FavoriteSeeder: Seeds user favorites.
             * - MessageSeeder: Seeds messages between users.
             * - VisitSeeder: Seeds property visit records.
             * - PropertyViewSeeder: Seeds property view statistics.
             * - ReviewSeeder: Seeds user reviews for properties.
             */
            //FeatureSeeder::class,
            PropertySeeder::class,
            //PropertyPhotoSeeder::class,
            //FavoriteSeeder::class,
            //MessageSeeder::class,
            //VisitSeeder::class,
            //PropertyViewSeeder::class,
            //ReviewSeeder::class,
        ]);
    }
}
