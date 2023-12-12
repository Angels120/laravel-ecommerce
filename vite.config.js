import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
const fs = require('fs')

function addToDirs(path, allowedExtension = ['js', 'css']){
    let files = fs.readdirSync(path, {withFileTypes: true})
    .filter(item => !item.isDirectory())

    files.forEach((ele, i) => {
        files[i] = path + ele.name
    })

    files = files
    .filter(item => allowedExtension.includes(item.split('.')[item.split('.').length - 1]))
    console.log(files[0].split('.')[files[0].split('.').length - 1])
    console.log(files)
    return files;
}

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',


               // JS

               'public/admin_asset/libs/node-waves/waves.min.js',
               'public/admin_asset/libs/feather-icons/feather.min.js',
               'public/admin_asset/js/pages/plugins/lord-icon-2.1.0.js',
               'public/admin_asset/js/pages/datatables.init.js',
               'public/admin_asset/libs/apexcharts/apexcharts.min.js',
               'public/admin_asset/js/pages/dashboard-crm.init.js',
               'public/admin_asset/libs/sweetalert2/sweetalert2.min.js',
               'public/admin_asset/js/pages/sweetalerts.init.js',
               'public/admin_asset/js/pages/dashboard-analytics.init.js',
               'public/admin_asset/js/pages/dashboard-ecommerce.init.js',

               'public/admin_asset/js/pages/form-pickers.init.js',
               'public/admin_asset/libs/apexcharts/apexcharts.min.js',
               'public/admin_asset/js/pages/dashboard-crm.init.js',




                'public/admin_asset/js/layout.js',
                'public/admin_asset/js/layout.js',
               'public/admin_asset/js/plugins.js',

               'public/admin_asset/libs/bootstrap/js/bootstrap.bundle.min.js',

                'public/admin_asset/js/app.js',
                'public/admin_asset/js/pages/form-file-upload.init.js',

                //Javascript
                'public/admin_asset/libs/swiper/swiper-bundle.min.js',

                'public/admin_asset/libs/simplebar/simplebar.min.js',

            ],
            refresh: true,
        }),
    ],
});
