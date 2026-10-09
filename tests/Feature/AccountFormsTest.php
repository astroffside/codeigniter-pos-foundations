<?php

namespace App\Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

class AccountFormsTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $namespace = null;
    protected $seed = \App\Database\Seeds\PosSeeder::class;

    public function testCustomerAndUserFormPagesAreAvailable(): void
    {
        $customerForm = $this->withSession(['isLoggedIn' => true])->get('/customers/new');
        $customerForm->assertOK();
        $customerForm->assertSee('Full name');

        $userForm = $this->withSession(['isLoggedIn' => true])->get('/users/new');
        $userForm->assertOK();
        $userForm->assertSee('Username');

        $customerEdit = $this->withSession(['isLoggedIn' => true])->get('/customers/1/edit');
        $customerEdit->assertOK();
        $customerEdit->assertSee('Edit Customer');

        $userEdit = $this->withSession(['isLoggedIn' => true])->get('/users/1/edit');
        $userEdit->assertOK();
        $userEdit->assertSee('Profile photo');
    }

    public function testCustomerCreationStoresAValidRecord(): void
    {
        $result = $this->withSession(['isLoggedIn' => true])->withBodyFormat('form')->post('/customers', [
            'full_name' => 'TFA Three Customer',
            'email'     => 'tfa3.customer@example.com',
            'phone'     => '0917 555 0199',
        ]);

        $result->assertRedirect();
        $this->seeInDatabase('customers', ['email' => 'tfa3.customer@example.com']);
    }

    public function testUserCreationStoresAUniqueUsername(): void
    {
        $result = $this->withSession(['isLoggedIn' => true])->withBodyFormat('form')->post('/users', [
            'username'  => 'tfa3user',
            'full_name' => 'TFA Three User',
            'password'  => 'securepass123',
        ]);

        $result->assertRedirect();
        $this->seeInDatabase('users', ['username' => 'tfa3user']);
    }

    public function testUserUpdatePreservesTheExistingUsernameWhenNoAvatarIsUploaded(): void
    {
        $result = $this->withSession(['isLoggedIn' => true])->withBodyFormat('form')->post('/users/1', [
            'username'  => 'mgarcia',
            'full_name' => 'Miguel Garcia Updated',
        ]);

        $result->assertRedirect();
        $this->seeInDatabase('users', [
            'id'        => 1,
            'username'  => 'mgarcia',
            'full_name' => 'Miguel Garcia Updated',
        ]);
    }
}
