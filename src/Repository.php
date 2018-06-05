<?php

namespace Lari\SimpleRepo;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class Repository
{
    protected $model;

    /**
     * @param bool $force
     */
    public function truncate($force = false)
    {
        DB::transaction(function () use ($force) {
            if ($force && config('database.default') !== 'sqlite') {
                \DB::statement('SET FOREIGN_KEY_CHECKS=0');
            }

            $this->model->truncate();

            if ($force && config('database.default') !== 'sqlite') {
                \DB::statement('SET FOREIGN_KEY_CHECKS=1');
            }
        });
    }
}