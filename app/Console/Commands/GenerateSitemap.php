<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;



class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';
    protected $sitemap;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->sitemap = new Sitemap();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = public_path('sitemap.xml');
      if (file_exists($path)) {
        \File::delete($path);
        fopen($path, 'w');
      } else {
          fopen($path, 'w');
      }

      SitemapGenerator::create(config('params.website_url'))->writeToFile($path);
      $this->addPostLinksToSitemap();
    }
    private function addPostLinksToSitemap(){
      $posts = Blog::orderBy('id', 'DESC')->where('is_active',1)->where('is_deleted',0)->get();
      $res = SitemapGenerator::create(config('params.website_url'))
            ->getSitemap();
      foreach($posts as $post){
        $parser_url = config('params.website_url');

        $url = $parser_url."/blog/".$post->route_name;
        $res->add(Url::create($url)
              // ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', today()))
              // ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
              ->setPriority(0.8)
          );
      }
      $res->writeToFile(public_path('sitemap.xml'));
    }
}
