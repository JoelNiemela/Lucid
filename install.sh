#!/usr/bin/env bash

if [[ $UID != 0 ]]; then
    echo "Please run this script with sudo:"
    echo "sudo $0 $@"
    exit 1
fi

cp -R src/. /usr/local/lib/Lucid
mkdir -p /usr/local/lib/Lucid/cli
cp -R cli/base_project/. /usr/local/lib/Lucid/cli/base_project
cp cli/lucid.sh /usr/local/bin/lucid
