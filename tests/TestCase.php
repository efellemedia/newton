<?php

namespace Tests;

use App\User;
use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    
    /**
     * Set up the base test case.
     */
    public function setUp()
    {
        parent::setUp();
        
        $this->disableExceptionHandling();
    }
    
    /**
     * Sign in as a user.
     *
     * @return TestCase
     */
    protected function signIn($user = null)
    {
        $user = $user ?: create(User::class, ['confirmed' => true]);
        
        $this->actingAs($user);
        
        return $this;
    }
    
    /**
     * Disable exception handling for the given test.
     */
    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
        
        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct()
            {
                //
            }
            
            public function report(\Exception $exception)
            {
                //
            }
            
            public function render($request, \Exception $exception)
            {
                throw $exception;
            }
        });
    }
    
    /**
     * Enable exception handling for the given test.
     */
    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        
        return $this;
    }
}
