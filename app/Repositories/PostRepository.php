<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Post;

class PostRepository implements PostRepositoryInterface {
    protected $model;

    public  function __construct(Post $post){
        $this->model = $post;
    }

    public function getAll($perPage = null){
        $posts = $this->model::orderBy('created_at', 'desc')->paginate($perPage);
        return $posts;
    }

}