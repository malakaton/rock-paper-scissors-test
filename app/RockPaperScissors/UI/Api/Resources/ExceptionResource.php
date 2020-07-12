<?php

namespace App\RockPaperScissors\UI\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExceptionResource extends JsonResource
{
    protected $messages = '';
    protected $extra    = [];

    /**
     * Create a new resource instance.
     *
     * @param mixed $resource
     * @param array|null $messages
     * @param array $extra
     */
    public function __construct($resource, array $messages = null, Array $extra = [])
    {
        $this->messages = $messages;
        $this->extra    = $extra;

        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $response = [
            'data' => [ ],
            'meta' => [
                'success' => false,
                'errors' => $this->messages ?: ['An error has occurred that has not been determined' ],
            ],
        ];

        // if extra is empty no worries, nothing to merge
        return array_merge_recursive($this->extra, $response);
    }
}
