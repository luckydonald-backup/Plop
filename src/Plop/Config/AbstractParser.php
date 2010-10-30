<?php

abstract class Plop_Config_AbstractParser
{
    protected $logging;

    public function __construct(Plop &$logging, $fname)
    {
        $this->logging  =& $logging;
        $this->cp       =  $this->getConfigParserData($fname);
    }

    abstract protected function getConfigParserData($fname);

    protected function createHandlerInstance($cls, &$args)
    {
        if (!class_exists($cls) || !is_subclass_of($cls, 'Plop_Handler'))
            throw new Exception(sprintf('No such class (%s)', $cls));

        // call_user_func_array doesn't work with constructors.
        // We use the reflection API instead, which allows a ctor
        // to be called with a variable number of args.
        $reflector = new ReflectionClass($cls);
        return $reflector->newInstanceArgs($args);
    }

    public function doWork()
    {
        $formatters = $this->createFormatters();
        $handlers = $this->installHandlers($formatters);
        $this->installLoggers($handlers);
    }

    abstract protected function createFormatters();
    abstract protected function installHandlers($formatters);
    abstract protected function installLoggers($handlers);
}
