import './app';

window.Echo.private('user.' + auth().id)
    .listen('.example.private.event', (e) => {
        console.log(e.data);
    });
