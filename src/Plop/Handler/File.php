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
 *      An handler that writes log messages
 *      to a file.
 */
class   Plop_Handler_File
extends Plop_Handler_Stream
{
    /// Path to the log file this handler writes to.
    protected $_baseFilename;

    /// Opening mode for the log file.
    protected $_mode;

    /**
     * Construct a new instance of this handler.
     *
     * \param string $filename
     *      Name of the log file to write to.
     *
     * \param string $mode
     *      (optional) Mode to use when opening
     *      the file. Defauts to "at" (append).
     *
     * \param bool $delay
     *      (optional) Whether to delay the actual
     *      opening of the file until the first write.
     *      Defaults to \a FALSE (no delay).
     */
    public function __construct(
        $filename,
        $mode       = 'at',
        $delay      = FALSE
    )
    {
        $this->_baseFilename    = $filename;
        $this->_mode            = $mode;
        if ($delay) {
            parent::__construct(FALSE);
        }
        else {
            $stream = $this->_open();
            parent::__construct($stream);
        }
    }

    /// Free the resources used by this handler.
    public function __destruct()
    {
        $this->_close();
    }

    /**
     * Open the log file.
     *
     * \retval resource
     *      A stream representing the newly
     *      opened log file.
     */
    protected function _open()
    {
        return fopen($this->_baseFilename, $this->_mode);
    }

    /// \copydoc Plop_HandlerAbstract::_emit().
    protected function _emit(Plop_RecordInterface $record)
    {
        if (!$this->_stream) {
            $this->_stream = $this->_open();
        }
        parent::_emit($record);
    }

    /**
     * Close the log file.
     *
     * \return
     *      This method does not return any value.
     */
    protected function _close()
    {
        if ($this->_stream) {
            $this->_flush();
            fclose($this->_stream);
            $this->_stream = FALSE;
        }
    }
}

