<?php

namespace App\Models\PurchaseOrder\Concerns;

use App\Models\PurchaseOrder\Audit;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(fn($m) => Audit::logModelEvent('created', $m));
        static::updated(fn($m) => Audit::logModelEvent('updated', $m));
        static::deleted(fn($m) => Audit::logModelEvent('deleted', $m));
        if (method_exists(static::class, 'restored')) {
            static::restored(fn($m) => Audit::logModelEvent('restored', $m));
        }
        if (method_exists(static::class, 'forceDeleted')) {
            static::forceDeleted(fn($m) => Audit::logModelEvent('forceDeleted', $m));
        }
    }

    public function auditSync(string $relation, array $ids, $detaching = true): array
    {
        $rel = $this->{$relation}();

        if (!method_exists($this, $relation)) {
            throw new \BadMethodCallException("Relation {$relation} does not exist.");
        }

        $before = $rel->pluck($rel->getRelatedKeyName())->toArray();
        $result = $rel->sync($ids, $detaching);
        $after = $rel->pluck($rel->getRelatedKeyName())->toArray();

        Audit::record('synced', $this, [
            'relation' => $relation,
            'before' => $before,
            'after' => $after,
            'changes' => $result,
        ]);

        return $result;
    }
}
