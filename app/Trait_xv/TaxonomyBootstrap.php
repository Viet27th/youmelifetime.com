<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 4/14/18
 * Time: 20:57
 */

namespace App\Trait_xv;


use App\Taxonomy;

trait TaxonomyBootstrap
{
    private $categoryDefault;

    public function __construct()
    {
        $taxonomy = 'category';
        $term = 'Chưa phân loại';
        $slug = str_slug($term);
        $this->categoryDefault = Taxonomy::firstOrCreate(
            ['taxonomy' => $taxonomy, 'term' => $term, 'slug' => $slug]
        );
    }

    public function idCategoryDefault() {
        return $this->categoryDefault->id;
    }
}