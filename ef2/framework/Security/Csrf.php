<?php


/**
 *
 * @author Eight
 * @copyright 2017 EightFramework 2
 */

namespace EF2\Security;

use EF2\Http\HttpException;
use EF2\Ef;
use EF2\Security\Csrf\Bridge;
use EF2\Security\Csrf\CsrfInterface;

/**
 * A simple CSRF class to protect forms against CSRF attacks. The class uses
 * PHP sessions for storage.
 *
 *
 */
class Csrf implements CsrfInterface
{
    /**
     * The namespace for the session variable and form inputs
     * @var string
     */
    private $namespace;

    private $bridge;

    const Session=1, Redis=2;

    /**
     * Initializes the session variable name, starts the session if not already so,
     * and initializes the token
     *
     * @param string $namespace
     */
    public function __construct($connector,$redis=null,$duration=60*24*30)
    {
        $this->bridge=new Bridge;
        $this->bridge->setAdaptor($connector,$redis);
        $this->bridge->setDuration($duration);
    }

    public function bind($namespace = '_csrf')
    {
        $this->namespace = $namespace;
        $this->setToken();
    }


    /**
     * Return the token from persistent storage
     *
     * @return string
     */
    public function getToken()
    {
        return $this->readTokenFromStorage();
    }

    public function getName()
    {
        return $this->namespace;
    }

    /**
     * Verify if supplied token matches the stored token
     *
     * @param string $userToken
     * @return boolean
     */
    public function isTokenValid($token)
    {
        return ($token === $this->readTokenFromStorage());
    }

    /**
     * Echoes the HTML input field with the token, and namespace as the
     * name of the field
     */
    public function echoInputField()
    {
        $token = $this->getToken();
        echo "<input type=\"hidden\" name=\"{$this->namespace}\" value=\"{$token}\" />";
    }

    /**
     * Verifies whether the post token was set, else dies with error
     */
    public function verifyRequest($token="")
    {
        if (!$this->isTokenValid($token))
        {
            throw new HttpException(419,"CSRF validation failed.");
        }
    }

    /**
     * Generates a new token value and stores it in persisent storage, or else
     * does nothing if one already exists in persisent storage
     */
    private function setToken()
    {
        $token = md5(uniqid(rand(), TRUE));
        $storedToken = $this->readTokenFromStorage();

        if ($storedToken ==false )
        {
            $token = md5(uniqid(rand(), TRUE));
            $this->writeTokenToStorage($token);
        }


    }

    /**
     * Reads token from persistent sotrage
     * @return string
     */
    private function readTokenFromStorage()
    {

        if (!empty($this->bridge->get($this->namespace)))
        {

            return $this->bridge->get($this->namespace);

        }


        return false;
    }

    /**
     * Writes token to persistent storage
     */
    private function writeTokenToStorage($token)
    {
        $this->bridge->set($this->namespace,$token);
    }

    public function postControl()
    {
        if(EF::app()->isPost() && !isset($_POST[$this->namespace]) || $this->readTokenFromStorage()==false || (isset($_POST[$this->namespace]) && $_POST[$this->namespace]!=$this->readTokenFromStorage()) )
        {
            throw new HttpException(419,"CSRF validation failed.");
        }
    }

    public function getControl()
    {
        if(EF::app()->isGet() && !isset($_GET[$this->namespace]) || $this->readTokenFromStorage()==false || (isset($_GET[$this->namespace]) && $_GET[$this->namespace]!=$this->readTokenFromStorage()) )
        {
            throw new HttpException(419,"CSRF validation failed.");
        }
    }
}