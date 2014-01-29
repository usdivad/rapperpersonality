#Makeshift Makefile

cd src
cat matches.js parse.js parse_tester.js input.js ../main.js > all.js

#All .js files with date
#cat *.js ../main.js > all_`date +%Y%m%d%H%M`.js