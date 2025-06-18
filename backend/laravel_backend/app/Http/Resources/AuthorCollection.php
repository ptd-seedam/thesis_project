<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthorCollection extends ResourceCollection
{
    public function toArray(Request $request)
    {
        return [
            'data' => AuthorResource::collection($this->collection),
            'meta' => [
                'total' => $this->collection->count(),
                'links' => [
                    'self' => url()->current(),
                ],
            ],
            'type' => 'authors',
        ];
    }

}
