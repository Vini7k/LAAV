document.addEventListener('DOMContentLoaded', function() {
    var calendarElem = document.getElementById('calendario');
    var calendar = new FullCalendar.Calendar(calendarElem, {
        locale: 'pt-br',
        initialView: 'dayGridMonth',
        height: 750,
        
        buttonText: {
            today: 'hoje',
            month: 'mês',
            week: 'semana',
            day: 'dia',
            list: 'lista'
        },
        headerToolbar: {
            start: 'prev next today',
            center: 'title',
            end: 'dayGridMonth timeGridWeek timeGridDay'
        },
        events: 
        [   
            {
                title:'teste',
                start:'2024-05-16t20:00:00'
            },
            {
                failure: function() 
                {
                    alert('Erro ao carregar eventos!');
                },
            },
            
        ],
    });

    calendar.render();

    calendar.on('dateClick', function(info) {
        console.log('clicou em ' + info.dateStr);
        console.log(info.date.toString());
    });
});

