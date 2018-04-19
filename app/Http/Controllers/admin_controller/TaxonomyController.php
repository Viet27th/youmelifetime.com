<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 3/2/18
 * Time: 09:02
 */

namespace App\Http\Controllers\admin_controller;


use App\Http\Controllers\Controller;
use App\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Trait_xv\TaxonomyBootstrap;

class TaxonomyController extends Controller
{
    use TaxonomyBootstrap;

    public function categories()
    {
        return view('admin_layouts.taxonomies.categories');
    }

    public function tags()
    {
        return view('admin_layouts.taxonomies.tags');
    }


    public function edit(Request $request)
    {
        $cate_info = Taxonomy::find($request->id);
        return $cate_info;
    }

    public function delete(Request $request)
    {
        if ($request->taxonomy == 'tag') {
            foreach ($request->ids as $id) {
                $tax = Taxonomy::find($id);
                $tax->blogs()->detach();
                $tax->delete();
            }
        }
        if($request->taxonomy == 'category') {
            $post_ids_relative_with_categories = array();
            foreach($request->ids as $id){
                //lấy bài viết liên quan đến cate sắp xoá bao gồm cả bài viết đã soft delete
                $cate_with_blog_of_cate = Taxonomy::with(['blogs' => function ($q) {
                    $q->withTrashed();
                }])->find($id);
                // get all posts of category
                foreach ($cate_with_blog_of_cate->blogs as $blog){
                    $post_ids_relative_with_categories[] = $blog->id;
                }
                //remove all model of category in intermediate table
                Taxonomy::find($id)->blogs()->detach();
                //if is parent category, update child category to null
                Taxonomy::where('parent_id',$id)->update(['parent_id'=> null]);
            }
            //remove duplicate value in array
            $post_ids_relative_with_categories = array_unique($post_ids_relative_with_categories);
            //post's id list, current posts which belong to category default
            $post_ids_relative_with_category_default = array();
            foreach(Taxonomy::find($this->idCategoryDefault())->blogs as $blog){
                $post_ids_relative_with_category_default[] = $blog->id;
            }

            //avoid duplicate model when remove posts to category default
            $arr_provisional = array_unique(array_merge($post_ids_relative_with_categories,$post_ids_relative_with_category_default));
            //remove and update posts of category default in intermediate table
            Taxonomy::find($this->idCategoryDefault())->blogs()->sync($arr_provisional);
            //remove categories
            Taxonomy::destroy($request->ids);
            return $arr_provisional;
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'taxonomy' => 'required',
                'term' => 'required',
                'slug' => 'required|unique:taxonomies',
            ],
            [
                'required' => ':attribute không được để trống.',
                'unique' => ':attribute có thể đã tồn tại.',
            ],
            [
                'taxonomy' => 'Taxonomy',
                'term' => 'Tên danh mục',
                'slug' => 'Slug',
            ]
        );
        if ($request->ajax()) {
            if ($validator->passes()) {
                Taxonomy::create($request->all());
            } else if ($validator->errors()) {
//              nếu xảy ra lỗi khi validator , lỗi vẫn được gửi về responsive.data vì là request dạng ajax, chỉ gửi về catch error khi gửi bị lỗi
                return ['error' => $validator->errors()->all()];
            }
        }
    }

    public function update(Request $request, $taxId)
    {
        $validator = Validator::make($request->all(),
            [
                'taxonomy' => 'required',
                'term' => 'required',
                'slug' => [
                    'required',
                    Rule::unique('taxonomies')->ignore($taxId),
                ],
            ],
            [
                'required' => ':attribute không được để trống.',
                'unique' => ':attribute có thể đã tồn tại.',
            ],
            [
                'taxonomy' => 'Taxonomy',
                'term' => 'Tên danh mục',
                'slug' => 'Slug',
            ]
        );
        if ($request->ajax()) {
            if ($validator->passes()) {
                Taxonomy::where('id', $taxId)->update($request->all());
            } else if ($validator->errors()) {
//              nếu xảy ra lỗi khi validator , lỗi vẫn được gửi về responsive.data vì là request dạng ajax, chỉ gửi về catch error khi gửi bị lỗi
                return ['error' => $validator->errors()->all()];
            }
        }
    }

    //
    public function getCateList()
    {
        return Taxonomy::withCount('blogs')->where('taxonomy', 'category')->get();
    }

    //
    public function getTagList()
    {
        return Taxonomy::withCount('blogs')->where('taxonomy', 'tag')->get();
    }
}