<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;

class Post extends Model
{

    protected $fillable = ['title', 'excerpt', 'published_at', 'slug', 'image', 'body', 'category_id'];
    protected $dates = ['published_at'];

    public function getImageUrlAttribute(){

        $imageUrl = '';
        if(! is_null($this->image)){
            $directory_img = config('cms.image.directory');
            $imagePath = public_path()."/{$directory_img}/".$this->image;
            if(file_exists($imagePath)){
                $imageUrl = asset("{$directory_img}/".$this->image);
                return $imageUrl;
            }
        }
    }

    public function getImageUrlThumbAttribute()
    {

       //$extension = $this->image->getClientOriginalExtension();
        $thumb = str_replace(".", "_thumb.", $this->image );
        $directory_img = config('cms.image.directory');
       if(file_exists(public_path()."/{$directory_img}/".$thumb)){
           if($thumb== '')
            return "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
        $thumb_url = '';
           $thumb_url = asset("{$directory_img}/".$thumb);
           return $thumb_url;
       }

    }

    public function getDateAttribute(){

        return $this->published_at->diffForHumans();

    }

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function comments(){

        return $this->hasMany(Comment::class);

    }

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function scopeFirstLatest($query){

        return $query->orderBy('created_at', 'desc');

    }

    public function scopePublished($query){

        $now = Carbon::now();
        return $query->where('published_at', '<=', $now);

    }

    public function scopePopular($query)
    {
       return $query->orderBy('view_count', 'DESC');
    }

    public function getBodyHtmlAttribute(){

        return $this->body ? Markdown::convertToHtml(e($this->body)) : NULL ;

    }

    public function timePublished($time = false){

            $format = $time ? 'Y-m-d H:s:i' : 'Y-m-d';
            return $this->created_at->format($format);

    }

    public function publishedLabel(){

        if(!$this->published_at){
            return "<span class='label label-warning'>Draft</span>";
        }elseif($this->published_at && $this->published_at->isFuture()){
            return "<span class='label label-info'>Schedule</span>";
        }
        return "<span class='label label-success'>Published</span>";

    }

    public function setPublishedAtAttribute ($value){

        $this->attributes['published_at'] = $value ?: NULL;

    }

}
