<?php

namespace App\Traits;

trait CrossingPeriodFeature
{
    public function scopeCrossingPeriod($query, $start, $end = null)
    {
        $query->where(
            fn ($query) => $query
                ->when(
                    $start,
                    fn ($query) => $query->where(
                        fn ($query) => $query
                            ->where('start', '<=', $start)
                            ->where('end', '>', $start)
                    )
                )
                ->when(
                    $end && $start,
                    fn ($query) => $query->orWhere(
                        fn ($query) => $query
                            ->where('start', '>=', $start)
                            ->where('end', '<=', $end)
                    )
                )
        );
    }
}

