<?php

namespace Kitsune\ClubPenguin\Handlers\Play;

use Kitsune\ClubPenguin\Packets\Packet;

trait DJ3K {

	/*
	* This is all terrible, but it is a start.
	*/

	protected function handleMultiData($socket) {
		$penguin = $this->penguins[$socket];
		$penguin->room->send("%xt%ggd%{$penguin->room->internalId}%{$penguin->id}%1%");
	}

	protected function handleTrackSave($socket) {
		$penguin = $this->penguins[$socket];
		$trackId = Packet::$Data[2];
		$penguin->send("%xt%vn%{$penguin->room->internalId}%{$penguin->id}%$trackId%");
		$penguin->database->updateColumnById($penguin->id, "Tracks", $trackId);
	}

	protected function handleDJExit($socket) {
		$penguin = $this->penguins[$socket];
		$DJ1K = Packet::$Data[2]; // 0
		$DJ2K = Packet::$Data[3]; // 0
		$DJ3K = Packet::$Data[4]; // 0
		//$penguin->send("%xt%djbis%{$penguin->room->internalId}%{$penguin->id}%0%0%0%");
		$penguin->send("%xt%djbis%{$penguin->room->internalId}%{$penguin->id}%$DJ1K%$DJ2K%$DJ3K%");
	}


			/*
			"ggd" => "handleMultiData", // %xt%z%ggd%109%1%
			"vn" => "handleTrackSave", // %xt%z%vn%109%fhdhfdhfhf%
			"djbis" => "handleDJExit", // %xt%z%djbis%109%0%0%0%
			*/
	
}

?>