<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class FixPostContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:fix-content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix HTML entities in post content';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to fix post content...');
        
        $posts = Post::all();
        $fixedCount = 0;
        
        foreach ($posts as $post) {
            if (is_string($post->content)) {
                $originalContent = $post->content;
                $fixedContent = html_entity_decode($originalContent, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                
                if ($originalContent !== $fixedContent) {
                    $post->content = $fixedContent;
                    $post->save();
                    $fixedCount++;
                    $this->info("Fixed content for post: {$post->title}");
                }
            }
        }
        
        $this->info("Completed! Fixed {$fixedCount} posts.");
        
        return 0;
    }
}

