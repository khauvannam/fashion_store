<?php

namespace App\ValueObject\OrderInformation;

class Information
{
    public string $name;
    public string $email;
    public string $phoneNumber;
    public string $address;
    public string $city;
    public string $province;
    public string $postalCode;
    public string $note;

    public function __construct(
        string $name,
        string $email,
        string $phoneNumber,
        string $address,
        string $city,
        string $province,
        string $postalCode,
        string $note
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->city = $city;
        $this->province = $province;
        $this->postalCode = $postalCode;
        $this->note = $note;
    }

    // Convert object to array for JSON storage
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber,
            'address' => $this->address,
            'city' => $this->city,
            'province' => $this->province,
            'postalCode' => $this->postalCode,
            'note' => $this->note,
        ];
    }

    // Factory method to instantiate from an array
    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'] ?? '',
            $data['email'] ?? '',
            $data['phoneNumber'] ?? '',
            $data['address'] ?? '',
            $data['city'] ?? '',
            $data['province'] ?? '',
            $data['postalCode'] ?? '',
            $data['note'] ?? ''
        );
    }
}

