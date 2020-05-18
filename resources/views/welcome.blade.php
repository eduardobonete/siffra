<head>
  <title>Messages</title>
</head>
<body>
  <div id="app">
    <div v-if="token != null">
      <h1>Messages:</h1>
      <input type="text" v-model="message.message">
      <button @click="sendMessage()">Enviar</button>
      <ul>
        <li v-for="message in messages">
          @{{ message.message }}
        </li>
      </ul>
    </div>
    <div v-if="token == null">
      <h4> Usuários para teste </h4>
      <p> <b>Email: </b> user1@siffra.com.br <b>senha: </b> 123456 </p>
      <p> <b>Email: </b> user2@siffra.com.br <b>senha: </b> 123456 </p>
      <hr>
      Email: <input type="text" v-model="auth.username"><br><br>
      Senha:<input type="password" v-model="auth.password"><br><br>
      <button @click="login()">Login</button>
    </div>
  </div>

  <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('8acae47b14cd6acea139', {
      cluster: 'us2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      app.messages.push(data);
    });

    // Vue application
    const app = new Vue({
      el: '#app',
      data: {
        messages: [],
        message: {
          message: null,
        },
        token: null,
        auth: {
          username: null,
          password: null,
          scope: "*",
          client_secret: "DSoYJ5nADN27HRl7ZblIzcYkBZ6DuwtGWW4UxS9z",
          client_id: 2,
          grant_type: "password"
        }
      },
      methods: {
        sendMessage() {
          var self = this;
          axios.post('/api/v1/message', 
            this.message, 
            {headers: { Authorization: "Bearer " + this.token}})
            .then(function(res) {
              self.message.message = null;
          })
        },
        login() {
          var self = this;
          axios.post('oauth/token', this.auth).then(function(res) {
            console.log(res)
            self.token = res.data.access_token;
          })
        }
      }
    });
  </script>
</body>