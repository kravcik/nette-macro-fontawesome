This repo is discontinued - for Latte3 and PHP8.1 you should look here: https://github.com/kravcik/latte-font-awesome-icon

Simple macro for generating Font Awesome icons. First parameter is required. Parameters can be set in order or randomly with string keys (macro detects if it's getting an associative array).


## Version 2.0.0

It's compatible with FontAwesome 5, but default style is set to `light`. Best option would be to create multiple macros or a static variable to set default style. Send me a PR or create an issue if you need this.

Thanks to [@peldax](https://github.com/peldax) it's also possible to change the html element. Default is span.


## Register to config.neon

```
latte:
    macros:
        - Kravcik\Macros\FontAwesomeMacro::install
```


## Parameters

1. `icon` - icon name without `fa-`
2. `color` - color (blue, red-dark, etc.)
3. `size` - number (generates `fa-{size}x`) or sm, lg, etc.
4. `fw` - if TRUE, disable `fa-fw`
5. `style` - `fas` / `far` / `fal` / `fab`


## Examples

`{icon star, 'el' => 'i'}` -> `<i class="fal fa-star fa-fw"></i>`

`{icon star}` -> `<span class="fal fa-star fa-fw"></span>`

`{icon star, red}` -> `<span class="fal fa-star color-red fa-fw"></span>`

`{icon star, NULL, lg}` -> `<span class="fal fa-star fa-lg fa-fw"></span>`

`{icon star, yellow, 2}` -> `<span class="fal fa-star color-yellow fa-2x fa-fw"></span>`

`{icon star, blue, 2, TRUE, far}` -> `<span class="far fa-star color-blue fa-2x"></span>`

 `{icon star, size => 2, fw => TRUE, color => 'green-light', style => 'fas'}` -> `<span class="fas fa-star color-green-light fa-2x"></span>`


# Versions

Package |   PHP   |  Nette  | Font Awesome | Bootstrap |
:------:|:-------:|:-------:|:------------:|:---------:|
   v4   | \>=8.0  | \>=3.0  |      5       |     4     |
   v3   | \>=7.3  | \>=3.0  |      5       |     4     |
   v2   | \>=7.1  | \>=2.4  |      5       |     3     |
   v1   | \>=5.6  | \>=2.4  |      4       |     3     |
