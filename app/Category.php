<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = [
        "category_name",
        "section_id",
        "parent_id",
        "category_discount",
        "url",
        "description",
        "meta_tilte",
        "meta_description",
        "meta_keywords"
    ];
}
