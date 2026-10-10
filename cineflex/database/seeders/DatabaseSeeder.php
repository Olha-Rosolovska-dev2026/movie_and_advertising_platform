<?php
/* Developer: Olha Rosolovska */
namespace Database\Seeders;

use App\Models\{User, Genre, Movie, Trailer, AdPlacement, AdCampaign, Post, Page, Purchase};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin & demo users
        User::create(['name' => 'Admin', 'email' => 'admin@cineflex.com', 'password' => Hash::make('password'), 'is_admin' => true]);
        User::create(['name' => 'Demo Viewer', 'email' => 'viewer@cineflex.com', 'password' => Hash::make('password'), 'is_admin' => false]);

        // Genres
        $genres = collect(['Action', 'Drama', 'Sci-Fi', 'Thriller', 'Comedy', 'Documentary', 'Animation', 'Horror'])
            ->mapWithKeys(fn ($name) => [$name => Genre::create([
                'name' => $name,
                'slug' => str()->slug($name),
                'description' => "Best of {$name} on CineFlex.",
            ])])->all();

        // Movies
        $movies = [
            ['title' => 'Midnight Horizon', 'year' => 2025, 'mins' => 128, 'rating' => '8.7', 'price' => 4.99, 'type' => 'movie', 'featured' => true,
             'synopsis' => 'A veteran pilot crash-lands in uncharted territory and must lead her crew through the night to survive until dawn.',
             'genres' => ['Action', 'Thriller']],
            ['title' => 'Neon Rain', 'year' => 2024, 'mins' => 142, 'rating' => '8.2', 'price' => 3.99, 'type' => 'movie', 'featured' => true,
             'synopsis' => 'In a rain-soaked megacity, a rogue detective hunts an AI that has learned to dream.',
             'genres' => ['Sci-Fi', 'Thriller']],
            ['title' => 'The Quiet Ocean', 'year' => 2023, 'mins' => 96, 'rating' => '7.9', 'price' => 0, 'type' => 'movie', 'featured' => false,
             'synopsis' => 'An award-winning documentary following marine biologists as they decode the songs of deep-sea whales.',
             'genres' => ['Documentary']],
            ['title' => 'Paper Lanterns', 'year' => 2024, 'mins' => 110, 'rating' => '8.0', 'price' => 2.99, 'type' => 'movie', 'featured' => false,
             'synopsis' => 'A heartwarming dramedy about a family-owned cinema fighting to stay open during its final summer.',
             'genres' => ['Drama', 'Comedy']],
            ['title' => 'Shadow Circuit', 'year' => 2025, 'mins' => 55, 'rating' => '8.5', 'price' => 5.99, 'type' => 'series', 'featured' => true,
             'synopsis' => 'An underground racing league becomes the front for an international heist in this eight-episode thriller.',
             'genres' => ['Action', 'Sci-Fi']],
            ['title' => 'Hollow Laughter', 'year' => 2023, 'mins' => 104, 'rating' => '7.4', 'price' => 3.49, 'type' => 'movie', 'featured' => false,
             'synopsis' => 'A stand-up comedian discovers her jokes are foretelling crimes in this dark psychological horror.',
             'genres' => ['Horror', 'Thriller']],
        ];

        $movieModels = [];
        foreach ($movies as $m) {
            $movieModels[] = Movie::create([
                'title' => $m['title'],
                'slug' => str()->slug($m['title']),
                'synopsis' => $m['synopsis'],
                'release_year' => $m['year'],
                'duration_minutes' => $m['mins'],
                'rating' => $m['rating'],
                'price' => $m['price'],
                'type' => $m['type'],
                'featured' => $m['featured'],
                'status' => 'published',
                'views' => rand(100, 9000),
                'trailer_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            ])->genres()->sync(array_map(fn ($n) => $genres[$n]->id, $m['genres']));
        }

        Trailer::create(['movie_id' => $movieModels[0]->id ?? 1, 'title' => 'Official Teaser', 'youtube_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'duration_seconds' => 90]);

        // Ad placements
        $hero = AdPlacement::create(['name' => 'Homepage Hero Banner', 'slug' => 'homepage-hero', 'location' => 'homepage-hero', 'description' => 'Wide banner above the movie grid on the homepage.', 'price_per_week' => 499.00]);
        $preroll = AdPlacement::create(['name' => 'Pre-Roll Slot', 'slug' => 'pre-roll', 'location' => 'pre-roll', 'description' => 'Shown on every movie detail page above the trailer grid.', 'price_per_week' => 299.00]);
        AdPlacement::create(['name' => 'Sidebar Skyscraper', 'slug' => 'sidebar', 'location' => 'sidebar', 'description' => 'Classic 300x600 sidebar unit across catalog pages.', 'price_per_week' => 149.00]);

        AdCampaign::create(['ad_placement_id' => $hero->id, 'title' => 'TurboCola — Feel the Rush', 'advertiser' => 'TurboCola Inc.', 'target_url' => 'https://example.com', 'budget' => 5000, 'status' => 'active', 'impressions' => 128400, 'clicks' => 5120, 'starts_at' => now()->subDays(5), 'ends_at' => now()->addDays(25)]);
        AdCampaign::create(['ad_placement_id' => $preroll->id, 'title' => 'StreamFest 2026 — Get Tickets', 'advertiser' => 'StreamFest Media', 'target_url' => 'https://example.com', 'budget' => 3200, 'status' => 'active', 'impressions' => 76200, 'clicks' => 2410, 'starts_at' => now()->subDays(2), 'ends_at' => now()->addDays(12)]);

        // Blog posts
        $admin = User::where('is_admin', true)->first();
        Post::create(['user_id' => $admin->id, 'title' => 'CineFlex Launches Its Advertising Marketplace', 'slug' => 'cineflex-launches-advertising-marketplace',
            'excerpt' => 'Brands can now book premium placements across the CineFlex network.',
            'content' => "Today we are opening our self-serve advertising marketplace to all brands.\n\nChoose a placement, set your budget and schedule, and go live within minutes. Impressions and clicks are tracked in real time from the advertiser dashboard.\n\nEarly partners are already seeing strong engagement on our homepage hero banner and pre-roll slots.",
            'published_at' => now()]);

        // CMS pages
        Page::create(['title' => 'About CineFlex', 'slug' => 'about', 'content' => "CineFlex is a cinematic streaming and advertising marketplace.\n\nWe connect film lovers with movies, series and trailers, and connect brands with a premium audience through our ad placements.\n\nDeveloper: Olha Rosolovska"]);
        Page::create(['title' => 'Advertise With Us', 'slug' => 'advertise', 'content' => "Reach a captive cinema audience on CineFlex.\n\nAvailable placements:\n\n- Homepage Hero Banner: $499 / week\n- Pre-Roll Slot: $299 / week\n- Sidebar Skyscraper: $149 / week\n\nContact our sales team to book a campaign."]);
        Page::create(['title' => 'Terms of Service', 'slug' => 'terms', 'content' => "By using CineFlex you agree to stream content only through authorized players and to respect all copyright. Advertisers are responsible for the content of their campaigns."]);
        Page::create(['title' => 'Privacy Policy', 'slug' => 'privacy', 'content' => "We collect only the data needed to run the service: account details, viewing history and ad interaction statistics. We never sell personal data to third parties."]);

        // Purchases
        $viewer = User::where('is_admin', false)->first();
        Purchase::create(['user_id' => $viewer->id, 'movie_id' => 1, 'amount' => 4.99]);
        Purchase::create(['user_id' => $viewer->id, 'movie_id' => 2, 'amount' => 3.99]);
    }
}
