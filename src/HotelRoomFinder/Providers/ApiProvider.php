<?php

namespace HotelRoomFinder\Providers;

interface ApiProvider
{
    public function getHotelRooms(): array;
}
