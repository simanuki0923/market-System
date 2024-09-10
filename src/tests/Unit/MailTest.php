<?php

namespace Tests\Unit;

use App\Models\Mail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_mail()
    {
        $user = User::factory()->create();

        $mail = Mail::create([
            'user_id' => $user->id,
            'recipient_email' => 'test@example.com',
            'subject' => 'Test Subject',
            'message' => 'This is a test message.',
        ]);

        $this->assertDatabaseHas('mails', [
            'user_id' => $user->id,
            'recipient_email' => 'test@example.com',
            'subject' => 'Test Subject',
            'message' => 'This is a test message.',
        ]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();

        $mail = Mail::create([
            'user_id' => $user->id,
            'recipient_email' => 'test@example.com',
            'subject' => 'Test Subject',
            'message' => 'This is a test message.',
        ]);

        $this->assertInstanceOf(User::class, $mail->user);
        $this->assertEquals($user->id, $mail->user->id);
    }
}