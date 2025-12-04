<?php

namespace Tests\Feature;

use App\Mail\ContactMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class ContactTest extends TestCase

{
    Use RefreshDatabase;


    /** @test */
    public function test_user_can_send_contact_email()
    {
        $testFormData = [
            'name' => 'Test Example',
            'email' => 'testExample@gmail.com',
            'message' => 'Example Message: Order not recived',
        ];

        Mail::fake();

        $response = $this->post('/contact', $testFormData);
        $response->assertRedirect(route('contact'));


        Mail::assertSent(ContactMail::class);

    }
}