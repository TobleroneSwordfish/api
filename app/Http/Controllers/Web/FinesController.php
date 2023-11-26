<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Events\EventFine;
use App\Traits\IndexableQuery;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FinesController extends Controller
{
    use IndexableQuery;

    public function index(Request $request)
    {
        $fines = $this->indexQuery(
            EventFine::select('id', 'round_id', 'amount', 'issuer', 'issuer_job', 'target', 'reason')
                ->whereRelation('gameRound', 'ended_at', '!=', null)
                ->whereRelation('gameRound.server', 'invisible', false),
            perPage: 20
        );

        if ($this->wantsInertia()) {
            return Inertia::render('Events/Fines/Index', [
                'fines' => $fines,
            ]);
        }

        return $fines;
    }

    public function show(Request $request, int $fine)
    {
        $fine = EventFine::select(
            'id',
            'round_id',
            'amount',
            'issuer',
            'issuer_job',
            'target',
            'reason',
            'created_at'
        )
        ->where('id', $fine)
        ->whereRelation('gameRound', 'ended_at', '!=', null)
        ->whereRelation('gameRound.server', 'invisible', false)
        ->firstOrFail();

        return Inertia::render('Events/Fines/Show', [
            'fine' => $fine,
        ]);
    }
}
