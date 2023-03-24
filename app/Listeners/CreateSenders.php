<?php

namespace App\Listeners;

use App\Events\PostCreate;
use App\Models\Sender;
use App\Models\Subscriber;

class CreateSenders
{
    public function handle(PostCreate $event)
    {
        $newPost = $event->post;
        $websiteId = $newPost->websiteId;

        Subscriber::select('id')->where('websiteId', $websiteId)->chunk(1000, function ($subscribers) use ($newPost) {
            foreach ($subscribers as $subscriber) {
                Sender::create([
                    'postId' => $newPost->id,
                    'subscriberId' => $subscriber->id,
                    'isSend' => '0',
                ]);
            }
        });
    }
}
