<?php

/*
 * This file is part of the tddbdd package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;


class Molecule
{
    /**
     * @var Atom[]
     */
    private $atoms = [];
    private $name;
    private $type;

    /**
     * Molecule constructor.
     * @param string $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function addAtom(Atom $atom)
    {
        $this->atoms[] = $atom;

        return $this;
    }

    public function getAtoms()
    {
        return $this->atoms;
    }

    public function merge()
    {
        if (count($this->atoms) < 2) {
            throw new \LogicException('Il n\'y a pas assez d\'atomes dans la molécule');
        }

        $this->name = '';
        foreach ($this->atoms as $atom) {
            $this->name .= $atom->getSymbol();
        }
    }

    public function getName()
    {
        if (null === $this->name) {
            $this->merge();
        }

        return $this->name;
    }
}