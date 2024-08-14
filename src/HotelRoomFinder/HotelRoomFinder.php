<?php

namespace HotelRoomFinder;

use HotelRoomFinder\Providers\ApiProvider;
use HotelRoomFinder\Providers\ApiV1Provider;
use HotelRoomFinder\Providers\ApiV2Provider;
use HotelRoomFinder\Providers\ApiV3Provider;

// Composer autoload
require '../vendor/autoload.php';

class HotelRoomFinder
{
    private $apiProviders = [];

    public function __construct()
    {
        $this->apiProviders = [
            new ApiV1Provider(),
            new ApiV2Provider(),
            new ApiV3Provider(),
        ];
    }

    public function getHotelRooms(): array
    {
        $rooms = [];
        foreach ($this->apiProviders as $provider) {
            $rooms = array_merge($rooms, $provider->getHotelRooms());
        }

        // Filter out duplicate rooms based on room code
        $uniqueRooms = [];
       
        $result = array_filter($rooms, function($room) {
            return !empty($room['total']); // Keep rooms with non-empty total_price
        });
      
        foreach ($result as $room) {
            $roomCode = $room['code'];
            if (!isset($uniqueRooms[$roomCode]) || $room['total'] < $uniqueRooms[$roomCode]['total']) {
                $uniqueRooms[$roomCode] = $room;
            }
        }

        // Sort the rooms from cheapest to most expensive
        usort($uniqueRooms, function($a, $b) {
            return $a['total'] <=> $b['total'];
        });

        return $uniqueRooms;
    }
}