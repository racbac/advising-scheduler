# adds headers to all files
# this file can be improved to one loop and placed in a utilities directory -- not sure how to do either
# need to edit how the loop recursivly accesses the directories

#!/bin/bash

for i in */*.php
    do
        if ! grep -q "/*phpHeader" $i
        then
            cat phpHeader.txt $i >$i.new && mv $i.new $i
        fi
done 

for i in */*.html
    do 
        if ! grep -q "<!--htmlHeader" $i
        then 
            cat htmlHeader.txt $i >$i.new && mv $i.new $i
	fi
done

echo "Headers Added"
