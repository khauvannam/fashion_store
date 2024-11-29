<?php

namespace App\ValueObject;

class AttributeValue
{
    private Attribute $attribute;

    private string $value;

    public function __construct(Attribute $attribute, string $value)
    {
        $this->attribute = $attribute;
        $this->value = $value;
    }

    public function attribute(): Attribute
    {
        return $this->attribute;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->attribute->name().': '.$this->value;
    }
}
