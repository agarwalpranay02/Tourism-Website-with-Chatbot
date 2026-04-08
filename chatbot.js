const chatButton = document.getElementById("chatbot-button");
const chatBox = document.getElementById("chatbot-box");
const sendBtn = document.getElementById("chatbot-send");
const input = document.getElementById("chatbot-input");
const messages = document.getElementById("chatbot-messages");

chatButton.onclick = () => {
  chatBox.classList.toggle("hidden");
};

sendBtn.onclick = async () => {
  const userText = input.value.trim();
  if (!userText) return;
  addMessage("user", userText);
  input.value = "";
  const reply = await getBotReply(userText);
  addMessage("bot", reply);
};

function addMessage(sender, text) {
  const msg = document.createElement("div");
  msg.className = sender === "user" ? "msg user-msg" : "msg bot-msg";
  msg.innerText = text;
  messages.appendChild(msg);
  messages.scrollTop = messages.scrollHeight;
}

async function getBotReply(message) {
  try {
    const res = await fetch("chatbot.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ message })
    });
    const data = await res.json();
    return data.reply;
  } catch (err) {
    return "Sorry, I’m having trouble replying right now.";
  }
}
