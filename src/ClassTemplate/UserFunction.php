<?php
namespace ClassTemplate;
use ClassTemplate\Block;

class UserFunction extends Statement
{
    public $name;
    public $arguments = array();

    public $body;
    public $bodyArguments = array();

    public $block;

    /**
     * Class Method Constructor
     *
     * @param string $name the function name.
     * @param array $arguments the argument of the function prototype.
     * @param string $body the code of the function.
     * @param array $bodyArguments the template arguments of the code of the function.
     */
    public function __construct($name, $arguments = array(), $body = '', $bodyArguments = array() )
    {
        $this->name = $name;
        $this->arguments = $arguments;

        $this->block = new Block;
        if ($body) {
            $this->block->setBody($body);
        }

        $this->body = $body;

        $this->bodyArguments = $bodyArguments;
    }

    public function setBody($body, $args = array()) {
    }

    public function setArguments($args) 
    {
        $this->arguments = $args;
    }

    protected function renderArguments() 
    {
        return join(', ', $this->arguments);
    }

    protected function renderBody($indent = 0) 
    {
        // XXX: we don't indent the body for now, just keep what it is.
        return "{\n" . Utils::renderStringTemplate($this->body, $this->bodyArguments) . "\n}\n";

        $body = '';
        $lines = explode("\n", Utils::renderStringTemplate($this->body, $this->bodyArguments) );
        foreach( $lines as $line ) {
            $body .= Utils::indent( $indent + 1 ) . $line . "\n";
        }
        return "{\n" . $body . Utils::indent($indent)  . "}\n";
    }

    public function render() {
        return 'function ' . $this->name . '(' . $this->renderArguments() . ') ' . $this->renderBody();
    }


}





