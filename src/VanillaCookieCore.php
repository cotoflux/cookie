<?php namespace CodeZero\Cookie; 

class VanillaCookieCore implements CookieCore
{
    /**
     * Cookies
     *
     * @var array
     */
    private $cookies;

    /**
     * Create a new instance of VanillaCookieCore
     *
     * @param array $cookies
     */
    public function __construct(array &$cookies = null)
    {
        if ($cookies) {
            $this->cookies = & $cookies;
        } else {
            $this->cookies = & $_COOKIE;
        }
    }

    /**
     * Get the value of a cookie
     *
     * @param string $name
     *
     * @return null|string
     */
    public function get($name)
    {
        if ( ! isset($this->cookies[$name])) {
            return null;
        }

        return $this->cookies[$name];
    }

    /**
     * Set a cookie
     *
     * @param string $name
     * @param string $value
     * @param int $expire
     * @param string $path
     * @param string $domain
     * @param bool $secure
     * @param bool $httponly
     *
     * @return bool
     */
    public function set($name, $value, $expire, $path = null, $domain = null, $secure = null, $httponly = null)
    {
        return setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    }

    /**
     * Delete a cookie
     *
     * @param string $name
     *
     * @return bool
     */
    public function delete($name)
    {
        if (isset($this->cookies[$name])) {
            unset($this->cookies[$name]);

            return $this->set($name, null, -1);
        }

        return true;
    }
}
