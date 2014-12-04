<?php

namespace people;

class Family
{
		private $members = [];
		private $solution = [];
		private $membersOnStartSide = [];
		private $membersOnFinishSide = [];
		private $currentSide = 'membersOnStartSide';

		/**
		 * @return array
		 */
		public function howCrossTheRiver()
		{
				$this->membersOnStartSide = $this->members;

				$patterns = ['2small', Person::SMALL, Person::BIG, Person::SMALL];

				while(count($this->membersOnStartSide) != 0)
				{
						foreach($patterns as $pattern)
						{
								switch($pattern)
								{
										case '2small':
												$mem = [];
												foreach($this->getCurrentSideMembers() as $member)
												{
														if($member->getType() == Person::SMALL) {
																array_push($mem, $member);
																$this->changePersonSide($member);
														}
														if(count($mem) == 2)
																break;
												}
												array_push($this->solution, $mem);
												$this->changeSide();
												break;
										case Person::SMALL:
												foreach($this->getCurrentSideMembers() as $member)
												{
														if($member->getType() == Person::SMALL) {
																array_push($this->solution, $member);
																$this->changePersonSide($member);
																$this->changeSide();
																break;
														}
												}
												break;
										case Person::BIG:
												foreach($this->getCurrentSideMembers() as $member)
												{
														if($member->getType() == Person::BIG) {
																array_push($this->solution, $member);
																$this->changePersonSide($member);
																$this->changeSide();
																break;
														}
												}
												break;
								}
						}
				}
				return $this->solution;
		}

		/**
		 * @param Person $member
		 */
		public function addMember(Person $member)
		{
				if($this->checkMember($member))
						$this->members[] = $member;
		}

		/**
		 * @param Person $member
		 */
		public function removeMember(Person $member)
		{
				$this->members = array_udiff($this->members, array($member), function($a, $b) { return ($a === $b)?0:1; });
		}

		/**
		 * @param Person $member
		 * @return bool
		 */
		private function addToStartSide(Person $member)
		{
				if(in_array($member, $this->membersOnStartSide))
				{
						return false;
				}
				$this->membersOnStartSide[] = $member;
		}

		/**
		 * @param Person $member
		 */
		private function removeFromStartSide(Person $member)
		{
				foreach($this->membersOnStartSide as $k => $m)
				{
						if($m === $member)
						{
								unset($this->membersOnStartSide[$k]);
						}
				}
		}

		/**
		 * @param Person $member
		 * @return bool
		 */
		private function addToFinishSide(Person $member)
		{
				if(in_array($member, $this->membersOnFinishSide))
				{
						return false;
				}
				$this->membersOnFinishSide[] = $member;
		}

		/**
		 * @param Person $member
		 */
		private function removeFromFinishSide(Person $member)
		{
				foreach($this->membersOnFinishSide as $k => $m)
				{
						if($m === $member)
						{
								unset($this->membersOnFinishSide[$k]);
						}
				}
		}

		/**
		 * @param $newMember
		 * @return bool
		 * @throws \Exception
		 */
		private function checkMember($newMember)
		{
				if(in_array($newMember, $this->members))
				{
						return false;
				}

				foreach($this->members as $familyMember)
				{
						if(($familyMember instanceof Father && $newMember instanceof Father) || ($familyMember instanceof Mother && $newMember instanceof Mother))
						{
								throw new \Exception("There must be only one father and mother in the family");
						}
				}

				return true;
		}

		/**
		 *
		 */
		private function changeSide()
		{
				if($this->currentSide == 'membersOnStartSide')
				{
						$this->currentSide = 'membersOnFinishSide';
				}
				else
				{
						$this->currentSide = 'membersOnStartSide';
				}
		}

		/**
		 * @return array
		 */
		private function getCurrentSideMembers()
		{
				if($this->currentSide == 'membersOnStartSide')
				{
						return $this->membersOnStartSide;
				}
				else
				{
						return $this->membersOnFinishSide;
				}
		}

		/**
		 * @param $person
		 */
		private function changePersonSide($person)
		{
				if(in_array($person, $this->membersOnStartSide, TRUE))
				{
						$this->removeFromStartSide($person);
						$this->addToFinishSide($person);
				}
				elseif(in_array($person, $this->membersOnFinishSide, TRUE))
				{
						$this->removeFromFinishSide($person);
						$this->addToStartSide($person);
				}
		}
}