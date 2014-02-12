import re
import json

f = open('collected_data.txt', 'r')
q = []
q_json = []
p_start = '{'
p_end = '}'

tally = {}

for line in f:
    if line.find("Drake") != -1:
        #traits = re.match('{.*}', line)
        traits = line[line.find(p_start)+1:line.find(p_end)].split(',')
        q.append(traits)
        
        traits_json = line[line.find(p_start):line.find(p_end)+1].replace('{', '{"').replace(':','":"').replace(',','","').replace('"," ', ', ').replace('}','"}').replace('\n',' ')
        q_json.append(traits_json)

total = len(q)

out = '['
for x in q_json:
    out += x + ','
out += ']'
print out

for x in q:
    for key in x:
        if key in tally:
            tally[key] += 1
        else:
            tally[key] = 1
            

#print tally


for key in tally:
    percentage = 100*float(tally[key])/total
    if percentage > 50:
        print key + ": " + str(percentage) + "%\n"