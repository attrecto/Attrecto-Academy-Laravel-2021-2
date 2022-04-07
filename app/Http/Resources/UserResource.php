<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @OA\Schema(
     *      schema="UserResource",
     *      title="UserResource",
     *      type="object",
     *      @OA\Property(
     *            property="id",
     *            type="integer",
     *            description="id of user",
     *            example="1"
     *      ),
     *      @OA\Property(
     *            property="name",
     *            type="string",
     *            description="name of user",
     *            example="Elek"
     *      ),
     *      @OA\Property(
     *            property="role",
     *            type="string",
     *            description="role of user",
     *            example="admin"
     *      ),
     *    )
     *
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'courses' => CourseResource::collection($this->courses),
            "role" => "admin",
            //"role" => $this->getRoleNames()
        ];
    }
}
