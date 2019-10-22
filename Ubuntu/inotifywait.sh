inotifywait -m -r /home/bo/sync_test/pm/ -e modify,attrib,move,create,delete |
    while read path action file; do
        echo "appeared in directory '$path' via '$action'"
        #do something with the file
        rsync -avu --delete /home/bo/sync_test/pm/ /home/bo/sync_test/bk/
    done
