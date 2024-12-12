<?php

namespace App\Models;

use App\ValueObject\Attribute;
use App\ValueObject\AttributeValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'image_override', 'price_override', 'quantity', 'attribute_values'];


    protected $casts = [
        'attribute_values' => 'array'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Set the attribute values as Value Objects.
     *
     * @param AttributeValue[] $attributeValues
     */

    public function setAttributeValues(array $attributeValues): void
    {
        $this->attributes['attribute_values'] = json_encode(
            array_map(fn(AttributeValue $value) => [
                'attribute' => $value->attribute()->name(),
                'value' => $value->value(),
            ], $attributeValues)
        );
    }

    public function getAttributeValues(?string $attributeName = null): array|AttributeValue|null
    {
        $attributeValues = array_map(
            fn($value) => new AttributeValue(
                new Attribute($value['attribute']),
                $value['value']
            ),
            $this->attribute_values ?? []
        );

        if (is_null($attributeName)) {
            return $attributeValues;
        }

        $filtered = array_filter($attributeValues, fn($attributeValue) => $attributeValue->attribute()->name() === $attributeName);

        return reset($filtered) ?: null;
    }

}
