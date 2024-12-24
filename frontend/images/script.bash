#!/bin/bash

length=`wc -l $1 | cut -d " " -f 1 `

for((i=0; i<$length; i++))
do
	fileName=`head -$(($i+1)) $1 | tail -1`
	extension=`head -$(($i+1)) $1 | tail -1 | cut -d . -f 2`
	newName="$(($i+1)).$extension"
	mv $fileName $newName
done
echo "renaming the images has been successufy done !"
echo "here is the new ones"
ls $1

