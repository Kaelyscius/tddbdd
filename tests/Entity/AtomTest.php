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

use App\Entity\Atom;
use PHPUnit\Framework\TestCase;

/**
 * $atom = new Atom('Carbone', 'C'); // Le symbole doit faire au maximum 2 caractères
 * $atom->getName(); // Doit retourner le nom de l'atome
 * $atom->getSymbol(); // Doit retourner le symbole.
 */
class AtomTest extends TestCase
{
    public function testAtomCanBeCreated()
    {
        $atom = new Atom('Carbon', 'C');
        $this->assertInstanceOf(Atom::class, $atom);
    }

    public function testAtomHasAName()
    {
        $atom = new Atom('Carbon', 'C');
        $this->assertEquals('Carbon', $atom->getName());

        $atom = new Atom('Oxygen', 'O');
        $this->assertEquals('Oxygen', $atom->getName());
    }

    public function testAtomHasASymbol()
    {
        $atom = new Atom('Carbon', 'C');
        $this->assertEquals('C', $atom->getSymbol());

        $atom = new Atom('Oxygen', 'O');
        $this->assertEquals('O', $atom->getSymbol());
    }

    public function testAtomCannotHaveSymbolMoreThanTwoCharacters()
    {
        $this->expectException(\LengthException::class);
        $atom = new Atom('Carbon', 'Ccc');
    }

    public function testAtomCannotBeCreatedWithoutNameAndSymbol()
    {
        $this->expectException(\ArgumentCountError::class);
        $atom = new Atom();
    }
}
