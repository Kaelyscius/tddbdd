<?php

/*
 * This file is part of the tddbdd package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\User\UserInterface;

class UserTest extends TestCase
{
    public function testUserSpec()
    {
        $user = new User();
        $user->setUsername('matthieu');
        $user->setPassword('toto');

        $this->assertInstanceOf(UserInterface::class, $user);
        $this->assertSame('matthieu', $user->getUsername());
        $this->assertSame('toto', $user->getPassword());
    }
}
