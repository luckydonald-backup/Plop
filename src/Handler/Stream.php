<?php
/*
    This file is part of Plop, a simple logging library for PHP.

    Copyright © 2010-2014 François Poirotte

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

namespace Plop\Handler;

/**
 *  \brief
 *      An handler that writes log messages
 *      to a PHP stream.
 *
 *  \see
 *      http://php.net/streams
 */
class Stream extends \Plop\HandlerAbstract
{
    /// The stream where log messages will be write to.
    protected $stream;

    /// A stream referencing \a STDERR.
    protected static $stderr = null;

    /**
     * Create a new instance of this handler.
     *
     * \param resource $stream
     *      (optional) The stream where log messages
     *      will be written. Defaults to \a STDERR.
     */
    public function __construct($stream = null)
    {
        if ($stream === null) {
            if (self::$stderr === null) {
                self::$stderr = fopen('php://stderr', 'w');
            }
            $stream = self::$stderr;
        }

        parent::__construct();
        $this->stream = $stream;
    }

    /**
     * Flush the stream's buffers.
     *
     * \return
     *      This method does not return any value.
     */
    protected function flush()
    {
        if (is_resource($this->stream)) {
            fflush($this->stream);
        }
    }

    /// \copydoc Plop::HandlerAbstract::emit().
    protected function emit(\Plop\RecordInterface $record)
    {
        $msg = $this->format($record);
        fprintf($this->stream, "%s\n", $msg);
        $this->flush();
    }
}
