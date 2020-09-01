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

    public function getAll($paginate = null){
        $posts = $this->model::orderBy('created_at', 'desc')->paginate($paginate);
        return $posts;
    }

}