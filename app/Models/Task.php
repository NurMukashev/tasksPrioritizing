<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Task",
 *     type="object",
 *     title="Task",
 *     required={"id", "title", "status", "importance", "deadline"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Срочная задача"),
 *     @OA\Property(property="description", type="string", example="Описание задачи"),
 *     @OA\Property(property="status", type="string", example="TODO"),
 *     @OA\Property(property="importance", type="integer", example=5),
 *     @OA\Property(property="deadline", type="string", format="date-time", example="2025-04-13 22:32:24"),
 *     @OA\Property(property="is_overdue", type="boolean", example=false),
 *     @OA\Property(property="priority_score", type="number", example=0.85),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */


class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'importance',
        'deadline'
    ];
}
