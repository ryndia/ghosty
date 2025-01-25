#!/usr/bin/env sh

# Start MinIO server in the background
minio server /var/www/html/ghosty_db/minio-data --console-address ":9001" &
# Wait until MinIO is ready to accept requests (give it some time to initialize)
until mc alias set myminio http://localhost:9000 minioadmin minioadmin && mc ls myminio; do
    echo "Waiting for MinIO to start..."
    sleep 3
done

# Create MinIO bucket
mc mb myminio/mybkt

# Start Litestream replication after ensuring MinIO is ready
litestream replicate database.sqlite s3://myminio/mybkt/database.sqlite &

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
