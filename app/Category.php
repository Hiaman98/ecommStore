<?php

namespace App;

use App\Section;
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

    public function subCategories() {
        return $this->hasMany(Category::class, "parent_id")->where("status", 1);
    }

    public function section() {
        return $this->belongsTo(Section::class);
    }

    public function parentCategory() {
        return $this->belongsTo(Category::class, "parent_id")->select("id", "category_name");
    }
}
