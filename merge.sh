#Makeshift Makefile

cd src
cat matches.js parse.js parse_tester.js input.js ../main.js > all.js

cd ..
cat page-rapper-personality-quiz_template.php > page-rapper-personality-quiz.php
echo '<script>' >> page-rapper-personality-quiz.php
echo '//Merged' `date +%Y`'/'`date +%m`'/'`date +%d`' '`date +%H`':'`date +%M` >> page-rapper-personality-quiz.php 
cat src/all.js >> page-rapper-personality-quiz.php
echo '</script>' >> page-rapper-personality-quiz.php

#All .js files with date
#cat *.js ../main.js > all_`date +%Y%m%d%H%M`.js