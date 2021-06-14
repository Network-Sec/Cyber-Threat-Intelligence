#!/bin/bash

# Does not work forever. Max Number should be: 9223372036854775807 depending on OS.
# If you intend to let the script run over a longer time period you should add a condition
# so it's not gonna flip over into negate numbers
a=0

while true
do
        filename="$a-tpdne-$(date '+%Y-%m-%d_%H-%M-%S').jpg"
        wget https://thispersondoesnotexist.com/image -O "$filename" -q
        echo "[+] Image saved to $filename"
        
        # Adjust this for speed, don't make it too fast! I wouldn't go below 0.5
        # You may get banned or it could be seen as DOS attempt. Take care.
        sleep 1
    
        # Sometimes files come back empty or crippled,
        # we check & delete, if it's not a jpg. May need to
        # add another check about filesize > 0
        if [[ ! $(file $filename | grep "JPEG") ]]
        then
                rm "$filename"
        fi

        ((a=a+1))

done
