new Vue({
    el: '#calendar',
    vuetify: new Vuetify(),
    data: () => ({
        type: 'month',
        types: [{
                value: 'month',
                text: 'Mois'
            },
            {
                value: 'week',
                text: 'Semaine'
            },

        ],
        weekday: [1, 2, 3, 4, 5, 6, 0],
        value: '',
        events: [],
        colors: ['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'],
    }),
    methods: {
        getEvents({
            start,
            end
        }) {
            const events = []

            const json = document.querySelector('#lessons').value;
            const lessons = JSON.parse(json);
           
            for (lesson of lessons) {

                const start = new Date(lesson.appointment);
                const end = new Date(lesson.appointment);
                end.setTime(end.getTime() + 50 * 60 * 1000);

                let color;
                if (lesson.status == 2) {
                    color = '#f00';
                } else if(lesson.status == 1){
                    color = '#0f0';
                }else {
                    color = '#00f'
                }
               
                events.push({
                   
                     // TODO Faire apparaitre les nom sur le calendrier en fonction de qui est connecté (élève->prof OU prof->élève)
                    // name: start.toLocaleTimeString('fr-FR').substr(0, 5),
                    name: lesson.instrument.name + " " + lesson.student.data.display_name + " " + lesson.teacher.data.display_name,
                    start: start,
                    end: end,
                    color: color,
                    timed: true,
                    category: lesson.instrument.name,
                })
            }

            this.events = events

        },
        getEventColor(event) {
            return event.color
        },
        rnd(a, b) {
            return Math.floor((b - a + 1) * Math.random()) + a
        },
        intervalFormat(locale, getOptions) {
            return locale.time;
        }
    },
});