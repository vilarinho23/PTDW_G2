<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeyValue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'key_value';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'key';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];


    /**
     * Set the value of a key.
     *
     * @param string $key The key to set.
     * @param string|null $value The value to set. If null, the key will be deleted.
     */
    public static function set(string $key, string|null $value)
    {
        if ($value === null)
        {
            self::del($key);
            return;
        }

        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Get the value of a key.
     *
     * @param string $key The key to get.
     * @return string|null The value of the key or null if the key does not exist.
     */
    public static function val(string $key)
    {
        $kv = self::find($key);
        return $kv->value ?? null;
    }

    /**
     * Copy a key to another key.
     *
     * @param string $key The key to copy.
     * @param string $newKey The new key.
     */
    public static function copy(string $key, string $newKey)
    {
        $value = self::val($key);
        self::set($newKey, $value);
    }


    /**
     * Delete a key.
     *
     * @param string $key The key to delete.
     */
    public static function del(string $key)
    {
        self::destroy($key);
    }

    /**
     * Delete all keys.
     */
    public static function flush()
    {
        self::truncate();
    }


    /**
     * Get all keys.
     *
     * @return \Illuminate\Support\Collection A collection of all keys.
     */
    public static function keys()
    {
        return self::all()->pluck('key');
    }

    /**
     * Check if keys exist.
     *
     * @param string ...$keys The keys to check.
     * @return int The number of keys that exist.
     */
    public static function exists(string ...$keys)
    {
        $n = 0;

        foreach ($keys as $key)
        {
            $value = self::val($key);
            if ($value !== null) $n++;
        }

        return $n;
    }

    /**
     * Get count of all keys.
     */
    public static function size()
    {
        return self::count();
    }
}
