php artisan migrate:fresh : drop all existing table and recreate the table.
php artisan make:model Category -m create a migration(table) and corresponding model


$table->foreignId('post_id')->constrained()->cascadeOnDelete();

// does the same as above
$table->unsignedBigInteger('post_id');
$table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();

if you dont want to delete the foreign key relation we can remove the cascadeOnDelete()
