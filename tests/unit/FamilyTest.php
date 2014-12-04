<?php

namespace test\unit;

use people\Family;
use boats\Boat;
use people\Father;
use people\Mother;
use people\Son;
use people\Daughter;
use people\Boatman;

class FamilyTest extends \PHPUnit_Framework_TestCase
{

		/**
		 * @expectedException Exception
		 * @expectedExceptionMessage There must be only one father and mother in the family
		 */
		public function testFamilyHasOnlyOneFather()
		{
				$father = new Father('testF', 29);
				$father2 = new Father('testF2', 29);
				$family = new Family();
				$family->addMember($father);
				$family->addMember($father2);
		}

		/**
		 * @expectedException Exception
		 * @expectedExceptionMessage There must be only one father and mother in the family
		 */
		public function testFamilyHasOnlyOneMother()
		{
				$mother = new Mother('testF', 29);
				$mother2 = new Mother('testF2', 29);
				$family = new Family();
				$family->addMember($mother);
				$family->addMember($mother2);
		}

		/**
		 * @expectedException Exception
		 * @expectedExceptionMessage Family must have at least 2 children
		 */
		public function testFamilyMustHaveAtLeastTwoChildren()
		{
				$son = new Son('testS', 19);
				$family = new Family();
				$family->addMember($son);
				$family->howCrossTheRiver();
		}
} 