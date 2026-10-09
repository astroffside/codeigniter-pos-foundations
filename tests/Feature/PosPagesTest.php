<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
final class PosPagesTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $namespace = null;

    protected $seed = \App\Database\Seeds\PosSeeder::class;

    public function testRequiredPagesRenderExpectedContent(): void
    {
        $pages = [
            '/' => [
                'POS Foundations',
            ],
            '/about' => [
                'From arrays to a real POS database.',
            ],
            '/customers' => [
                'Customer Accounts',
                'Database records',
                'Alicia Reyes',
                'alicia.reyes@example.com',
                '+63 917 555 0101',
                'Marco Dela Cruz',
                'marco.delacruz@example.com',
                '+63 917 555 0102',
                'Bianca Santos',
                'bianca.santos@example.com',
                '+63 917 555 0103',
                'Noel Villanueva',
                'noel.villanueva@example.com',
                '+63 917 555 0104',
                'Trisha Mendoza',
                'trisha.mendoza@example.com',
                '+63 917 555 0105',
            ],
            '/users' => [
                'User Accounts',
                'Database records',
                'Account created',
                '@mgarcia',
                'Miguel Garcia',
                '@jtorres',
                'Jasmine Torres',
                '@rsalazar',
                'Rina Salazar',
                '@dlim',
                'Daniel Lim',
                '@asoriano',
                'Andrea Soriano',
            ],
        ];

        foreach ($pages as $path => $expectedContents) {
            $result = in_array($path, ['/customers', '/users'], true)
                ? $this->withSession(['isLoggedIn' => true])->get($path)
                : $this->get($path);

            $result->assertOK();

            foreach ($expectedContents as $expectedContent) {
                $result->assertSee($expectedContent);
            }
        }
    }
}
