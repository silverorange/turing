<?php

namespace Silverorange\Turing\Database;

/**
 * @package   Turing
 * @copyright 2018 silverorange
 */
trait DatabaseTrait
{
    // {{{ protected properties

    /**
     * @var PDO
     */
    protected $db;

    // }}}
    // {{{ public function setUpDatabase()

    /**
     * @before
     */
    public function setUpDatabase()
    {
        $dsn = getenv('DATABASE_DSN');
        if ($dsn !== false) {
            $this->db = new \PDO($dsn);
            $this->db->setAttribute(
                \PDO::ATTR_ERRMODE,
                \PDO::ERRMODE_EXCEPTION
            );
        }
    }

    // }}}
}
