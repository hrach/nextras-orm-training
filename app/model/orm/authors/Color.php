<?php

namespace App\Model;

class Color
{
	public function __construct(
		public readonly int $red,
		public readonly int $green,
		public readonly int $blue,
	)
	{
	}


	public function __toString(): string
	{
		return sprintf("#%02x%02x%02x", $this->red, $this->green, $this->blue);
	}
}
