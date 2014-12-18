# Involve

Involve is a web application platform build on CakePHP, used for ISU SSP online proposal management.

* Last tested on [CakePHP (2.5.6)](https://github.com/cakephp/cakephp/releases/tag/2.5.6)

## Requirements

* CakePHP version 2.x
* [Follow CakaPHP Requirement](http://book.cakephp.org/2.0/en/installation.html)

## Configurations

### Step 1: 
Grab all code from this repository

### Step 2:

Download the CakePHP 2.x libarary and put it in the root directory, you should have something like

    /app/[application files]
    /lib/Cake/[cakephp files and directories]
    .htaccess
    [other files ...]

### Step 3:

You need to create the following configuration file from the default examples included. And following the CakePHP configuration guide to update related fields.

    /app/Config/core.php
    /app/Config/database.php
    /app/Config/email.php

### Step 4:

Make sure the `/app/tmp` folder is writable by the webserve user (e.g. `www-data` in Ubuntu).


## License

The MIT License (MIT)

Copyright (c) 2014 Junzi SUN

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.