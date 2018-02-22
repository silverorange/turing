<?php

namespace Silverorange\Turing\Url;

use League\Uri;
use League\Uri\Components\HierarchicalPath;
use League\Uri\Exception as UriException;
use League\Uri\Interfaces\Uri as UriInterface;

/**
 * @package   Turing
 * @copyright 2018 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class Normalizer
{
    // {{{ protected properties

    /**
     * @var League\Uri\Interfaces\Uri
     */
    protected $baseURL = null;

    // }}}
    // {{{ public function __construct()

    public function __construct(UriInterface $baseURL)
    {
        $this->baseURL = $baseURL;
    }

    // }}}
    // {{{ protected function getURL()

    public function getURL($url)
    {
        try {
            $url = Uri\create($url);
        } catch (UriException $e) {
            $path = new HierarchicalPath($url);
            $basePath = new HierarchicalPath($this->baseURL->getPath());
            $url = $this->baseURL->withPath((string)$basePath->append($path));
        }

        return $url;
    }

    // }}}
}
