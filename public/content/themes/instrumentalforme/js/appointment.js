console.log('%c' + 'Appointment.js LOADED', 'color: #0bf; font-size: 1rem; background-color:#fff');


// Gestion du date + time picker dans la page "teacher profile"

new Vue({
    el: '#appointment',
    vuetify: new Vuetify(),
    data() {
        return {
            date: (new Date()).toISOString().split('T')[0],
            time: '09:00',
            datetime: '',
            menuTime: false,
            menuDate: false,
        }
    },
    computed: {
        dateFr() {
            const [year, month, day] = this.date.split('-')
            return `${day}/${month}/${year}`
        }
    },
    methods: {
        updateDate() {
            console.log('update');
            document.querySelector('#date').value = this.date + ' ' + this.time;
        },
    }
});