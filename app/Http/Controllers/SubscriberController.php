<?php
namespace App\Http\Controllers;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriberRequest;


class SubscriberController extends Controller
{
    public function index()
    {
        $subscriber = Subscriber::all();

        return response()->json([
            'status' => true,
            'message' => 'Websites fetched successfully.',
            'data' => [
                'subscribers' => $subscriber,
            ],
        ]);
    }
    public function create(SubscriberRequest $request)
    {
        $email = $request->get('email');
        $websiteId = $request ->get('websiteId');


        Subscriber::create([
            'email' => $email,
            'websiteId' => $websiteId
        ]);

        return response('Post created successfully');
    }


    public function delete(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:subscribers,email'
        ]);
        $user= Subscriber::where('email',  $request->title)->first();
        $request->validate([
            'email' => 'required',
        ]);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'Successfully Deleted']);
        } else {
            return response()->json(['message' => 'User not found']);
        }
    }
}

