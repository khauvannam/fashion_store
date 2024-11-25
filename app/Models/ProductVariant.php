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

    protected $fillable = ['product_id', 'price_override', 'quantity', 'attribute_values'];
    protected $casts = [
        'attribute_values' => 'array', // Cast to array when storing JSON
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Set the attribute values as Value Objects.
     *
     * @param AttributeValue[] $attributeValues
     * @return void
     */
    public function setAttributeValues(array $attributeValues): void
    {
        $this->attribute_values = array_map(
            fn(AttributeValue $value) => [
                'attribute' => $value->attribute()->name(),
                'value' => $value->value()
            ],
            $attributeValues
        );
    }

    /**
     * Get the attribute values as Value Objects.
     *
     * @return AttributeValue[]
     */
    public function getAttributeValues(): array
    {
        return array_map(
            fn($value) => new AttributeValue(
                new Attribute($value['attribute']),
                $value['value']
            ),
            $this->attribute_values
        );
    }
}

