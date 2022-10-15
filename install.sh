#!/usr/bin/env bash
cp -R src/. /usr/local/lib/Lucid
mkdir -p /usr/local/lib/lucid_cli
cp -R lucid_cli/base_project/. /usr/local/lib/lucid_cli/base_project
cp lucid_cli/lucid.sh /usr/local/lib/lucid_cli/lucid.sh
cp install/lucid_cli.sh /usr/local/bin/lucid
