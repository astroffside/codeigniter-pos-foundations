<?php

namespace App\Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

class AuthenticationTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $namespace = null;
    protected $seed = \App\Database\Seeds\PosSeeder::class;

    public function testGuestIsRedirectedFromProtectedCustomerAndUserPages(): void
    {
        $customers = $this->get('/customers');
        $customers->assertRedirect();

        $users = $this->get('/users');
        $users->assertRedirect();
    }

    public function testLoginPageAndValidCredentialsStartASession(): void
    {
        $loginPage = $this->get('/login');
        $loginPage->assertOK();
        $loginPage->assertSee('Sign in to POS Accounts');

        $result = $this->withBodyFormat('form')->post('/login', [
            'username' => 'mgarcia',
            'password' => 'pos12345',
        ]);

        $result->assertRedirect();
        $result->assertSessionHas('isLoggedIn', true);
    }

    public function testAuthenticatedStaffCanOpenProtectedPage(): void
    {
        $result = $this->withSession([
            'isLoggedIn' => true,
            'user_id'    => 1,
            'username'   => 'mgarcia',
            'full_name'  => 'Miguel Garcia',
        ])->get('/customers');

        $result->assertOK();
        $result->assertSee('Customer Accounts');
    }
}
