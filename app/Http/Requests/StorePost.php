<?php

namespace App\Http\Requests;

use JD\Cloudder\Facades\Cloudder;
use App\Helper\checkAndUploadImage;
use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\Contracts\BlogRepoInterface;
use App\Helper\returnIdFromRequestSegment;

class StorePost extends FormRequest
{
    use checkAndUploadImage, returnIdFromRequestSegment;

    protected $id;

    public function __construct(BlogRepoInterface $blogRepo)
    {
        $this->id = $this->returnIdFromRequestSegment(4);
        $this->blogRepo = $blogRepo;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|mimes:jpeg,jpg,png',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'body' => 'required|min:50',
        ];
    }

    public function uploadPost()
    {
        $data = $this->all();
        $storagePath = 'cinemaxii/blogposts/';
        $width = 640;
        $height = 426;
        try {
            $imageName = $this->checkAndUploadImage($this, $data, $storagePath, $width, $height);
        } catch (\Cloudinary\Error $e) {
            Log::error($e->getMessage());
            return false;
        }

        $data['image'] = $imageName[0];
        $data['public_id'] = $imageName[1];

        try {
            $blog = $this->blogRepo->createBlogPost($data);
            $this->blogRepo->createImageForBlogPost($blog->id, $data);
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return false;
        }

        return true;
    }

    public function updatePost()
    {
        if ($this->has('image')) {
            Cloudder::destroyImage($this->public_id);
            Cloudder::delete($this->public_id);
        }

        $data = $this->all();
        $tp = $this->blogRepo->updateBlogPost($this->id, $data);
        $storagePath = 'cinemaxii/blogposts/';
        $width = 640;
        $height = 426;

        try {
            $imageName = $this->checkAndUploadImage($this, $data, $storagePath, $width, $height);
            $this->blogRepo->updateImageForBlogPost($tp->id, $imageName);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    public function deletePost()
    {
        $i = $this->blogRepo->getImageForBlogPost($this->id);
        try {
            Cloudder::destroyImage($i->public_id);
            Cloudder::delete($i->public_id);
        } catch (\Cloudinary\Error $e) {
            Log::error($e->getMessage());
            return false;
        }

        try {
            $this->blogRepo->deleteBlogPost($id);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}
