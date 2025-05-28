#!/bin/bash

# Αναμονή για να ξεκινήσει η βάση δεδομένων
echo "Waiting for database..."
sleep 10

# Εκτέλεση των Laravel migrations & seeding
php artisan migrate --force

echo "Seeding database..."
php artisan db:seed --force


# Εκκίνηση Apache
exec apache2-foreground
