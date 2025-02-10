let mix = require('laravel-mix');

mix.browserSync({
    proxy: 'localhost:8888', // La URL donde corre tu Laravel en Docker
    files: [
        'resources/views/**/*.blade.php',
        'resources/css/**/*.css',
        'resources/js/**/*.js'
    ]
});

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('tailwindcss'),
   ]);
