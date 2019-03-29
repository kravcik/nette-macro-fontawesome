<?php
/**
 * @link https://github.com/kravcik/nette-macro-fontawesome
 */

namespace Kravcik\Macros;

class FontAwesomeMacro extends \Latte\Macros\MacroSet
{
    private static $colorClass = [
        'success',
        'info',
        'danger',
        'warning',
        'default',
        'primary',
        'secondary'
    ];

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
     * @option string color (set color - e.g. red) - generate color-red || ignore (bootstrap class like success
     * @option int size (set size - e.g. 2) - generate 2x
     * @option bool fixed-width (default TRUE)
     *
     * @return \Nette\Utils\Html
     */
    public static function renderIcon($icon, array $arguments)
    {
        $isIndex = array_values($arguments) === $arguments;

        $el = \Nette\Utils\Html::el(isset($arguments['el']) ? $arguments['el'] : 'span');
        $class = [];
        $class[] = 'fal fa-' . $icon;

        /**
         * Color argument
         */
        if(isset($arguments['color']) || ($isIndex && isset($arguments[0])))
        {
            $color = isset($arguments['color']) ? $arguments['color'] : $arguments[0];

            $class[] = in_array($color, self::$colorClass) ? 'text-' . $color : 'color-' . $color;
        }

        /**
         * Size argument
         */
        if(isset($arguments['size']) || ($isIndex && isset($arguments[1])))
        {
            $size = isset($arguments['size']) ? $arguments['size'] : $arguments[1];
            if(is_numeric($size))
            {
                $class[] =  'fa-' . $size . 'x';
            }
            else
            {
                $class[] =  'fa-' . $size;
            }
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
