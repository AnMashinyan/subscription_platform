<?php
namespace App\Http\Controllers;
use App\Events\PostCreate;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Sender;
use App\Models\Subscriber;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index(Post $post)
    {
        $posts = Post::all();
        return response()->json([
            'status' => true,
            'message' => 'Posts fetched successfully.',
            'data' => [
                'posts' => $posts,
            ],
        ]);
    }
    public function create(PostRequest $request)
    {
        $title = $request->get('title');
        $description = $request->get('description');
        $websiteId = $request->get('websiteId');

        $newPost = Post::create([
            'title' => $title,
            'description' => $description,
            'websiteId' => $websiteId
        ]);

        event(new PostCreate($newPost));

        return response('Post created successfully');
    }
    public function delete(Request $request)
    {
        $request->validate([
            'title' => 'required|exists:posts,title',
            'websiteId' => 'required|exists:posts,websiteId'

        ]);

        $post = Post::where('title', $request->title)
            ->where('websiteId', $request->websiteId)
            ->first();

        if ($post) {
            $post->delete();
            return response()->json(['message' => 'Successfully Deleted']);
        } else {
            return response()->json(['message' => 'Post not found']);
        }
    }

}

