<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 3/3/18
 * Time: 15:44
 */

namespace App\Http\Controllers\admin_controller;


use App\Blog;
use App\Http\Controllers\Controller;
use App\Media;
use App\Taxonomy;
use App\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Storage;

class MediaController extends Controller
{
    public function index()
    {
        return view('admin_layouts.media.media');
    }

    public function store(Request $request)
    {
        if ($request->ajax() && !empty($request->dp_data)) {
            $current_year = date('Y');
            $current_month = date('m');
            if (!is_dir(storage_path('app/public/media/' . $current_year))) {
                Storage::makeDirectory('media/' . $current_year);
            }
            if (!is_dir(storage_path('app/public/media/' . $current_year . '/' . $current_month))) {
                Storage::makeDirectory('media/' . $current_year . '/' . $current_month);
            }
            foreach ($request->dp_data as $file) {
                $file_extension = $file->getClientOriginalExtension();
                if ($file_extension === 'png'
                    || $file_extension === 'PNG'
                    || $file_extension === 'jpg'
                    || $file_extension === 'JPG'
                    || $file_extension === 'jpeg'
                    || $file_extension === 'JPEG'
                    || $file_extension === 'gif'
                    || $file_extension === 'GIF'
                    || $file_extension === 'svg'
                    || $file_extension === 'SVG') {
                    $path = Storage::put('media/' . $current_year . '/' . $current_month, $file);
//                        $file->storeAs('media/'.$current_year.'/'.$current_month,'tenfile.png');
                    $info = getimagesize($file); //get width height image

                    $media = new Media;
                    $media->path = $path;
                    $media->original_name = $file->getClientOriginalName();
                    $media->extension = $file->getClientOriginalExtension();
                    $media->size = $file->getClientSize();
                    $media->dimensions_width = $info[0];
                    $media->dimensions_height = $info[1];
                    $media->upload_by = Auth::user()->name;
                    $media->user_id = Auth::id();
                    $media->save();
                }
            }
            return $request->dp_data;
        } else {
            return 'File is Empty!';
        }
    }

    public function get_file_ajax()
    {
        $result = Media::orderBy('id', 'desc')->get();
        return $result;
    }

    public function update(Request $request)
    {
        Media::where('id',$request->id)->update($request->all());
        Blog::where('feature_image_id',$request->id)
            ->update([
                'feature_image_alt'=>$request->alt,
                'feature_image_title'=>$request->title,
            ]);
        Taxonomy::where('feature_image_id',$request->id)
            ->update([
                'feature_image_alt'=>$request->alt,
                'feature_image_title'=>$request->title,
            ]);
    }

    public function delete(Request $request)
    {
        if($request->ajax()){
            Media::destroy($request->id);
            Storage::delete($request->path);
        }
    }
}