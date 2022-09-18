<?php

/* ---------------------------------------------------------- */
/*    please read the notes if you want to make any changes   */
/* ---------------------------------------------------------- */

/**
 * 1. Permission name should be all in lower case.
 * 2. Words will be separated by an underscore.
 * 3. If a permission will not have add, edit and delete functions, then the "is_special" attribute will be true.
 */

return [
    [ 'name'=>'unit', 'allowed' => ['index','create','store','edit','update','delete']],
    [ 'name'=>'group', 'allowed' => ['index','create','store','edit','update','delete']],
];
