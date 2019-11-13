#!/bin/bash
ORIG_FILENAME="$1"
DEST_FILENAME="${ORIG_FILENAME%.compressed}"
if [ "$ORIG_FILENAME" == "$DEST_FILENAME" ]
then
	echo "Cannot rewrite over the file. File does not have .compressed extension."
	exit 1
fi
# Imperative (lower case)
sed -e 's/α/while /g'  \
    -e 's/β/for /g'   \
    -e 's/ω/$this/g'   \
    -e 's/σ/return /g'   \
    -e 's/ε/if /g'    $ORIG_FILENAME  > $DEST_FILENAME



# Declarative (upper case)
sed -i \
    -e 's/Λ/function /g'  \
    -e 's/Ψ/class /g'   \
    -e 's/Θ/private /g'   \
    -e 's/Ξ/string /g'   \
    -e 's/Φ/public /g'    \
    $DEST_FILENAME  
