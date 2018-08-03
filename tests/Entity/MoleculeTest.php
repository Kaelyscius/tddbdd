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
use App\Entity\Molecule;
use PHPUnit\Framework\TestCase;

/**
 * $molecule = new Molecule('glucide');
 * $molecule->addAtom(new Atom('Carbon', 'C'))
 *          ->addAtom(new Atom('Oxygen', 'O'));
 * $molecule->getAtoms(); // retourne un tableau d'atomes
 * $molecule->merge(); // Réaliser la fusion si au moins 2 atomes
 * $molecule->getName(); // Renvoie CO
 * $molecule->getType(); // Renvoie glucide.
 */
class MoleculeTest extends TestCase
{
    public function testMoleculeCanBeInstantiated()
    {
        $this->assertInstanceOf(
            Molecule::class,
            new Molecule('glucide')
        );
    }

    public function testAtomCanBeAddedInMolecule()
    {
        /** @var Atom $atom */
        $atom = $this->createMock(Atom::class);
        $molecule = new Molecule('glucide');

        $this->assertSame($molecule, $molecule->addAtom($atom));
        $this->assertContainsOnlyInstancesOf(Atom::class, $molecule->getAtoms());
    }

    public function testMoleculeCannotContainOnlyOneAtom()
    {
        $this->expectException(\LogicException::class);
        // @var Atom $atom */
        $atom = $this->getMockBuilder(Atom::class)
            ->disableOriginalConstructor()
            ->setMethods(['getSymbol'])
            ->getMock();
        $atom->method('getSymbol')->willReturn('C');
        $molecule = new Molecule('glucide');
        $molecule->addAtom($atom);
        $molecule->getName();
    }

    public function testMoleculeCanBeMerged()
    {
        $carbon = $this->createConfiguredMock(Atom::class, [
            'getSymbol' => 'C',
        ]);
        $oxygen = $this->createConfiguredMock(Atom::class, [
            'getSymbol' => 'O',
        ]);
        $molecule = new Molecule('glucide');
        $molecule->addAtom($carbon)
                 ->addAtom($oxygen);
        $molecule->merge();
        $molecule->merge();
        $this->assertEquals('CO', $molecule->getName());
    }

    public function testCanRetrievedMoleculeType()
    {
        $molecule = new Molecule('glucide');
        $this->assertEquals('glucide', $molecule->getType());
    }
}
