<?php

/*
 * This file is part of the tddbdd package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Manager;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(ObjectManager $objectManager, UserPasswordEncoderInterface $encoder)
    {
        $this->objectManager = $objectManager;
        $this->encoder = $encoder;
    }

    public function create(User $user)
    {
        $hash = $this->encoder->encodePassword($user, $user->getPassword());
        $user->setPassword($hash);

        $this->objectManager->persist($user);
        $this->objectManager->flush();
    }
}
