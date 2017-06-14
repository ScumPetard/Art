<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 首页信息
 * Class IndexPictures
 * @package App\Models
 */
class IndexPictures extends Model
{
    /**
     * @var string
     */
    protected $table = 'index_pictures';

    /**
     * @var array
     */
    protected $fillable = [
        'title','intro', 'cover'
    ];
}
