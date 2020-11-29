<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockIp extends Model
{
    protected $fillable = ['ip', 'times'];
    protected $table = 'block_ips';
}
