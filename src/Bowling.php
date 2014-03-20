<?php

class Bowling
{
	private $score = 0;

	private $rolls = array();

	private $current_roll = 0;

    public function roll($pins)
    {
    	$this->rolls[$this->current_roll++] = $pins;
    }

    public function score()
    {	
    	$frame_index = 0;

    	for($frame=0; $frame<10; $frame++)
    	{
    		if($this->is_strike($frame_index))
    		{
    			$this->score+= $this->get_strike_bonus($frame_index) + 10;
    			$frame_index++;
    		}
    		elseif($this->is_spare($frame_index))
    		{
    			$this->score+= $this->get_spare_bonus($frame_index) + 10;
    			$frame_index+=2;
    		}
    		else 
    		{
    			$this->score+= $this->get_pins_in_frame($frame_index);
    			$frame_index+=2;
    		}   		
    	}

    	return $this->score;
    }

    private function get_pins_in_frame($frame_index)
    {
    	return $this->rolls[$frame_index] + 
    		$this->rolls[$frame_index + 1];
    }

    private function get_strike_bonus($frame_index)
    {
    	return $this->rolls[$frame_index+1] + 
    		$this->rolls[$frame_index+2];
    }

    private function get_spare_bonus($frame_index)
    {
    	return $this->rolls[$frame_index+2];
    }

    private function is_strike($frame_index)
    {
    	return $this->rolls[$frame_index] === 10;
    }

    private function is_spare($frame_index)
    {
    	return ($this->rolls[$frame_index] + 
    		$this->rolls[$frame_index+1]) === 10;
    }
}
