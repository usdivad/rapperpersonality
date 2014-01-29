#Makeshift Makefile

PADDING=$'\n\n\n\n'
#echo $PADDING

#Enter source
cd src

#Only the .js files we need

#	with date
#cat matches.js parse.js parse_tester.js input.js ../main.js > all_`date +%Y%m%d%H%M`.js

#	without date
cat matches.js parse.js parse_tester.js input.js ../main.js > all.js

#All .js files
#cat *.js > merged_`date +%Y%m%d%H%M`.js