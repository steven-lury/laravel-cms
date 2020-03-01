<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
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

        return $this->created_at->diffForHumans();

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
}
