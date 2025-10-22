<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'event',
        'auditable_id',
        'auditable_type',
        'user_id',
        'old_values',
        'new_values',
        'ip',
        'user_agent'
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public static function record(string $event, $model = null, array $payload = []): self
    {
        [$old, $new] = [$payload['old_values'] ?? null, $payload['new_values'] ?? null];

        return self::create([
            'event' => $event,
            'auditable_id' => $model?->getKey(),
            'auditable_type' => $model ? get_class($model) : null,
            'user_id' => auth()->id(),
            'old_values' => $old,
            'new_values' => $new,
            'ip' => request()?->ip(),
            'user_agent' => request()?->userAgent(),
        ]);
    }

    public static function logModelEvent(string $event, $model): ?self
    {
        [$old, $new] = match ($event) {
            'created' => [null, self::mask($model->getAttributes())],
            'updated' => [self::mask(self::originalFor($model)), self::mask($model->getDirty())],
            'deleted' => [self::mask($model->getAttributes()), null],
            'restored' => [null, self::mask($model->getAttributes())],
            'forceDeleted' => [self::mask($model->getAttributes()), null],
            default => [null, null],
        };

        if ($event === 'updated' && empty($new)) return null;

        return self::create([
            'event' => $event,
            'auditable_id' => $model->getKey(),
            'auditable_type' => get_class($model),
            'user_id' => auth()->id(),
            'old_values' => $old,
            'new_values' => $new,
            'ip' => request()?->ip(),
            'user_agent' => request()?->userAgent(),
        ]);
    }

    protected static function originalFor($model): array
    {
        $orig = [];
        foreach ($model->getDirty() as $k => $v) {
            $orig[$k] = $model->getOriginal($k);
        }
        return $orig;
    }

    protected static function mask(?array $data): ?array
    {
        if (!$data) return $data;
        $ignore = config('audit.ignore_attributes', ['updated_at', 'remember_token']);
        $mask = config('audit.mask_attributes', ['password', 'secret', 'token']);
        $out = [];
        foreach ($data as $k => $v) {
            if (in_array($k, $ignore, true)) continue;
            if (in_array($k, $mask, true)) {
                $out[$k] = '***';
                continue;
            }
            $out[$k] = $v;
        }
        return $out;
    }

    public function auditable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
