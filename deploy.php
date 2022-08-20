<?php

namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'origami');

// Project repository
set('repository', 'git@github.com:OhKannaDuh/l5r.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', [
    'soketi.json',
]);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts
host('deploy@origami.ohkannaduh.co.uk')
    ->set('deploy_path', '/var/www/origami');

// Tasks
task('vite:build', function () {
    // Download the env file from production
    download('{{ deploy_path }}/shared/.env', '.env.production');

    // Build assets using that env
    runLocally('npm install && npm run build --mode=production');

    // upload those built assets
    upload('public/build', '{{ release_path }}/public');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');
before('artisan:view:cache', 'vite:build');
