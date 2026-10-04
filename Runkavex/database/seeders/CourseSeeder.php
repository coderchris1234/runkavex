<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseLesson;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Introduction to Cryptocurrency',
                'slug' => 'Introduction-to-Cryptocurrency',
                'category' => 'Crypto Basics',
                'description' => 'Start your journey into digital assets. This course covers what cryptocurrency is, how blockchains work, and how to safely store and manage your first wallet.',
                'price' => 0,
                'image_url' => 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=600',
                'lessons_count' => 3,
                'lessons' => [
                    ['title' => 'What is Cryptocurrency?', 'description' => 'Understanding digital money and why it matters', 'duration_seconds' => 360],
                    ['title' => 'Blockchain Explained Simply', 'description' => 'How the ledger behind crypto actually works', 'duration_seconds' => 500],
                    ['title' => 'Setting Up Your First Wallet', 'description' => 'Hands-on guide to storing and securing assets', 'duration_seconds' => 545],
                ],
            ],
            [
                'title' => 'Technical Analysis Masterclass',
                'slug' => 'Technical-Analysis-Masterclass',
                'category' => 'Technical Analysis',
                'description' => 'Learn to read price charts like a professional. Master trends, support and resistance, key indicators, and build a simple repeatable trading strategy.',
                'price' => 49.00,
                'image_url' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=600',
                'lessons_count' => 4,
                'lessons' => [
                    ['title' => 'Reading Price Charts', 'description' => 'Candlesticks, timeframes and chart basics', 'duration_seconds' => 460],
                    ['title' => 'Trends and Support/Resistance', 'description' => 'Identifying market direction and key levels', 'duration_seconds' => 615],
                    ['title' => 'Indicators for Beginners', 'description' => 'Moving averages, RSI and MACD made simple', 'duration_seconds' => 690],
                    ['title' => 'Building a Simple Strategy', 'description' => 'Combining concepts into a clear trading plan', 'duration_seconds' => 720],
                ],
            ],
            [
                'title' => 'Risk Management & Portfolio Strategy',
                'slug' => 'Risk-Management-&-Portfolio-Strategy',
                'category' => 'Risk Management',
                'description' => 'Protect your capital before pursuing returns. Learn position sizing, diversification, and how to think about risk across a portfolio.',
                'price' => 29.00,
                'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600',
                'lessons_count' => 2,
                'lessons' => [
                    ['title' => 'Position Sizing Basics', 'description' => 'Never risk more than you can afford to lose', 'duration_seconds' => 510],
                    ['title' => 'Diversification & Portfolio Thinking', 'description' => 'Balancing exposure across asset classes', 'duration_seconds' => 585],
                ],
            ],
            [
                'title' => 'Forex Trading for Beginners',
                'slug' => 'Forex-Trading-for-Beginners',
                'category' => 'Forex',
                'description' => 'A complete introduction to the world\'s largest financial market. Understand currency pairs, market structure, and make your first forex trade with confidence.',
                'price' => 19.00,
                'image_url' => 'https://images.unsplash.com/photo-1642790106117-e829e14a795f?w=600',
                'lessons_count' => 3,
                'lessons' => [
                    ['title' => 'Forex Market Fundamentals', 'description' => 'How the foreign exchange market is structured', 'duration_seconds' => 420],
                    ['title' => 'Major Currency Pairs', 'description' => 'Getting to know EUR/USD, GBP/USD and more', 'duration_seconds' => 495],
                    ['title' => 'Placing Your First Forex Trade', 'description' => 'Pips, lots and executing a trade step by step', 'duration_seconds' => 600],
                ],
            ],
        ];

        foreach ($courses as $c) {
            $course = Course::updateOrCreate(
                ['slug' => $c['slug']],
                [
                    'title' => $c['title'],
                    'category' => $c['category'],
                    'description' => $c['description'],
                    'price' => $c['price'],
                    'image_url' => $c['image_url'],
                    'lessons_count' => $c['lessons_count'],
                    'is_active' => true,
                ]
            );

            foreach ($c['lessons'] as $l) {
                CourseLesson::updateOrCreate(
                    ['course_id' => $course->id, 'title' => $l['title']],
                    [
                        'category' => $c['category'],
                        'description' => $l['description'],
                        'duration_seconds' => $l['duration_seconds'],
                        'video_url' => null,
                        'is_preview' => false,
                    ]
                );
            }
        }

        $standalone = [
            ['id' => 16, 'title' => 'Bitcoin vs Ethereum', 'category' => 'Crypto Basics', 'description' => 'Key differences between the two largest cryptocurrencies', 'duration_seconds' => 450],
            ['id' => 17, 'title' => 'Volume Profile Trading', 'category' => 'Technical Analysis', 'description' => 'Use volume profile to find high-probability setups', 'duration_seconds' => 555],
        ];

        foreach ($standalone as $s) {
            \Illuminate\Support\Facades\DB::table('course_lessons')->updateOrInsert(
                ['id' => $s['id']],
                [
                    'course_id' => null,
                    'title' => $s['title'],
                    'category' => $s['category'],
                    'description' => $s['description'],
                    'duration_seconds' => $s['duration_seconds'],
                    'video_url' => null,
                    'is_preview' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}