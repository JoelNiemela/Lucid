SCRIPT_DIR=`dirname $(readlink -f $0)`

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
			cp -R "$SCRIPT_DIR/base_project" "./$2"
			# Make sure to create empty directories ignored by github
			mkdir "./$2/models"
		else
			echo "Directory $2 already exists."
			exit 1
		fi
		;;
	*)
		echo "Unknown command '$1'."
		exit 1
		;;
esac
