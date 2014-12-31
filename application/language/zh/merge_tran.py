#!/usr/bin/python
import sys
import re

if __name__ == '__main__':
    if len(sys.argv) < 4:
        print 'need 3 parameters you give %d' % (len(sys.argv) - 1)
        exit()
      
    org_file = sys.argv[1]
    dict_file = sys.argv[2]
    out_file = sys.argv[3]

    with open(org_file) as f:
        org_content = f.read()

    with open(dict_file) as f:
        dict_content = f.read()

    p = re.compile(r'(?P<key>.*?) = (?P<value>.*?);')

    out_content = org_content[:]

    for m in p.finditer(org_content):
        item = m.group()
        key = m.group('key')
        
        if key:
            express = re.escape(key)
            item_p = re.compile(express + '.*?;')
            item_m = item_p.search(dict_content)
            if item_m:
                if re.match(re.escape(item), out_content):
                    print 'replace: %s' + item
                out_content = out_content.replace(item, item_m.group())

    with open(out_file, 'w') as out_f:
        out_f.write(out_content)
