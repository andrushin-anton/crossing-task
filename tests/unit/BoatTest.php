<?php

namespace test\unit;

use boats\Boat;
use people\Father;
use people\Mother;
use people\Son;
use people\Daughter;
use people\Boatman;

class BoatTest extends \PHPUnit_Framework_TestCase
{
		/**
		 * @expectedException Exception
		 * @expectedExceptionMessage Boat is busy
		 */
		public function testCanAcceptOnlyOneBigPerson()
		{
				$father = new Father('testF', 29);
				$mother = new Mother('testM', 27);

				$boat = Boat::getInstance();

				$boat->addPersonToBoat($father);
				$boat->addPersonToBoat($mother);
		}

		/**
		 * @expectedException Exception
		 * @expectedExceptionMessage Boat is busy
		 */
		public function testCanAcceptOnlyTwoSmallPerson()
		{
				$son = new Son('testS', 10);
				$daughter = new Daughter('testD', 12);
				$son2 = new Son('testS2', 15);

				$boat = Boat::getInstance();
				$boat->cleanBoat();

				$boat->addPersonToBoat($son);
				$boat->addPersonToBoat($son2);
				$boat->addPersonToBoat($daughter);
		}

		public function testOnlyTwoSmallPersonsInBoat()
		{
				$son = new Son('testS', 10);
				$daughter = new Daughter('testD', 12);

				$boat = Boat::getInstance();
				$boat->cleanBoat();

				$boat->addPersonToBoat($son);
				$boat->addPersonToBoat($daughter);

				$this->assertEquals(2, $boat->countPersonsInBoat());
		}

		public function testOnlyOneBigPersonsInBoat()
		{
				$boatman = new Boatman('testS', 48);
				$boat = Boat::getInstance();
				$boat->cleanBoat();

				$boat->addPersonToBoat($boatman);

				$this->assertEquals(1, $boat->countPersonsInBoat());
		}
}
