#!/usr/bin/env sh

set -e

#verify if db exist else restore from s3 storage
if [ -f /var/www/html/ghosty_db/database.sqlite ]; then
	echo "Database already exists, skipping restore"
else
	echo "No database found, restoring from replica if exists"
    litestream restore /var/www/html/ghosty_db/database.sqlite
    chown www-data:www-data /var/www/html/ghosty_db/database.sqlite
fi

#replicate db
exec litestream replicate &


# Run user scripts if they exist
for f in /var/www/html/.fly/scripts/*.sh; do
    if [ -f "$f" ]; then
        # Bail out if any script fails
        bash "$f" -e
    fi
done

# Change ownership of the web directory
chown -R www-data:www-data /var/www/html

# Check if any command is passed to the entrypoint
if [ $# -gt 0 ]; then
    # Execute passed command
    exec "$@"
else
    # Start supervisord if no command is passed
    exec supervisord -c /etc/supervisor/supervisord.conf
fi
