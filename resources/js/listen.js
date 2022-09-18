import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

console.log('Im at the start')
window.Pusher = Pusher;
console.log('Im at the start')
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    // wsHost: process.env.APP_WEBSOCKET_SERVER,
    wsHost: '127.0.0.1',
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    wsPort: 6001,
    forceTLS:false,
    disableStats: true,
    enabledTransports: ['ws', 'wss']

});
console.log('I m close')
window.Echo.channel('display1').listen('.print.send', (e)=>{
    console.log("i m here");
    async function postData(url , data ) {
        // Default options are marked with *
        const response = await fetch(url, {
          method: 'POST', // *GET, POST, PUT, DELETE, etc.
          mode: 'cors', // no-cors, *cors, same-origin
          cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
          credentials: 'same-origin', // include, *same-origin, omit
          headers: {
            'Content-Type': 'application/json'
            // 'Content-Type': 'application/x-www-form-urlencoded',
          },
          redirect: 'follow', // manual, *follow, error
          referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
          body: data,// body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
      }
    $res= postData('http://127.0.0.1:8001/api/print', e.data);
    console.log($res);
});
