<?php
/**
 * OCLC-Auth
 * Copyright 2013 OCLC
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * @package OCLC/Auth
 * @copyright Copyright (c) 2013 OCLC
 * @license http://www.opensource.org/licenses/Apache-2.0
 * @author Karen A. Coombs <coombsk@oclc.org>
*/

namespace OCLC\Auth;

use Guzzle\Http\Client;
use Guzzle\Plugin\History\HistoryPlugin;
use OCLC\Auth\WSKey;
use OCLC\User;
/**
 * A class that represents a client's OCLC Refresh Token.
 *
 * @author Karen A. Coombs <coombsk@oclc.org>
 *
 *         See the OCLC/Auth documentation for examples.
 *
 *
 */

class RefreshToken
{

	/**
	 * The refresh Token
	 * @var string
	 */
    private $refreshToken = null;
    
    /**
     * The number of milliseconds when the refresh tokens expires in
     * @var string
     */
    private $expiresIn = null;
    
    /**
     * The time in UTC when the refresh token expires
     * @var unknown
     */
    private $expiresAt = null;

    /**
     * Get Refresh Token
     *
     * @return string
     */
    public function getValue()
    {
        return $this->refreshToken;
    }

    /**
     * Get Refresh Token Expires In
     *
     * @return integer
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * Get Refresh Token Expires At
     *
     * @return string
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Return if the Refresh Token is Expired on Not
     *
     * @return boolean
     */
    public function isExpired()
    {
        date_default_timezone_set('UTC');
        if (strtotime($this->expiresAt) <= time()) {
            $status = TRUE;
        } else {
            $status = FALSE;
        }
        return $status;
    }

    /**
     * Construct a new Refresh Token
     * @param string $tokenValue
     * @param string $expiresIn
     * @param string $expiresAt
     */
    function __construct($tokenValue, $expiresIn, $expiresAt)
    {
        if (empty($tokenValue) || is_null($expiresIn) || empty($expiresAt)) {
            throw new LogicException('You must pass a refresh token value, expires in and expires at parameters to construct a refresh token');
        }
        
        $this->refreshToken = $tokenValue;
        $this->expiresIn = (int) $expiresIn;
        $this->expiresAt = $expiresAt;
    }
}
