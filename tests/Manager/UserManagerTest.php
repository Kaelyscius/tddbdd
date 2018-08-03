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
use Doctrine\Common\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManagerTest extends TestCase
{
    public function testCanBeUsed()
    {
        // UserManager dependencies
        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager->expects($this->once())->method('persist');
        $objectManager->expects($this->once())->method('flush');
        $encoder = $this->createConfiguredMock(UserPasswordEncoderInterface::class, [
            'encodePassword' => '&djhhte889402JJFUVFFZFZF4',
        ]);

        $user = new User();
        $user->setPassword('toto');

        $manager = new UserManager($objectManager, $encoder);
        $manager->create($user);

        $this->assertSame('&djhhte889402JJFUVFFZFZF4', $user->getPassword());
    }
}
