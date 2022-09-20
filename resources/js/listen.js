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
window.Echo.channel('display1').listen('.print.send',  (e)=>{
    console.log("i m here");
     function postData(url , data ) {
      return new Promise((resolve, reject) =>{
        console.log(JSON.stringify({
            'data':{
                'display_id':e.data.display_id,
                'file_name':e.data.file_name,
                'html':e.data.html
            }
        }));
        // Default options are marked with *
        fetch(url, {
          method: 'POST', // *GET, POST, PUT, DELETE, etc.

          headers: {
            'Content-Type': 'application/json'
            // 'Content-Type': 'application/x-www-form-urlencoded',
          },
          // body:data,
          body: JSON.stringify({
            'data':{
                'display_id':e.data.display_id,
                'file_name':e.data.file_name,
                'html':e.data.html
            }
          }),
        // body data type must match "Content-Type" header
        });
      }).then((response) => response.json()
      .then((res) => {
      resolve(res);
      }))
      .catch((error) => {
      console.log(error)
      });

         // parses JSON response into native JavaScript objects
      }
      //Livewire.emit()
    postData('/api/print', e).then((result) => {console.log(result);});

});
