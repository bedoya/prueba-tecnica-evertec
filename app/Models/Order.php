<?php

namespace App\Models;

use Carbon\Carbon;
use Dnetix\Redirection\Exceptions\PlacetoPayException;
use Dnetix\Redirection\Message\RedirectResponse;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $reference
 * @property int $client_id
 * @property int $status_id
 * @property mixed $data
 * @property float $total
 *
 * @property Status $status
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'status_id',
        'data',
        'total',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Creates the relationship between the order and the client who
     * generated it.
     *
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Creates the relationship between the order and the status it has
     *
     * @return BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Creates the relationship between the order and the products that were added
     * to the order.
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    // Setters

    /**
     * @param $product
     * @param int $quantity
     *
     * @return void
     */
    public function addProduct($product, int $quantity = 1): void
    {
        $product =
            is_int($product) ? Product::find($product) :
                (is_string($product) ?
                    Product::whereSlug(Str::slug($product))->first() :
                    $product
                );

        $this->products()->attach($product->id, ['quantity' => $quantity]);
        $this->total += $product->getPrice() * $quantity;
        $this->save();
    }

    /**
     * Sets the reference of the order
     *
     * @return void
     */
    public function setReference(): void
    {
        $this->reference = Carbon::now()->timestamp;
        $this->save();
    }

    /**
     * @param string $key
     * @param array|string $value
     *
     * @return void
     */
    public function setData(string $key, array|string $value = ''): void
    {
        $data = $this->data;
        data_set($data, $key, $value);
        $this->data = $data;
        $this->save();
    }

    /**
     * Sets the status of the order to the given status
     *
     * @param string $status
     *
     * @return void
     */
    public function setStatus(string $status): void
    {
        $status = Status::whereSlug(Str::slug($status))->first();
        $this->status_id = $status->id;
        $this->save();
    }

    /**
     * @throws PlacetoPayException
     */
    public function prepareCheckout()
    {
        $placetopay = new PlacetoPay([
            'login' => config('site.login'), // Provided by PlacetoPay
            'tranKey' => config('site.key'), // Provided by PlacetoPay
            'baseUrl' => config('site.checkout_url'),
            'timeout' => 10, // (optional) 15 by default
        ]);

        $request = [
            'payment' => [
                'reference' => $this->getReference(),
                'description' => 'Testing payment',
                'amount' => [
                    'currency' => 'COP',
                    'total' => $this->getTotal(),
                ],
                'allowPartial' => false,
            ],
            'expiration' => Carbon::now()->addDays(2)->toIso8601String(),
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
            'locale' => 'es_CO',
            'returnUrl' => route('orders.show', ['order' => $this->id]),
        ];

        $response = $placetopay->request($request);
        $data = ($response->isSuccessful()) ?
            [
                'request_id' => $response->requestId(),
                'process_url' => $response->processUrl(),
            ] :
            [
                'message' => $response->status()->message(),
            ];
        $this->setData('transaction', $data);
    }

    // Getters

    /**
     * Returns the total price to pay for the order
     *
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * Returns the requested key in the data field for the product
     *
     * @param string $key
     * @param $default
     *
     * @return string|array|mixed
     */
    public function getData(string $key, $default = null): mixed
    {
        return data_get($this->data, $key, $default);
    }

    /**
     * Returns the URL where the user should be redirected to complete the transaction
     *
     * @return string
     */
    public function getProcessUrl(): string
    {
        return $this->getData('transaction.process_url') != null ?
            $this->getData('transaction.process_url') :
            route('orders.edit', [$this->id]);
    }

    // Checkers

    /**
     * Determines if an order can be sent to checkout
     *
     * @return bool
     */
    public function canBeProcessed(): bool
    {
        return ($this->getData('transaction.process_url') != null) && ($this->hasStatus('Created'));
    }

    /**
     * Determines if the status of the order has the given status
     *
     * @param string $status
     *
     * @return bool
     */
    public function hasStatus(string $status = 'Created'): bool
    {
        $status = Status::whereSlug(Str::slug($status))->first();
        return $this->status->id == $status->id;
    }
}
