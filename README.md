Simple macro for generate Font Awesome icon. First parameter is required, it's icon name without `fa-`. Parameters can be set in order or randomly with string keys (macro detect if getting associative array).

Thx [@peldax](https://github.com/peldax) is also  possible change html element. Default is span.

`{icon star, 'el' => 'i'}` -> `<i class="fa fa-star fa-fw"></i>`


`{icon star}` -> `<span class="fa fa-star fa-fw"></span>`


`{icon star, red}` -> `<span class="fa fa-star color-red fa-fw"></span>`


`{icon star, yellow, 2}` -> `<span class="fa fa-star color-yellow fa-2x fa-fw"></span>`


 `{icon star, size => 2, fw => TRUE, color => 'green-light'}` -> `<span class="fa fa-star color-green-light fa-2x"></span>`
 
1. `color-` + COLOR 
2. `fa-` + SIZE + `x`
3. FW - if TRUE disable insert of `fa-fw`
