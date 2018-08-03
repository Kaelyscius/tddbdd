<?php

/*
 * This file is part of the tddbdd package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Manager;

use App\Entity\User;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\StringInput;

class UserManagerFunctionalTest extends WebTestCase
{
    public static function setUpBeforeClass()
    {
        $client = self::createClient();
        $application = new Application($client->getKernel());
        $application->setAutoExit(false);
        $application->run(new StringInput('doctrine:database:drop --env=test --force'));
        $application->run(new StringInput('doctrine:database:create --env=test'));
        $application->run(new StringInput('doctrine:schema:update --env=test --force'));
    }

    public function testCanBeUsed()
    {
        $client = static::createClient();
        $service = $client->getContainer()->get(UserManager::class);
        $user = new User();
        $user->setUsername('matthieu');
        $user->setPassword('toto');
        $service->create($user);

        $this->assertCount(1, $client->getContainer()->get('doctrine')->getRepository(User::class)->findAll());
    }
}
