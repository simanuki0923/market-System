<?php

namespace Tests\Unit;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_payment()
    {
        $user = User::factory()->create();
        $payment = Payment::create([
            'user_id' => $user->id,
            'payment_method' => 'credit_card',
        ]);

        $this->assertDatabaseHas('payments', [
            'user_id' => $user->id,
            'payment_method' => 'credit_card',
        ]);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $payment = Payment::create([
            'user_id' => $user->id,
            'payment_method' => 'credit_card',
        ]);

        $this->assertEquals($user->id, $payment->user->id);
    }
}