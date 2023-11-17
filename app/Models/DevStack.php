<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DevStack extends Model
{
    use HasFactory;

    protected $table = "dev_stacks";

    protected $fillable = [
        'skill',
        'company',
        'location',
        'location2',
        'memo',
        'category',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    // 모델과 관련된 데이터베이스 쿼리 또는 비즈니스 로직을 정의할 수 있습니다.
    public function getAll_DevStack()
    {
        return $this->all();
    }

    public function getById_DevStack($id)
    {
        return $this->findOrFail($id);
    }

    public static function create_DevStack($data)
    {
        if (auth()->check()) {
            return auth()->user()->DevStack()->create($data);
        } else {
            // 로그인되어 있지 않은 경우의 처리
        }
    }

    public static function update_DevStack($id, $data)
    {
        if (auth()->check()) {
            // return auth()->user()->DevStack()->findOrFail($id)->update($data);
            return auth()->user()->DevStack()->update($data);
        } else {
            // 로그인되어 있지 않은 경우의 처리
        }
    }

    public static function delete_DevStack($id)
    {

        if (auth()->check()) {
            // return auth()->user()->DevStack()->findOrFail($id)->delete($id);
            return auth()->user()->DevStack()->delete($id);
        } else {
            // 로그인되어 있지 않은 경우의 처리
        }
    }
}
