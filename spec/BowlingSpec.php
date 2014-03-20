<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BowlingSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bowling');
    }

    function roll_many($times, $pins)
    {
    	for($i=0; $i<$times; $i++) 
    	{
    		$this->roll($pins);	
    	}
    }

    function it_can_score_a_gutter_game()
    {
    	$this->roll_many(20, 0);

    	$this->score()->shouldBe(0);
    }

    function it_can_score_all_one()
    {
    	$this->roll_many(20, 1);

    	$this->score()->shouldBe(20);
    }
	
    function it_can_score_one_spare()
    {
    	$this->roll_spare();

    	$this->roll(3);

    	$this->roll_many(17, 0);

    	$this->score()->shouldBe(16);
    }

    function roll_spare()
    {
    	$this->roll(5);
    	$this->roll(5);
    }

    function roll_strike()
    {
    	$this->roll(10);
    }

    function it_can_score_a_strike()
    {
    	
    	$this->roll_strike();

    	$this->roll(3);
    	$this->roll(4);

    	$this->roll_many(16, 0);

    	$this->score()->shouldBe(24);
    }

    function it_can_score_a_perfect_game()
    {
    	$this->roll_many(12, 10);

    	$this->score()->shouldBe(300);
    }
}
