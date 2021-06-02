
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueHtmlToPaper from 'vue-html-to-paper';
const options = {
    name: '_blank',
    specs: [
        'fullscreen=yes',
        'titlebar=yes',
        'scrollbars=yes'
    ],
    styles: [
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        'https://unpkg.com/kidlat-css/css/kidlat.css'
    ],
    timeout: 1000, // default timeout before the print window appears
    autoClose: true, // if false, the window will not close after printing
    windowTitle: window.document.title, // override the window title
}
Vue.use(VueHtmlToPaper, options);

const app = new Vue({
    el: '#app',
    data: {
        date: '',
        time: '',
        pasien: [],
    },

    created() {
        this.fetchAntrian();

        Echo.channel('pasien')
            .listen('PasienCreated', (event) => {
                var pasien = event.pasien;
                pasien.antrian = this.pasien.length + 1;
                this.pasien.unshift(pasien);
            })
            .listen('StatusUpdated', (event) => {
                var pasien = event.pasien;
                this.pasien.forEach((row, index) => {
                    if (row.id === pasien.id) {
                        this.$set(this.pasien, index, pasien);
                    }
                });
            });
    },

    methods: {
        fetchAntrian() {
            this.pasien = [];
            axios.get('/pasien').then(response => {
                var data = response.data;
                data.forEach(function (element, index) {
                    element.antrian = data.length - index;
                })
                this.pasien = data;
            });
        },

        createPasien(pasien) {
            axios.post('/pasien', pasien).then(response => {
                console.log(response.data);
            }).catch(err => console.error(err));
        },

        updateStatus(id, status) {
            const data = {
                status: status
            }
            axios.post('/pasien/' + id, data).then(response => {
                console.log(response.data);
            }).catch(err => console.error(err));
        },
    }
});

var week = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
var timerID = setInterval(updateTime, 1000);
updateTime();
function updateTime() {
    var cd = new Date();
    app.time = zeroPadding(cd.getHours(), 2) + ':' + zeroPadding(cd.getMinutes(), 2) + ':' + zeroPadding(cd.getSeconds(), 2);
    app.date = week[cd.getDay()] + ', ' + zeroPadding(cd.getDate(), 2) + '-' + zeroPadding(cd.getMonth() + 1, 2) + '-' + zeroPadding(cd.getFullYear(), 4);
};

function zeroPadding(num, digit) {
    var zero = '';
    for (var i = 0; i < digit; i++) {
        zero += '0';
    }
    return (zero + num).slice(-digit);
}
