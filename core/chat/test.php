<button id="send-btn" disabled>Send</button>
<button id="clear-btn">Clear</button>
<pre><code id="response">Empty</code></pre>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>

<script>
const me = Number('<?= $this->userIdentity()->id ?>');
const port = Number('<?= $this->bootEnv('socketPort') ?>');

const $sendBtn = document.getElementById('send-btn');
const $clearBtn = document.getElementById('clear-btn');
const $response = document.getElementById('response');

let users = null;

const socket = io(`http://10.10.3.171:${port}/chat`);

socket.on('connect', () => {
  console.log('Connected successfully!');
  socket.emit('login', me);
});

socket.on('user-list', (payload) => {
  console.log('user-list', payload);
  users = payload;
  $sendBtn.disabled = false;
});

socket.on('chat-click', (payload) => {
  console.log('chat-click', payload);
  $response.textContent = JSON.stringify(payload, null, 2);
});

socket.on('user-data', (payload) => {
  console.log('user-data', payload);
});

$sendBtn.addEventListener('click', () => {
  const friend = users[0];
  console.log(`requesting chat with friend - ${friend.name} (#${friend.id})`);
  $response.textContent = 'Loading...';
  socket.emit('chat list', me, friend.id);
  socket.emit('user inform', friend.id);
});

$clearBtn.addEventListener('click', () => {
  $response.textContent = 'Empty';
});
</script>
