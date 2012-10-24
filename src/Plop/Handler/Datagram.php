<?php
/*
    This file is part of Plop, a simple logging library for PHP.

    Copyright © 2010-2012 François Poirotte

    Plop is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Plop is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Plop.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 *  \brief
 *      An handler that sends log messages
 *      to a remote host using UDP datagrams.
 */
class   Plop_Handler_Datagram
extends Plop_Handler_Socket
{
    /// \copydoc Plop_Handler_Socket::__construct($host, $port).
    public function __construct($host, $port)
    {
        parent::__construct($host, $port);
        $this->_closeOnError = 0;
    }

    /**
     * Create a new socket.
     *
     * \param int $timeout
     *      (optional) Unused. This parameter exists
     *      only for compatibility reasons with the
     *      base class (Plop_Handler_Socket).
     *
     * \retval resource
     *      The newly created socket.
     *
     * @codeCoverageIgnore
     */
    protected function _makeSocket($timeout=1)
    {
        return fsockopen('udp://'.$this->_host, $this->_port);
    }
}

