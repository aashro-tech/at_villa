<?php

namespace Aashro\AtVilla\Domain\Model;

class News extends \GeorgRinger\News\Domain\Model\News
{
    protected string $txVillaPrice = '';
    protected string $txVillaAddress = '';
    protected int $txVillaBedrooms = 0;
    protected int $txVillaBathrooms = 0;
    protected string $txVillaArea = '';
    protected int $txVillaFloor = 0;
    protected int $txVillaParking = 0;

    // Price
    public function getTxVillaPrice(): string
    {
        return $this->txVillaPrice;
    }

    public function setTxVillaPrice(string $value)
    {
        $this->txVillaPrice = $value;
    }

    // Address
    public function getTxVillaAddress(): string
    {
        return $this->txVillaAddress;
    }

    public function setTxVillaAddress(string $value)
    {
        $this->txVillaAddress = $value;
    }

    // Bedrooms
    public function getTxVillaBedrooms(): int
    {
        return $this->txVillaBedrooms;
    }

    public function setTxVillaBedrooms(int $value)
    {
        $this->txVillaBedrooms = $value;
    }

    // Bathrooms
    public function getTxVillaBathrooms(): int
    {
        return $this->txVillaBathrooms;
    }

    public function setTxVillaBathrooms(int $value)
    {
        $this->txVillaBathrooms = $value;
    }

    // Area
    public function getTxVillaArea(): string
    {
        return $this->txVillaArea;
    }

    public function setTxVillaArea(string $value)
    {
        $this->txVillaArea = $value;
    }

    // Floor
    public function getTxVillaFloor(): int
    {
        return $this->txVillaFloor;
    }

    public function setTxVillaFloor(int $value)
    {
        $this->txVillaFloor = $value;
    }

    // Parking
    public function getTxVillaParking(): int
    {
        return $this->txVillaParking;
    }

    public function setTxVillaParking(int $value)
    {
        $this->txVillaParking = $value;
    }
}