Simple macro for generate Font Awesome icon. First parameter is required, it's icon name without `fa-`. Parameters can be set in order or randomly with string keys (macro detect if getting associative array).

## Version 2.0.0

Its compatible with FontAwesome 5, but default style is set to `light`. Best option would be create multiple macros or static variable to set default style. Send me PR or create issue if you need this. 

## Register to config.neon

```
latte:
    macros:
        - Kravcik\Macros\FontAwesomeMacro::install
```

Thx [@peldax](https://github.com/peldax) is also  possible change html element. Default is span.

`{icon star, 'el' => 'i'}` -> `<i class="fal fa-star fa-fw"></i>`


`{icon star}` -> `<span class="fal fa-star fa-fw"></span>`


`{icon star, red}` -> `<span class="fal fa-star color-red fa-fw"></span>`


`{icon star, NULL, lg}` -> `<span class="fal fa-star fa-lg fa-fw"></span>`


`{icon star, yellow, 2}` -> `<span class="fal fa-star color-yellow fa-2x fa-fw"></span>`


`{icon star, blue, 2, TRUE, far}` -> `<span class="far fa-star color-blue fa-2x"></span>`


 `{icon star, size => 2, fw => TRUE, color => 'green-light', style => 'fas'}` -> `<span class="fas fa-star color-green-light fa-2x"></span>`
 
1. `color-` + COLOR 
2. `fa-` + SIZE + `x`
3. FW - if TRUE disable insert of `fa-fw`
4. Style - `fas` / `far` / `fal` / `fab`