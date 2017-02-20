<?php
/**
 * @link https://github.com/kravcik/nette-macro-fontawesome
 */

namespace Kravcik\Macros;

class FontAwesomeMacro extends \Latte\Macros\MacroSet
{
    /**
     * Install macro
     * 
     */
    public static function install(\Latte\Compiler $compiler)
    {
        $set = new static($compiler);

        $set->addMacro('icon', [$set, 'icon']);

        return $set;
    }

    /**
     * Custom icon macro
     * 
     * @param \Latte\MacroNode $node
     * @param \Latte\PhpWriter $writer
     * 
     * @return string
     */
    public function icon(\Latte\MacroNode $node, \Latte\PhpWriter $writer)
    {
        return $writer->write(
            'echo \Kravcik\Macros\FontAwesomeMacro::renderIcon(%node.word, %node.array)'
        );
    }

    /**
     * Render font-awesome icon
     * @note Options can be set by like associate array or like simple array in right order
     * 
     * @param string $icon
     * @param array $arguments (see options)
     * 
     * @option string color (set color - e.g. red) - generate color-red
     * @option int size (set size - e.g. 2) - generate 2x
     * @option bool fixed-width (default TRUE)
     * 
     * @return \Nette\Utils\Html
     */
    public static function renderIcon($icon, array $arguments)
    {
        $isIndex = array_values($arguments) === $arguments;
        
        $el = \Nette\Utils\Html::el('span');
        $class = [];
        $class[] = 'fa fa-' . $icon;
        
        /**
         * Color argument
         */
        if(isset($arguments['color']) || ($isIndex && isset($arguments[0])))
        {
            $color = isset($arguments['color']) ? $arguments['color'] : $arguments[0];
            $class[] = 'color-' . $color;
        }
        
        /**
         * Size argument
         */
        if(isset($arguments['size']) || ($isIndex && isset($arguments[1])))
        {
            $size = isset($arguments['size']) ? $arguments['size'] : $arguments[1];
            $class[] =  'fa-' . $size . 'x';
        }
        
        /**
         * Fixed width argument
         */
        if((!isset($arguments['fw']) && !$isIndex ) || ($isIndex && !isset($arguments[2])))
        {
            $class[] = 'fa-fw';
        }
        
        $el->addAttributes(['class' => $class]);
        
        return $el;
    }
}