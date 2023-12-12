const mix = require('laravel-mix')
const fs = require('fs')


mix.scripts('public/build/assets/*.js', 'public/js/bundled.js')
.styles('public/build/assets/*.css' ,'public/assets/css/bundled.css')
.postCss('public/assets/css/bundled.css', 'public/css/final.css')
