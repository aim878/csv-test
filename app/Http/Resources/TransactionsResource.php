<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionsResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'start_date' => $this['start_date'],
            'end_date' => $this['end_date'],
            'first_name' => $this['first_name'],
            'last_name' => $this['last_name'],
            'email' => $this['email'],
            'telnumber' => $this['telnumber'],
            'address1' => $this['address1'],
            'Address2' => $this['Address2'],
            'city' => $this['city'],
            'country' => $this['country'],
            'postcode' => $this['postcode'],
            'product_name' => $this['product_name'],
            'cost' => $this['cost'],
            'currency((usd,gbp))' => $this['currency((usd,gbp))'],
            'transaction_date' => $this['transaction_date'],
        ];
    }
}
