<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;

class Post extends Model
{

    protected $dates = ['published_at'];
    public function getImageUrlAttribute(){

        $imageUrl = '';
        if(! is_null($this->image)){
            $imagePath = public_path()."/img/".$this->image;
            if(file_exists($imagePath)){
                $imageUrl = asset('img/'.$this->image);
                return $imageUrl;
            }
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

    public function scopeFirstLatest($query){

        return $query->orderBy('created_at', 'desc');

    }

    public function scopePublished($query){

        $now = Carbon::now();
        return $query->where('published_at', '<=', $now);

    }

    public function getBodyHtmlAttribute(){

        return $this->body ? Markdown::convertToHtml(e($this->body)) : NULL ;

    }
}
