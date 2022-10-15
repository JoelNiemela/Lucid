LUCID_INSTALL_PATH="/usr/local/lib/Lucid"

if [ -z "$1" ]; then
	echo "Expected a command."
	echo "Type 'lucid help' for more information."
	exit 1
fi

case "$1" in
	init)
		if [ -z "$2" ]; then
			echo "Expected a name."
			echo "Type 'lucid help' for more information."
			exit 1
		fi
		if [ ! -d "./$2" ]
		then
			cp -R "$LUCID_INSTALL_PATH/cli/base_project" "./$2"
			# Make sure to create empty directories ignored by github
			mkdir -p "./$2/models"
		else
			echo "Directory $2 already exists."
			exit 1
		fi
		;;
    install_path)
        echo "$LUCID_INSTALL_PATH/lucid.php"
        ;;
    *)
		echo "Unknown command '$1'."
		exit 1
		;;
esac
