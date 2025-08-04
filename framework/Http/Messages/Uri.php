<?php

namespace Framework\Http\Messages;


use Exception;
use Psr\Http\Message\UriInterface;

/** @package Framework\Http\Messages */
class Uri implements UriInterface
{

    private string $userInfo = '';

    private string $scheme = '';

    private string $host = '';

    private ?int $port;

    private $path = '';

    private string $query = '';

    private string $fragment = '';

    public function __construct(string $uri = '')
    {
        if ($uri === '') {
            throw new Exception("Pass url while constructing an URI!");
        }

        $data = parse_url($uri);
        print_r($data);

        $this->scheme = isset($data["scheme"]) ? $data["scheme"] : '';
        $this->host = isset($data["host"]) ? $data["host"] : '';
        $this->port = isset($data["port"]) ? $data["port"] : null;
        $this->path = isset($data["path"]) ? $data["path"] : '';
        $this->query = isset($data["query"]) ? $data["query"] : '';
        $this->fragment = isset($data["fragment"]) ? $data["fragment"] : '';

        $userName = isset($data["user"]) ? $data["user"] : null;
        $pass = isset($data["pass"]) ? $data["pass"] : null;
        $this->userInfo = $userName . ':' . $pass;
    }
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /** @return string  */
    public function getAuthority(): string
    {
        $authority = $this->host;
        if ($this->userInfo !== '') {
            $authority = $this->userInfo . '@' . $authority;
        }

        if ($this->port !== null) {
            $authority .= ':' . $this->port;
        }

        return $authority;
    }

    /** @return string  */
    public function getUserInfo(): string
    {
        return $this->userInfo;
    }

    /** @return string  */
    public function getHost(): string
    {
        return $this->host;
    }

    /** @return null|int  */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /** @return string  */
    public function getPath(): string
    {
        return $this->path;
    }

    /** @return string  */
    public function getQuery(): string
    {

        return $this->query;
    }

    /** @return string  */
    public function getFragment(): string
    {
        return $this->fragment;
    }

    /**
     * @param string $scheme 
     * @return static 
     */
    public function withScheme(string $scheme): UriInterface
    {

        $new = clone $this;
        $new->scheme = $scheme;
        return $new;
    }

    /**
     * @param string $user 
     * @param null|string $password 
     * @return static 
     */
    public function withUserInfo(string $user, ?string $password = null): UriInterface
    {

        $new = clone $this;
        $new->userInfo = $user;
        if ($password !== null) {
            $new->userInfo = $new->userInfo . ':' . $password;
        }

        return $new;
    }

    /**
     * @param string $host 
     * @return static 
     */
    public function withHost(string $host): UriInterface
    {

        $new = clone $this;
        $new->host = $host;
        return $new;
    }

    /**
     * @param null|int $port 
     * @return static 
     */
    public function withPort(?int $port): UriInterface
    {

        $new = clone $this;
        $new->port = $port;
        return $new;
    }

    /**
     * @param string $path 
     * @return static 
     */
    public function withPath(string $path): UriInterface
    {
        $new = clone $this;
        $new->path = $path;
        return $new;
    }

    /**
     * @param string $query 
     * @return static 
     */
    public function withQuery(string $query): UriInterface
    {
        $new = clone $this;
        $new->query = $query;
        return $new;
    }

    /**
     * @param string $fragment 
     * @return static 
     */
    public function withFragment(string $fragment): UriInterface
    {

        $new = clone $this;
        $new->fragment = $fragment;
        return $new;
    }

    /** @return string  */
    public function __toString(): string
    {
        $uri = '';

        if ($this->scheme !== '') {
            $uri .= $this->scheme . ':';
        }

        $authority = $this->getAuthority();
        if ($authority !== '') {
            $uri .= '//' . $authority;
        }

        $uri .= $this->path;

        if ($this->query !== '') {
            $uri .= '?' . $this->query;
        }

        if ($this->fragment !== '') {
            $uri .= '#' . $this->fragment;
        }

        return $uri;
    }
}
