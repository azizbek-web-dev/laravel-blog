<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
            'title' => 'The Impact of Technology on the Workplace: How Technology is Changing.',
                'content' => '<p>The impact of technology on the workplace is a topic that has been debated for years. Some people believe that technology is making the workplace more efficient, while others believe that it is making it more difficult to work. I believe that technology is making the workplace more efficient.</p>
                
                <h2>Increased Productivity</h2>
                <p>Technology has significantly increased productivity in the workplace. With tools like project management software, communication platforms, and automation tools, employees can accomplish more in less time. This efficiency allows companies to focus on innovation and growth rather than repetitive tasks.</p>
                
                <h2>Remote Work Revolution</h2>
                <p>The COVID-19 pandemic accelerated the adoption of remote work technologies. Video conferencing, cloud computing, and collaboration tools have made it possible for teams to work effectively from anywhere in the world. This flexibility has improved work-life balance for many employees.</p>
                
                <h2>Data-Driven Decision Making</h2>
                <p>Modern technology provides access to vast amounts of data that can inform business decisions. Analytics tools help managers understand performance metrics, customer behavior, and market trends, leading to more informed strategic planning.</p>
                
                <h2>Challenges and Solutions</h2>
                <p>While technology brings many benefits, it also presents challenges such as cybersecurity threats, digital fatigue, and the need for continuous learning. Companies must invest in proper training and security measures to maximize the benefits while minimizing risks.</p>
                
                <h2>Future Outlook</h2>
                <p>As artificial intelligence, machine learning, and automation continue to evolve, the workplace will become even more technology-driven. Organizations that embrace these changes and adapt their strategies accordingly will be best positioned for success in the digital age.</p>',
            'image' => 'img/post-1.jpg',
                'category_id' => 1, // Technology
                'author_id' => 1,
            ],
            [
                'title' => 'Healthy Lifestyle Tips for Busy Professionals',
                'content' => 'Maintaining a healthy lifestyle while juggling a demanding career can be challenging. Here are some practical tips to help busy professionals stay healthy and balanced.',
                'image' => 'img/post-2.jpg',
                'category_id' => 3, // Health
                'author_id' => 1,
            ],
            [
                'title' => 'Top Travel Destinations for 2024',
                'content' => 'Discover the most exciting travel destinations for 2024. From hidden gems to popular hotspots, these locations offer unforgettable experiences.',
                'image' => 'img/post-3.jpg',
                'category_id' => 4, // Travel
                'author_id' => 1,
            ],
            [
                'title' => 'Delicious and Easy Recipes for Beginners',
                'content' => 'Cooking at home doesn\'t have to be complicated. These simple recipes are perfect for beginners and will impress your family and friends.',
                'image' => 'img/post-4.jpg',
                'category_id' => 5, // Food
                'author_id' => 1,
            ],
            [
                'title' => 'Financial Planning for Young Adults',
                'content' => 'Building a solid financial foundation early in life is crucial. Learn about budgeting, saving, investing, and planning for your future.',
                'image' => 'img/post-5.jpg',
                'category_id' => 7, // Finance
                'author_id' => 1,
            ],
            [
                'title' => 'The Future of Artificial Intelligence',
                'content' => 'Artificial Intelligence is rapidly evolving and transforming various industries. Explore the latest developments and what the future holds.',
                'image' => 'img/post-6.jpg',
                'category_id' => 1, // Technology
                'author_id' => 1,
            ],
            [
                'title' => 'Sustainable Living: Small Changes, Big Impact',
                'content' => 'Making environmentally conscious choices doesn\'t require a complete lifestyle overhaul. Small changes can make a significant difference.',
                'image' => 'img/post-7.jpg',
                'category_id' => 18, // Environment
                'author_id' => 1,
            ],
            [
                'title' => 'Digital Marketing Strategies for Small Businesses',
                'content' => 'Effective digital marketing can help small businesses compete with larger companies. Learn proven strategies to grow your online presence.',
                'image' => 'img/post-8.jpg',
                'category_id' => 12, // Business
                'author_id' => 1,
            ],
            [
                'title' => 'Mindfulness and Mental Health in Modern Life',
                'content' => 'In our fast-paced world, taking care of mental health is more important than ever. Discover mindfulness techniques and mental wellness practices.',
                'image' => 'img/post-9.jpg',
                'category_id' => 20, // Self Improvement
                'author_id' => 1,
            ],
            [
                'title' => 'The Art of Photography: Capturing Life\'s Moments',
                'content' => 'Photography is more than just taking pictures. It\'s about capturing emotions, telling stories, and preserving memories for generations.',
            'image' => 'img/post-1.jpg',
                'category_id' => 19, // Photography
                'author_id' => 1,
            ],
        ];

        foreach ($posts as $postData) {
        Post::create([
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'content' => $postData['content'],
                'image' => $postData['image'],
                'meta_description' => Str::limit($postData['content'], 160),
                'author_id' => $postData['author_id'],
                'category_id' => $postData['category_id'],
            ]);
        }
    }
}
