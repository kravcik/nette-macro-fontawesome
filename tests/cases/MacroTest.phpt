<?php

require_once __DIR__ . '/../boostrap.php';

use Tester\Assert;

\Tester\Environment::setup();

class MacroTest extends \Tester\TestCase
{
    protected function render($file)
    {
        $latte = new Latte\Engine();
        $latte->setTempDirectory(__DIR__ . '/../temp');
        $latte->onCompile[] = function(\Latte\Engine $engine)
        {
            \Kravcik\Macros\FontAwesomeMacro::install($engine->getCompiler());
        };

        $result = $latte->renderToString(__DIR__ . '/' . $file);

        return trim($result);
    }

    /**
     * Short variant {icon star}
     */
    public function testShort()
    {
        Assert::same('<span class="fal fa-star fa-fw"></span>', $this->render('short.latte'));
    }

    /**
     * Color variant {icon star, yellow-light}
     */
    public function testColor()
    {
        Assert::same('<span class="fal fa-star color-yellow-light fa-fw"></span>', $this->render('color.latte'));
    }

    /**
     * Size variant {icon star, NULL, 2}
     */
    public function testSize()
    {
        Assert::same('<span class="fal fa-star fa-2x fa-fw"></span>', $this->render('size.latte'));
        Assert::same('<span class="fal fa-star fa-lg fa-fw"></span>', $this->render('size-lg.latte'));
    }

    /**
     * Fixed width disable variant {icon star, NULL, NULL, TRUE}
     */
    public function testFixed()
    {
        Assert::same('<span class="fal fa-star"></span>', $this->render('fixed.latte'));
    }

    /**
     * Full variant {icon star, yellow-light, 5, TRUE}
     */
    public function testFull()
    {
        Assert::same('<span class="fal fa-star color-yellow-light fa-5x"></span>', $this->render('full.latte'));
    }

    /**
     * Keys with wrong order and one missing variant {icon star, size => 5, color => 'red-light'}
     */
    public function testKeys()
    {
        Assert::same('<span class="fal fa-star color-red-light fa-5x fa-fw"></span>', $this->render('keys.latte'));
    }

    /**
     * Style variant {icon star, NULL, NULL, NULL, far}
     */
    public function testStyle()
    {
        Assert::same('<span class="far fa-star fa-fw"></span>', $this->render('style.latte'));
    }

}

$macroTest = new MacroTest;
$macroTest->run();
