<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Mail\PleaseConfirmYourEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserRegistrationTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function when_registration_is_disabled_users_cant_register()
    {
        config(['newton.registration.enabled' => false]);
        
        $this->get('/register')
            ->assertRedirect('/login');
            
        Mail::fake();
        
        $this->post('/register', [
            'name'                  => 'John Doe',
            'email'                 => 'john.doe@example.com',
            'password'              => 'foobar',
            'password_confirmation' => 'foobar',
        ]);
        
        $user = User::whereName('John Doe')->first();
        
        $this->assertNull($user);
    }
    
    /** @test */
    public function a_user_can_fully_confirm_their_email_address()
    {
        Mail::fake();
        
        $this->post('/register', [
            'name'                  => 'John Doe',
            'email'                 => 'john.doe@example.com',
            'password'              => 'foobar',
            'password_confirmation' => 'foobar',
        ]);
        
        $user = User::whereName('John Doe')->first();
        
        $this->assertFalse($user->confirmed);
        $this->assertNotNull($user->confirmation_token);
        
        $response = $this->get('/register/confirm?token='.$user->confirmation_token);
        
        $this->assertTrue($user->fresh()->confirmed);
        $this->assertNull($user->fresh()->confirmation_token);
        
        $response->assertRedirect('/login')
            ->assertSessionHas('flash');
    }
    
    /** @test */
    public function a_confirmation_email_is_sent_upon_registration()
    {
        Mail::fake();
        
        event(new Registered(create('App\User')));
        
        Mail::assertSent(PleaseConfirmYourEmail::class);
    }
    
    /** @test */
    public function users_must_first_authenticate_their_account_before_being_able_to_log_in()
    {
        $this->signIn(create('App\User', ['confirmed' => false]));
        
        $this->get('/')
            ->assertRedirect('/login')
            ->assertSessionHas('flash');
    }
    
    /** @test */
    public function confirmed_users_are_able_to_log_in()
    {
        $this->signIn();
        
        $this->get('/')
            ->assertStatus(200);
    }
    
    /** @test */
    public function confirming_an_invalid_token()
    {
        $response = $this->get('/register/confirm?token=invalid');
        
        $response->assertRedirect('/login')
            ->assertSessionHas('flash');
    }
    
    /** @test */
    public function users_must_register_with_valid_domain_when_set()
    {
        Mail::fake();
        
        config(['newton.registration.domain' => 'example.com']);
        
        $request = $this->post('/register', [
            'name'                  => 'John Doe',
            'email'                 => 'john.doe@notexample.com',
            'password'              => 'foobar',
            'password_confirmation' => 'foobar',
        ]);
        
        $user = User::whereName('John Doe')->first();
        
        $this->assertNull($user);
        
        $request->assertRedirect('/register')
            ->assertSessionHas('flash');
    }
}
