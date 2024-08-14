<?php

require '../vendor/autoload.php';

use HotelRoomFinder\Providers\ApiV1Provider;
use HotelRoomFinder\Providers\ApiV2Provider;
use HotelRoomFinder\Providers\ApiV3Provider;
require '../src/HotelRoomFinder/HotelRoomFinder.php'; // Adjust path accordingly
require '../src/HotelRoomFinder\Providers\ApiV1Provider.php';
require '../src/HotelRoomFinder\Providers\ApiV2Provider.php';
require '../src/HotelRoomFinder\Providers\ApiV3Provider.php';
use HotelRoomFinder\HotelRoomFinder;
$hotelRoomFinder = new HotelRoomFinder([
    new ApiV1Provider(),
    new ApiV2Provider(),
    new ApiV3Provider()
]);

$hotelRooms = $hotelRoomFinder->getHotelRooms();

header('Content-Type: application/json');
echo json_encode($hotelRooms);