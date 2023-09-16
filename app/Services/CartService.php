<?php

namespace App\Services;

use Illuminate\Session\SessionManager;

class CartService
{
    private const SESSION_KEY = 'cart';
    public function __construct(private SessionManager $session)
    {
        if(!$this->session->has(self::SESSION_KEY)) $this->session->put(self::SESSION_KEY, []);
    }

    public function all()
    {
        return array_unique($this->session->get(self::SESSION_KEY));
    }

    public function count()
    {
        return count($this->all());
    }

    public function add($item)
    {
        if($this->session->has(self::SESSION_KEY)) {
            $this->session->push(self::SESSION_KEY, $item);
        } else {
            $this->session->put(self::SESSION_KEY, [$item]);
        }
    }

    public function remove($item)
    {
        $cart = $this->all();

        $this->session->put(self::SESSION_KEY, array_filter($cart, function($line) use($item) {
            return $line !== $item;
        }));
    }

    public function clear()
    {
        $this->session->put(self::SESSION_KEY, []);
    }
}
