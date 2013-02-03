Less4ci
=======

Less Compiler for CodeIgniter


How to use?
-----------

* Set up a config file with you directories.
* Place in `less_dir` your .less file (ex. style.less)
* Call the function `Less::compile('style');` in your code. This function was return the address of the file.

Example of using:
~~~
<link href="<?php echo Less4ci::compile('style') ?>" rel="stylesheet">
~~~

*Note: if in the config `only_development` is true, .less file was compiled every time when function call. Else .less file was compiled, if file does not exist.*


Inspired by
-----------
Less Module for Kohana by [MrWEST](https://github.com/MrWEST)

[https://github.com/MrWEST/kohana-less](https://github.com/MrWEST/kohana-less)