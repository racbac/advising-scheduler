# *****
# USE WITH CAUTION
# *****
# removes the first seven lines of a php program
#

#!/bin/bash

for i in */*.php
	do
		for j in 1 2 3 4 5 6
		do
			sed '1d' $i> $i.new; mv $i.new $i
		done
done

echo "Headers Removed"
