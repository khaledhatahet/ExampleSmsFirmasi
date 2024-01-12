<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_all_messages(){
        User::factory()->count(10)->create();
        Message::factory()->count(10)->create();

        $response = $this->get('/api/messages');

        $response->assertStatus(200)
        ->assertJson([
            'status' => true
        ]);
    }

    public function test_filter_messages_by_date(){
        User::factory()->count(10)->create();
        Message::factory()->count(10)->create();
        $todayDate = date("Y-m-d");

        $response = $this->get('/api/fliterMessagesByDate/' . $todayDate);

        $response->assertStatus(200)
        ->assertJson([
            'status' => true
        ]);
    }

    public function test_retrieve_a_specific_message_by_id(){

        User::factory()->count(10)->create();
        Message::factory()->count(10)->create();
        $id = rand(1,10);
        $response = $this->get('/api/messages/' . $id);

        $response->assertStatus(200)
        ->assertJson([
            'status' => true
        ]);
    }

    public function test_add_new_message(){

        $user = User::factory()->create();

        $message = [
            'number' => 5543253,
            'message' => 'Hello Hello Hello',
            'sender_id' => $user->id,
        ];

        $response = $this->post('/api/messages',$message);

        $response->assertStatus(200)
        ->assertJson([
            'status' => true ,
            'msg' => __('general.AddedSuccessfully')
        ]);

    }

}
