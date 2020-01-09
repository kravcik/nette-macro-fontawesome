<?php
declare(strict_types=1);

/**
 * @link https://github.com/kravcik/nette-macro-fontawesome
 */

namespace Kravcik\Macros;

class FontAwesomeMacro extends \Latte\Macros\MacroSet
{
	/**
	 * BS4 colors
	 */
	private static $colorClass = [
		'primary',
		'secondary',
		'success',
		'danger',
		'warning',
		'info',
		'light',
		'dark',
		'body',
		'muted',
		'white',
		'black-50',
		'white-50'
	];


	/**
	 * Install macro
	 */
	public static function install(\Latte\Compiler $compiler)
	{
		$set = new static($compiler);

		$set->addMacro('icon', [$set, 'icon']);

		return $set;
	}


	/**
	 * Custom icon macro          
	 */
	public function icon(\Latte\MacroNode $node, \Latte\PhpWriter $writer): string
	{
		return $writer->write(
			'echo \Kravcik\Macros\FontAwesomeMacro::renderIcon(%node.word, %node.array)'
		);
	}


	/**
	 * Render font-awesome icon
	 * @note Options can be set by like associate array or like simple array in right order
	 *     
	 *
	 * @option string color (set color - e.g. red) - generate color-red || ignore (bootstrap class like success
	 * @option int size (set size - e.g. 2) - generate 2x
	 * @option bool fixed-width (default true)
	 */
	public static function renderIcon(string $icon, array $arguments): \Nette\Utils\Html
	{
		$isIndex = array_values($arguments) === $arguments;

		$el = \Nette\Utils\Html::el($arguments['el'] ?? 'span');
		$class = [];

		/**
		 * Color argument
		 */
		if(isset($arguments['color']) || ($isIndex && isset($arguments[0])))
		{
			$color = $arguments['color'] ?? $arguments[0];

			$class[] = in_array($color, self::$colorClass, true) ? 'text-' . $color : 'color-' . $color;
		}

		/**
		 * Size argument
		 */
		if(isset($arguments['size']) || ($isIndex && isset($arguments[1])))
		{
			$size = $arguments['size'] ?? $arguments[1];

			if(is_numeric($size))
			{
				$class[] = 'fa-' . $size . 'x';
			}
			else
			{
				$class[] = 'fa-' . $size;
			}
		}

		/**
		 * Fixed width argument
		 */
		if((!isset($arguments['fw']) && !$isIndex) || ($isIndex && !isset($arguments[2])))
		{
			$class[] = 'fa-fw';
		}

		if(isset($arguments['style']) || ($isIndex && isset($arguments[3])))
		{
			$style = $arguments['style'] ?? $arguments[3];
		}
		else
		{
			$style = 'fal';
		}

		array_unshift($class, $style . ' fa-' . $icon);

		$el->addAttributes(['class' => $class]);

		return $el;
	}
}
