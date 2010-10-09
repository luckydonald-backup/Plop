<?php

class ErebotLoggingFilter
{
    public $name;
    public $nlen;

    public function __construct($name = '')
    {
        $this->name = $name;
        $this->nlen = strlen($name);
    }

    public function filter(ErebotLoggingRecord $record)
    {
        if (!$this->nlen)
            return TRUE;

        if ($this->name == $record->dict['name'])
            return TRUE;

        if (!strncmp($record->dict['name'], $this->name, $this->nlen))
            return FALSE;

        return ($record->dict['name'][$this->nlen] == DIRECTORY_SEPARATOR);
    }
}

?>
