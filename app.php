<?php

require_once 'bootstrap.php';

use boats\Boat;
use people\Father;
use people\Family;
use people\Mother;
use people\Son;
use people\Daughter;
use people\Boatman;

class Application
{
		public function run()
		{
				$father = new Father('Sergey', 32);
				$mother = new Mother('Tatyana', 29);
				$son = new Son('Oleg', 14);
				$daughter = new Daughter('Masha', 12);
				$boatman = new Boatman('Igor', 54);

				$family = new Family();
				$family->addMember($father);
				$family->addMember($mother);
				$family->addMember($son);
				$family->addMember($daughter);
				$family->addMember($boatman);

				$solution = $family->howCrossTheRiver();

				$family->removeMember($boatman);

				$boat = Boat::getInstance();

				//Here we go!
				foreach($solution as $whoCross)
				{
						if(is_array($whoCross))
						{
								foreach($whoCross as $person)
								{
										$boat->addPersonToBoat($person);
								}
						}
						else
						{
								$boat->addPersonToBoat($whoCross);
						}
						$boat->crossTheRiver();
				}
		}
}

$app = new Application();
$app->run();