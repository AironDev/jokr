<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Http\Resources\PostResource;
use App\Post;
use App\User;
use App\Notifications\PostReaction;

class PostController extends Controller
{

    private $model;

    public function __construct(PostRepositoryInterface $postRepository){
        $this->model = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //request()->request->add(['auth_user_id' => $request]);
        //return PostResource::collection($this->model->getAll($paginate = 20));
        $posts = Post::orderBy('created_at', 'desc')->paginate(20);
        return PostResource::collection($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
    	$posted_at = Carbon::now();
    	$user_id = Auth::user()->id;

    	$data = [
    		'content' => $request->content,
    		'user_id' => $user_id,
    		'privacy' => $request->privacy,
            'tags' => $request->tags,
    	];
        Post::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }


    public function react(Request $request){

        $user = User::find($request->auth_user_id); 
        $post = Post::find($request->post_id);
        $type = $request->type;
        $rate = (int)$request->rate;

        if($user->id != Auth::user()->id){
            return "are you a marlian ?";
        }

        // user model instance of the Reacterable interface
        $userReactionInterface = $user->viaLoveReacter(); 
        // post model instance of the Reactable interface
        $postReactionInterface = $post->viaLoveReactant();
        $userNotReacted = $userReactionInterface->hasNotReactedTo($post, $type); 

        if($userNotReacted){
            $userReactionInterface->reactTo($post, $type, $rate);

            $reacters = $postReactionInterface->getReactions()->unique(function($item){
                return $item['reacter_id'];
            })->values()->all();

            $reactions = [
                'total' => $postReactionInterface->getReactionTotal()->getCount(),
                'points' => $postReactionInterface->getReactionTotal()->getWeight(),
                'reacters' => count($reacters),
                'status' => 'reacted',
            ];


            $notifyData = [
                'post_id' => $post->id,
                'user_id' => $user->id,
                'reaction_type' => $type, 
                'reaction_count' => $reactions['reacters'],
                'message' => $user->name . ' and ' . $reactions['reacters'] . ' others reacted to your post ',
            ];
            $post->first()->user->notify(new PostReaction($notifyData));
            return $reactions;

        }else{
            $userReactionInterface->unreactTo($post, $type, $rate);
            $reactions = [
                'total' => $postReactionInterface->getReactionTotal()->getCount(),
                'points' => $postReactionInterface->getReactionTotal()->getWeight(),
                'status' => 'unreacted',
            ];
            return $reactions;
        }
        //return $request->post_id;
    }
}
