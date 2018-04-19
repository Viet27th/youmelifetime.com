<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 3/2/18
 * Time: 08:59
 */

namespace App\Http\Controllers\admin_controller;


use App\Blog;
use App\Http\Controllers\Controller;
use App\Media;
use App\Taxonomy;
use App\Trait_xv\TaxonomyBootstrap;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class BlogController extends Controller
{
    use TaxonomyBootstrap;

    //show template blogs
    public function index()
    {
        return view('admin_layouts.blogs.blogs');
    }

    //show content template blogs
    public function getAllPost(Request $request)
    {
        $allPosts = Blog::with(['taxonomies', 'user'])->orderBy('id', 'desc');
        $trashPosts = Blog::with(['taxonomies', 'user'])->onlyTrashed()->orderBy('id', 'desc');
        $publishPosts = Blog::with(['taxonomies', 'user'])->where('status', 'publish')->orderBy('id', 'desc');
        $pendingReviewPosts = Blog::with(['taxonomies', 'user'])->where('status', 'pending_review')->orderBy('id', 'desc');
        $draftPosts = Blog::with(['taxonomies', 'user'])->where('status', 'draft')->orderBy('id', 'desc');

        $allPostsCount = $allPosts->get()->count();
        $trashPostsCount = $trashPosts->get()->count();
        $publishPostsCount = $publishPosts->get()->count();
        $pendingReviewPostsCount = $pendingReviewPosts->get()->count();
        $draftPostsCount = $draftPosts->get()->count();

        if ($request->filterQuery == '' || $request->filterQuery == 'all') {

            $totalPage = $allPostsCount / $request->postPerPage;
            $currentPage = $request->currentPage;
            $skip = ($currentPage - 1) * $request->postPerPage;
            $take = $request->postPerPage;
            //pass total page
            if (gettype($totalPage) != 'integer') {
                $totalPage = intval($totalPage);
                $totalPage += 1;
            }
            //query
            $allPosts = $allPosts->skip($skip)->take($take)->get();
            return [
                'postsList' => $allPosts,
                'allPostsCount' => $allPostsCount,
                'trashPostsCount' => $trashPostsCount,
                'publishPostsCount' => $publishPostsCount,
                'pendingReviewPostsCount' => $pendingReviewPostsCount,
                'draftPostsCount' => $draftPostsCount,
                'totalPage' => $totalPage
            ];
        } else if ($request->filterQuery == 'trash') {
            $totalPage = $trashPostsCount / $request->postPerPage;
            $currentPage = $request->currentPage;
            $skip = ($currentPage - 1) * $request->postPerPage;
            $take = $request->postPerPage;
            //pass total page
            if (gettype($totalPage) != 'integer') {
                $totalPage = intval($totalPage);
                $totalPage += 1;
            }

            $trashPosts = $trashPosts->skip($skip)->take($take)->get();
            return [
                'postsList' => $trashPosts,
                'allPostsCount' => $allPostsCount,
                'trashPostsCount' => $trashPostsCount,
                'publishPostsCount' => $publishPostsCount,
                'pendingReviewPostsCount' => $pendingReviewPostsCount,
                'draftPostsCount' => $draftPostsCount,
                'totalPage' => $totalPage
            ];
        } else {
            $query = Blog::with(['taxonomies', 'user'])
                ->where('status', $request->filterQuery)
                ->orderBy('id', 'desc');

            $hasDynamicQueryCount = $query->get()->count();
            $totalPage = $hasDynamicQueryCount / $request->postPerPage;
            $currentPage = $request->currentPage;
            $skip = ($currentPage - 1) * $request->postPerPage;
            $take = $request->postPerPage;
            //pass total page
            if (gettype($totalPage) != 'integer') {
                $totalPage = intval($totalPage);
                $totalPage += 1;
            }
            //query
            $query = $query->skip($skip)->take($take)->get();
            return [
                'postsList' => $query,
                'allPostsCount' => $allPostsCount,
                'trashPostsCount' => $trashPostsCount,
                'publishPostsCount' => $publishPostsCount,
                'pendingReviewPostsCount' => $pendingReviewPostsCount,
                'draftPostsCount' => $draftPostsCount,
                'totalPage' => $totalPage
            ];
        }
    }

    //softDelete (move post into trash)
    public function softDelete(Request $request)
    {
        Blog::destroy($request->id);
    }

    //force delete post
    public function forceDelete(Request $request)
    {
        $blog = Blog::withTrashed()->find($request->id);
        $blog->taxonomies()->detach();
        $blog->forceDelete();
    }

    //restore post
    public function restore(Request $request)
    {
        Blog::where('id', $request->id)->onlyTrashed()->restore();
    }

    //
    public function create()
    {
        return view('admin_layouts.blogs.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'title' => 'required',
                'slug' => 'required|unique:blogs,slug',
            ],
            [
                'required' => ':attribute không được bỏ trống',
                'unique' => ':attribute đã tồn tại'
            ],
            [
                'title' => 'Tiêu đề bài viết',
                'slug' => 'Tên bài viết',
            ]);
        if ($validator->passes()) {
            $request->request->add(['user_id' => Auth::id()]);
            $post = Blog::create($request->except('categories', 'tags'));

            $new_post_id = $post->id;
            $tag_of_post = array();
            $cate_of_post = array();
            if (!empty($request->tags)) {
                foreach ($request->tags as $tag) {
                    $new_tag_info = Taxonomy::firstOrCreate(
                        ['slug' => str_slug($tag)], ['taxonomy' => 'tag', 'term' => $tag, 'slug' => str_slug($tag)]
                    );
                    $tag_of_post[] = $new_tag_info->id;
                }
            }
            if (empty($request->categories)) {
                $cate_of_post[] = $this->idCategoryDefault();
            } else {
                $cate_of_post = $request->categories;
            }
            $arr_cate_tag_of_post = array_merge($cate_of_post, $tag_of_post);
            Blog::find($new_post_id)->taxonomies()->sync($arr_cate_tag_of_post);
            return $post->id;
        } else if ($validator->errors()) {
            return ['error' => $validator->errors()->all()];
        }
    }

    public function edit($id)
    {
        $blog = Blog::withTrashed()->with('taxonomies')->find($id);
        $blog_info = $blog->toArray();
        //remove an element from an array
        unset($blog_info['taxonomies']);

        $categories = array();
        $tags = array();
        foreach ($blog->taxonomies as $taxonomy) {
            if ($taxonomy->taxonomy === 'category') {
                $categories[] = $taxonomy->id;
            } else if ($taxonomy->taxonomy === 'tag') {
                $tags[] = $taxonomy->term;
            }
        }
        return view('admin_layouts.blogs.edit', compact('id', 'blog_info', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'title' => 'required',
                'slug' => [
                    'required',
                    Rule::unique('blogs')->ignore($id),
                ],
            ],
            [
                'required' => ':attribute không được bỏ trống',
                'unique' => ':attribute đã tồn tại'
            ],
            [
                'title' => 'Tiêu đề bài viết',
                'slug' => 'Tên bài viết',
            ]);
        if ($validator->passes()) {
            $request->request->add(['user_id' => Auth::id()]);
            Blog::withTrashed()->where('id', '=', $id)->update($request->except('categories', 'tags'));

            $current_post_id = $id;
            $tag_of_post = array();
            $cate_of_post = array();
            if (!empty($request->tags)) {
                foreach ($request->tags as $tag) {
                    $new_tag_info = Taxonomy::firstOrCreate(
                        ['slug' => str_slug($tag)], ['taxonomy' => 'tag', 'term' => $tag, 'slug' => str_slug($tag)]
                    );
                    $tag_of_post[] = $new_tag_info->id;
                }
            }
            if (empty($request->categories)) {
                $cate_of_post[] = $this->idCategoryDefault();
            } else {
                $cate_of_post = $request->categories;
            }
            $arr_cate_tag_of_post = array_merge($cate_of_post, $tag_of_post);
            Blog::withTrashed()->find($current_post_id)->taxonomies()->sync($arr_cate_tag_of_post);
            return $current_post_id;
        } else if ($validator->errors()) {
            return ['error' => $validator->errors()->all()];
        }
    }
}