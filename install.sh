#!/usr/bin/env bash
cp -R src/. /usr/local/lib/Lucid
mkdir -p /usr/local/lib/Lucid/cli
cp -R cli/base_project/. /usr/local/lib/Lucid/cli/base_project
cp cli/lucid.sh /usr/local/bin/lucid
