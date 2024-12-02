<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';
    public $timestamps = false;

    protected $fillable = [
        'title','description','route_name','link',
    ];

    public $sortable = ['title','description','route_name', 'link','i_date'];

    protected $casts = [
        'is_deleted' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Add an accessor for the embed URL
    public function getEmbedUrlAttribute()
    {
        // Check if the link column exists
        if ($this->link) {
            // If the link already contains "youtube.com/embed/", return it as-is
            if (strpos($this->link, 'youtube.com/embed/') !== false) {
                return $this->link;
            }

            // Otherwise, parse the link and convert it to an embed URL
            // $parsedUrl = parse_url($this->link);
            // if (isset($parsedUrl['query'])) {
            //     parse_str($parsedUrl['query'], $queryParams);

            //     // If the 'v' parameter exists, create the embed URL
            //     if (isset($queryParams['v'])) {

            //         return "https://www.youtube.com/embed/" . $queryParams['v'];
            //     }
            // }
            $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
            $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
            $url=$this->link;
            if (preg_match($longUrlRegex, $url, $matches)) {
                $youtube_id = $matches[count($matches) - 1];
            }
        
            if (preg_match($shortUrlRegex, $url, $matches)) {
                $youtube_id = $matches[count($matches) - 1];
            }
            return 'https://www.youtube.com/embed/' . $youtube_id ;
        }

        // Return null or the original link if not a valid YouTube link
        return $this->link;
    }

    public function getPreviewUrlAttribute()
    {
        // Check if the link column exists
        if ($this->link) {
            // If the link already contains "youtube.com/embed/", return it as-is
            if (strpos($this->link, 'youtube.com/embed/') !== false) {
                // return $this->link;
                $url=$this->link;;
                $parts = explode('v=', $url);
                if (isset($parts[1])) {
                    // Further split by '&' to get the video ID and return it
                    $videoId = explode('&', $parts[1])[0];
                    return $videoId;
                }
                return null; // Return null if the URL doesn't contain 'v='
            }

            // Otherwise, parse the link and convert it to an embed URL
            // $parsedUrl = parse_url($this->link);
            // if (isset($parsedUrl['query'])) {
            //     parse_str($parsedUrl['query'], $queryParams);

            //     // If the 'v' parameter exists, create the embed URL
            //     if (isset($queryParams['v'])) {

            //         return "https://www.youtube.com/embed/" . $queryParams['v'];
            //     }
            // }
            $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
            $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
            $url=$this->link;
            if (preg_match($longUrlRegex, $url, $matches)) {
                $youtube_id = $matches[count($matches) - 1];
            }
        
            if (preg_match($shortUrlRegex, $url, $matches)) {
                $youtube_id = $matches[count($matches) - 1];
            }
            
            $url='https://www.youtube.com/embed/' . $youtube_id ;
            $parts = explode('embed/', $url);
            if (isset($parts[1])) {
                // Further split by '&' to get the video ID and return it
                $videoId = explode('&', $parts[1])[0];
                return $videoId;
            }
            return null; // Return null if the URL doesn't contain 'v='
        }

        // Return null or the original link if not a valid YouTube link
        return $this->link;
    }
}
