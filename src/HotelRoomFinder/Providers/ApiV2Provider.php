<?php

namespace HotelRoomFinder\Providers;


class ApiV2Provider implements ApiProvider
{
    public function getHotelRooms(): array
    {
        $apiUrl = 'https://coresolutions.app/php_task/api/api_v2.php';
        $json = file_get_contents($apiUrl);
        $data = json_decode($json, true);
       
        $rooms = [];
        foreach ($data as $hotel) {
            foreach ($hotel['rooms'] as $room) {
                $rooms[] = [
                    'name' => $hotel['name'],
                    'stars' => $hotel['stars'],
                    'code' => $room['code'],
                    'total' => $room['totalPrice']??"",
                ];
            }
        }

        return $rooms;
    }
}
